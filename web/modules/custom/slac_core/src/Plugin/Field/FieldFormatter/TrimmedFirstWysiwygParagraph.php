<?php

namespace Drupal\slac_core\Plugin\Field\FieldFormatter;

use Drupal\smart_trim\Plugin\Field\FieldFormatter\SmartTrimFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\smart_trim\Truncate\TruncateHTML;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'trimmed_first_paragraph_wysiwyg' formatter. Finds the
 * first instance of the WYSIWYG "wysiwyg" paragraph in the field and returns a trimmed,
 * plain text version of the paragraph content. Field formatter only applies to
 * entity_reference_revisions field. Extends contributed module drupal/smart_trim.
 * Makes the assumption that the content field in the WYSIWYG paragraph has a
 * machine name of "field_body."
 *
 * @FieldFormatter(
 *   id = "trimmed_first_wysiwyg_paragraph",
 *   label = @Translation("Trimmed first WYSIWYG paragraph"),
 *   field_types = {
 *     "entity_reference_revisions"
 *   },
 *   settings = {
 *     "trim_length" = "40",
 *     "trim_type" = "words",
 *     "trim_suffix" = "...",
 *     "trim_options" = ""
 *   }
 * )
 */
class TrimmedFirstWysiwygParagraph extends SmartTrimFormatter {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'trim_length' => '40',
      'trim_type' => 'words',
      'trim_suffix' => '...',
      'wrap_output' => 0,
      'wrap_class' => 'trimmed',
      'trim_options' => [],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['trim_length'] = [
      '#title' => $this->t('Trim length'),
      '#type' => 'textfield',
      '#size' => 10,
      '#default_value' => $this->getSetting('trim_length'),
      '#min' => 0,
      '#required' => TRUE,
    ];

    $element['trim_type'] = [
      '#title' => $this->t('Trim units'),
      '#type' => 'select',
      '#options' => [
        'chars' => $this->t("Characters"),
        'words' => $this->t("Words"),
      ],
      '#default_value' => $this->getSetting('trim_type'),
    ];

    $element['trim_suffix'] = [
      '#title' => $this->t('Suffix'),
      '#type' => 'textfield',
      '#size' => 10,
      '#default_value' => $this->getSetting('trim_suffix'),
    ];

    $element['wrap_output'] = [
      '#title' => $this->t('Wrap trimmed content?'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('wrap_output'),
      '#description' => $this->t('Adds a wrapper div to trimmed content.'),
    ];

    $element['wrap_class'] = [
      '#title' => $this->t('Wrapped content class.'),
      '#type' => 'textfield',
      '#size' => 20,
      '#default_value' => $this->getSetting('wrap_class'),
      '#description' => $this->t('If wrapping, define the class name here.'),
      '#states' => [
        'visible' => [
          ':input[name="fields[body][settings_edit_form][settings][wrap_output]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $trim_options_value = $this->getSetting('trim_options');
    $element['trim_options'] = [
      '#title' => $this->t('Additional options'),
      '#type' => 'checkboxes',
      '#options' => [
        'text' => $this->t('Strip HTML'),
        'trim_zero' => $this->t('Honor a zero trim length'),
      ],
      '#default_value' => empty($trim_options_value) ? [] : array_keys(array_filter($trim_options_value)),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode = NULL) {
    $element = [];

    $setting_trim_options = $this->getSetting('trim_options');
    $entity = $items->getEntity();

    // Search for a wysiwyg paragraph.
    foreach ($entity->field_paragraphs->getValue() as $paragraph) {
      /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
      $paragraph = \Drupal::service('entity_type.manager')
        ->getStorage('paragraph')
        ->load($paragraph['target_id']);

      if ($paragraph != NULL && $paragraph->getType() == 'wysiwyg' && $paragraph->field_body->value != '') {
        // Update field_summary in the entity.
        $entity->field_summary->value = html_entity_decode(strip_tags($paragraph->field_body->value));
        break;
      }
    }

    // Iterate through the field_summary value(s).
    foreach ($items as $delta => $item) {
      $output = $item->value;

      // Process additional options (currently only HTML on/off).
      if (!empty($setting_trim_options)) {
        // Allow a zero length trim.
        if (!empty($setting_trim_options['trim_zero']) && $this->getSetting('trim_length') == 0) {
          $output = '';
        }

        if (!empty($setting_trim_options['text'])) {
          // Strip caption.
          $output = preg_replace('/<figcaption[^>]*>.*?<\/figcaption>/i', ' ', $output);

          // Strip tags.
          $output = strip_tags($output);

          // Strip out line breaks.
          $output = preg_replace('/\n|\r|\t/m', ' ', $output);

          // Strip out non-breaking spaces.
          $output = str_replace('&nbsp;', ' ', $output);
          $output = str_replace("\xc2\xa0", ' ', $output);

          // Strip out extra spaces.
          $output = trim(preg_replace('/\s\s+/', ' ', $output));
        }
      }

      $truncate = new TruncateHTML();
      $length = $this->getSetting('trim_length');
      $ellipse = $this->getSetting('trim_suffix');
      if ($this->getSetting('trim_type') == 'words') {
        $output = $truncate->truncateWords($output, $length, $ellipse);
      }
      else {
        $output = $truncate->truncateChars($output, $length, $ellipse);
      }
      $element[$delta] = [
        '#type' => 'processed_text',
        '#text' => $output,
      ];

      // Wrap content in container div.
      if ($this->getSetting('wrap_output')) {
        $element[$delta]['#prefix'] = '<div class="' . $this->getSetting('wrap_class') . '">';
        $element[$delta]['#suffix'] = '</div>';
      }
    }

    return $element;
  }

}
