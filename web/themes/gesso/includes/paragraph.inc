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
function gesso_preprocess_paragraph__accordion(&$vars) {
  /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
  $paragraph = $vars['paragraph'];
  $parent = $paragraph->getParentEntity();
  $vars['is_nested'] = $parent && $parent->getEntityTypeId() == 'paragraph';
}
