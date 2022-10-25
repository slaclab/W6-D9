<?php

namespace Drupal\Tests\stanford_ssp\Kernel\Form;

use Drupal\Core\Form\FormState;
use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Entity\Role;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RoleSyncFormTest.
 *
 * @package Drupal\Tests\stanford_ssp\Unit\Form
 * @coversDefaultClass \Drupal\stanford_ssp\Form\RoleSyncForm
 */
class RoleSyncFormTest extends KernelTestBase {

  /**
   * The form namespace being tested.
   *
   * @var string
   */
  protected $formId = '\Drupal\stanford_ssp\Form\RoleSyncForm';

  /**
   * {@inheritDoc}
   */
  protected static $modules = [
    'system',
    'user',
    'stanford_ssp',
    'simplesamlphp_auth',
    'externalauth',
  ];

  /**
   * {@inheritDoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->installEntitySchema('user');
    $this->installEntitySchema('user_role');
    $this->installSchema('externalauth', 'authmap');
    $this->installSchema('system', ['key_value_expire', 'sequences']);

    $guzzle = $this->createMock(ClientInterface::class);
    $guzzle->method('request')->will($this->returnCallback([
      $this,
      'guzzleCallback',
    ]));
    \Drupal::getContainer()->set('http_client', $guzzle);

    for ($i = 0; $i < 5; $i++) {
      Role::create(['label' => "Role $i", 'id' => "role$i"])->save();
    }
    \Drupal::configFactory()
      ->getEditable('simplesamlphp_auth.settings')
      ->set('role.population', $this->randomMachineName() . 'role1:attribute_name,=,value|role2:attribute_name2,=,another_value')
      ->save();
  }

  public function guzzleCallback($method, $url, $options) {
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')->willReturn(json_encode(['results' => []]));

    $response->method('getStatusCode')->willReturn(200);
    return $response;
  }

  /**
   * Run tests against the form structure, callbacks, and submit.
   *
   * @throws \Drupal\Core\Form\EnforcedResponseException
   * @throws \Drupal\Core\Form\FormAjaxException
   */
  public function testFormBuild() {
    $form = \Drupal::formBuilder()
      ->getForm($this->formId);
    $this->assertCount(26, $form);

    $form_state = new FormState();
    $form = \Drupal::formBuilder()
      ->buildForm($this->formId, $form_state);
    $this->assertNotEmpty($form_state->getFormObject()
      ->addMapping($form, $form_state));

    $new_workgroup = strtolower($this->randomMachineName());
    $form_state->setUserInput([
      'role_population' => [
        'add' => [
          'attribute' => '',
          'role_id' => 'role2',
          'workgroup' => $new_workgroup,
        ],
      ],
    ]);
    $form_state->getFormObject()->addMappingCallback($form, $form_state);
    $form_state->setMethod('GET');
    $form = \Drupal::formBuilder()
      ->rebuildForm($this->formId, $form_state);

    $this->assertArrayHasKey("role2:eduPersonEntitlement,=,$new_workgroup", $form['user_info']['role_population']);

    $form_state->setTriggeringElement(['#mapping' => "role2:eduPersonEntitlement,=,$new_workgroup"]);
    $form_state->getFormObject()->removeMappingCallback($form, $form_state);
    $form = \Drupal::formBuilder()
      ->rebuildForm($this->formId, $form_state);

    $this->assertArrayNotHasKey("role2:eduPersonEntitlement,=,$new_workgroup", $form['user_info']['role_population']);

    $this->runFormSubmit();
  }

  /**
   * Run tests on the form validation and submit.
   */
  protected function runFormSubmit() {
    $form_state = new FormState();
    $form_state->setValues([
      'unique_id' => $this->randomMachineName(),
      'user_name' => $this->randomMachineName()
    ]);
  }

  /**
   * Submitting the form with values in the fields should add them to config.
   */
  public function testAddingNewWorkgroup() {
    \Drupal::configFactory()
      ->getEditable('simplesamlphp_auth.settings')
      ->set('role.population', '')
      ->save();

    $form_state = new FormState();
    $form_state->setValues([
      'unique_id' => 'uid',
      'user_name' => 'uid',
      'role_population' => [
        'add' => [
          'role_id' => 'role1',
          'attribute' => '',
          'workgroup' => 'foo:bar',
        ],
      ],
    ]);
    \Drupal::formBuilder()->submitForm($this->formId, $form_state);
    $this->assertEquals('role1:eduPersonEnttitlement,=,foo:bar', \Drupal::config('simplesamlphp_auth.settings')
      ->get('role.population'));
  }

}
