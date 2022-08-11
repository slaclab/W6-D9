<?php

/**
 * @file
 * Node-related hook implementations.
 */

use Drupal\paragraphs\Entity\Paragraph;

/**
 * Implements hook_preprocess_node().
 */
function gesso_preprocess_node(&$variables) {
  // Array of view modes to add regions to.
  $allowed_view_modes = ['full'];

  if (in_array($variables['view_mode'], $allowed_view_modes)) {
    // Array of regions to add to node template.
    $allowed_regions = ['status'];
    _add_regions_to_template($allowed_regions, $variables);
  }
}

/**
* Custom function to add page regions to templates.
*/
function _add_regions_to_template($allowed_regions, &$variables) {
  // Get active theme.
  $theme = \Drupal::theme()->getActiveTheme()->getName();

  // Get current theme regions.
  $available_regions = system_region_list($theme, 'REGIONS_ALL');

  // Validate allowed regions with available regions.
  $regions = array_intersect(array_keys($available_regions), $allowed_regions);

  foreach ($regions as $key => $region) {
    // Load blocks from this region and sort them.
    $blocks = \Drupal::entityTypeManager()
      ->getStorage('block')
      ->loadByProperties(array('theme'  => $theme, 'region' => $region));
    uasort($blocks, 'Drupal\block\Entity\Block::sort');

    // Build blocks and assign to template variable.
    $build = array();
    $builder = \Drupal::entityTypeManager()->getViewBuilder('block');
    foreach ($blocks as $key => $block) {
      if ($block->access('view')) {
        $build[$key] = $builder->view($block, 'block');
      }
    }
    $variables['region_' . $region] = $build;
  }
}

/**
 * Implements hook_preprocess_node__HOOK().
 */
function gesso_preprocess_node__event(&$vars) {
  if ($vars['view_mode'] == 'full') {
    $datetime_range = $vars['node']->get('field_datetime_range')->first()->getValue();
    $start_date = strtotime($datetime_range['value'] . 'Z');
    $end_date = strtotime($datetime_range['end_value'] . 'Z');
    $vars['start_date'] = [
      'month' => date('M', $start_date),
      'day' => date('j', $start_date),
    ];
    if (date('F j, Y', $start_date) == date('F j, Y', $end_date)) {
      $vars['end_date'] = NULL;
      $vars['formatted_date_time'] = date('l, F j, Y', $start_date) . '<br>';
      if (date('a', $start_date) == date('a', $end_date)) {
        $vars['formatted_date_time'] .= date('g:i', $start_date) . ' &ndash; ' . date('g:i a T', $end_date);
      } else {
        $vars['formatted_date_time'] .= date('g:i a', $start_date) . ' &ndash; ' . date('g:i a T', $end_date);
      }
    } else {
      $vars['end_date'] = [
        'month' => date('M', $end_date),
        'day' => date('j', $end_date),
      ];
      $vars['formatted_date_time'] = date('l, F j', $start_date) . ' &ndash; ' . date('l, F j, Y', $end_date);
    }

  }
}

/**
 * Implements hook_preprocess_node().
 */
function gesso_preprocess_node__person(&$vars) {
  if ($vars['view_mode'] == 'full') {
    if (!empty($vars['content']['field_body'][0])) {
      $body_field = $vars['elements']['#node']->get('field_body');
      $vars['content']['field_body_trimmed'] = $body_field->view([
        'type' => 'text_trimmed',
        'label' => 'hidden',
        'settings' => [
          'trim_length' => 500
        ],
      ]);
    }
  }
}

/**
 * Implements hook_preprocess_node().
 */
function gesso_preprocess_node__news_article(&$vars) {
  // Extract the node from the preprocess variables.
  $node = $vars['node'];

  // Extract the set of paragraphs from the content field of the node.
  $paragraphs = $node->get('field_paragraphs')->getValue();
  if (count($paragraphs)) {
    // Collector for list items to be created. Ordered list.
    $list_items = [];

    // Load each paragraph in turn
    foreach ($paragraphs as $item) {
      $paragraph = Paragraph::load($item['target_id']);
      if ($paragraph->getType() == 'table_of_contents') {
        $list_items[] = $paragraph->field_short_text->value;
      }
    }

    if ($list_items) {
      $vars['toc_list'] = _gesso_preprocess_node__news_article_toclist($list_items);
    }
  }

}

function _gesso_preprocess_node__news_article_toclist($items) {

}

