<?php

namespace Drupal\stanford_ssp\Form;

use Drupal\Component\Utility\Html;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\simplesamlphp_auth\Form\SyncingSettingsForm;
use Drupal\stanford_ssp\Service\StanfordSSPDrupalAuth;
use Drupal\user\RoleInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RoleSyncForm overrides simplesamlphp_auth form for easier UI.
 *
 * @package Drupal\stanford_ssp\Form
 */
class RoleSyncForm extends SyncingSettingsForm {

  /**
   * Module handler service.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('module_handler'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory, ModuleHandlerInterface $module_handler, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($config_factory);
    $this->moduleHandler = $module_handler;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    $names = parent::getEditableConfigNames();
    $names[] = 'stanford_ssp.settings';
    return $names;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    // If the form is newly built, the form state storage will be null. If the
    // form is being rebuilt from an ajax, the storage will be some type of
    // array.
    if (is_null($form_state->get('mappings'))) {
      $mappings = explode('|', $form['user_info']['role_population']['#default_value']);
      $form_state->set('mappings', array_filter(array_combine($mappings, $mappings)));
    }

    $form['user_info']['role_population'] = [
      '#type' => 'table',
      '#header' => $this->getRoleHeaders(),
      '#attributes' => ['id' => 'role-mapping-table'],
    ];

    $form['user_info']['role_population']['add']['#tree'] = TRUE;
    $form['user_info']['role_population']['add']['role_id'] = [
      '#type' => 'select',
      '#title' => $this->t('Add Role'),
      '#options' => user_role_names(TRUE),
    ];
    unset($form['user_info']['role_population']['add']['role_id']['#options'][RoleInterface::ANONYMOUS_ID]);

    $form['user_info']['role_population']['add']['attribute'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Key'),
      '#description' => $this->t('The value in the SAML data to use as the key for matching. eg: urn:oid:x.x.x.x'),
      '#attributes' => ['placeholder' => $this->getDefaultSamlAttribute()],
    ];

    $form['user_info']['role_population']['add']['slac_role'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Value'),
      '#description' => $this->t('The value in the SAML data to use as the value for matching. eg: http://slac.stanford.edu/drupal/role_name'),
    ];
    $form['user_info']['role_population']['add']['add_mapping'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add Mapping'),
      '#submit' => ['::addMappingCallback'],
      '#ajax' => [
        'callback' => '::addMapping',
        'wrapper' => 'role-mapping-table',
      ],
    ];

    foreach ($form_state->get('mappings', []) as $role_mapping) {
      $form['user_info']['role_population'][$role_mapping] = $this->buildRoleRow($role_mapping);
    }

    $form['user_info']['role_eval_every_time']['#type'] = 'radios';
    $form['user_info']['role_eval_every_time']['#options'] = [
      0 => $this->t('Do not adjust roles. Allow local administration of roles only.'),
      StanfordSSPDrupalAuth::ROLE_REEVALUATE => $this->t('Re-evaluate roles on every log in. This will grant and remove roles.'),
      StanfordSSPDrupalAuth::ROLE_ADDITIVE => $this->t('Grant new roles only. Will only add roles based on role assignments.'),
    ];

    return $form;
  }

  /**
   * Get the role mapping table headers.
   *
   * @return array
   *   Array of table header labels.
   */
  protected function getRoleHeaders() {
    return [
      $this->t('Drupal Role'),
      $this->t('Attribute'),
      $this->t('SLAC Role'),
      $this->t('Actions'),
    ];
  }

  /**
   * Build the table row for the role mapping string.
   *
   * @param string $role_mapping_string
   *   Formatted role mapping string.
   *
   * @return array
   *   Table render array.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  protected function buildRoleRow($role_mapping_string) {
    [$role_id, $comparison] = explode(':', $role_mapping_string, 2);

    $exploded_comparison = explode(',', $comparison, 3);

    $value = end($exploded_comparison);
    $role = $this->entityTypeManager->getStorage('user_role')
      ->load($role_id);

    return [
      ['#markup' => $role ? $role->label() : $this->t('Broken: @id', ['@id' => $role_id])],
      ['#markup' => reset($exploded_comparison)],
      ['#markup' => $value],
      [
        '#type' => 'submit',
        '#value' => $this->t('Remove Mapping'),
        '#name' => $role_mapping_string,
        '#submit' => ['::removeMappingCallback'],
        '#mapping' => $role_mapping_string,
        '#ajax' => [
          'callback' => '::addMapping',
          'wrapper' => 'role-mapping-table',
        ],
      ],
    ];
  }

  /**
   * Add/remove a new slac_role mapping callback.
   *
   * @param array $form
   *   Compolete Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Current form state.
   *
   * @return array
   *   Form element.
   */
  public function addMapping(array &$form, FormStateInterface $form_state) {
    return $form['user_info']['role_population'];
  }

  /**
   * Add a new slac_role mapping submit callback.
   *slac_role
   * @param array $form
   *   Compolete Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Current form state.
   */
  public function addMappingCallback(array $form, FormStateInterface $form_state) {
    $user_input = $form_state->getUserInput();
    $role_id = $user_input['role_population']['add']['role_id'];
    $slac_role = trim(Html::escape($user_input['role_population']['add']['slac_role']));
    $attribute = trim(Html::escape($user_input['role_population']['add']['attribute']));
    if ($role_id && $slac_role) {
      // If the user didn't enter an attribute, use the default one from config.
      $attribute = $attribute ?: $this->getDefaultSamlAttribute();

      $mapping_string = "$role_id:$attribute,=,$slac_role";
      $form_state->set(['mappings', $mapping_string], $mapping_string);

      $this->messenger()
        ->addWarning($this->t('These settings have not been saved yet.'));
    }

    $form_state->setRebuild();
  }

  /**
   * Remove a slac_role mapping submit callback.
   *
   * @param array $form
   *   Compolete Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Current form state.
   */
  public function removeMappingCallback(array $form, FormStateInterface $form_state) {
    $mappings = $form_state->get('mappings', []);
    unset($mappings[$form_state->getTriggeringElement()['#mapping']]);
    $form_state->set('mappings', $mappings);
    $form_state->setRebuild();
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $mappings = $form_state->get('mappings');

    // Add the role mapping that wasn't added via the ajax callback.
    if ($slac_role = $form_state->getValue(['role_population', 'add', 'slac_role'])) {
      $role_id = $form_state->getValue(['role_population', 'add', 'role_id']);
      $attribute = $form_state->getValue(['role_population', 'add', 'attribute']) ?: 'eduPersonEnttitlement';
      $mappings[] = "$role_id:$attribute,=,$slac_role";
    }

    $form_state->setValue('role_population', implode('|', $mappings));
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('stanford_ssp.settings')
      ->save();
  }

  /**
   * Get the default value of the saml attribute from config.
   *
   * @return string
   *   Default attribute.
   */
  protected function getDefaultSamlAttribute() {
    return $this->config('stanford_ssp.settings')
      ->get('saml_attribute') ?: 'eduPersonEntitlement';
  }

}
