<?php

/**
 * @file
 * Paragraph-related hook implementations.
 */

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__section(&$vars) {
  $paragraph = $vars['paragraph'];
  $content = $vars['content'];
  // For sections with dark backgrounds, override the default field settings
  // and use the secondary style for buttons.
  if (!empty($content['field_button_links']) &&
    !empty($content['field_button_links'][0]) &&
    !empty($vars['attributes']['class'])
  ) {
    foreach($vars['attributes']['class'] as $class) {
      if (str_contains($class, 'l-section--dark')) {
        $linkIndexes = \Drupal\Core\Render\Element::children($content['field_button_links']);
        foreach ($linkIndexes as $i) {
          $link_classes = $content['field_button_links'][$i]['#options']['attributes']['class'];
          foreach ($link_classes as $key => $link_class) {
            if ($link_class == 'c-button--primary') {
              $link_classes[$key] = 'c-button--secondary';
            }
          }
          $content['field_button_links'][$i]['#options']['attributes']['class'] = $link_classes;
        }
      }
    }
  }
  $vars['content'] = $content;
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__image_embed(&$vars) {
  $paragraph = $vars['elements']['#paragraph'];
  if ($paragraph->field_boolean->value && !empty($vars['content']['field_image'][0])) {
    $vars['content']['field_image'][0]['#caption_override'] = $vars['content']['field_long_text'];
  }
  unset($vars['content']['field_long_text']);
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__image_carousel(&$vars) {
  $vars['pager_items'] = \Drupal\Core\Render\Element::children($vars['content']['field_paragraphs']);
}
