<?php

/**
 * @file
 * Block-related hook implementations.
 */

use Drupal\block_content\BlockContentInterface;

/**
 * Implements hook_theme_suggestions_HOOK_alter().
 */
function gesso_theme_suggestions_block_alter(array &$suggestions, array $variables) {
  $content = $variables['elements']['content'];
  if (isset($content['#block_content']) and $content['#block_content'] instanceof BlockContentInterface) {
    $suggestions = [];
    $bundle = $content['#block_content']->bundle();
    $view_mode = $content['#view_mode'];
    $suggestions[] = 'block__' . $bundle;
    $suggestions[] = 'block__' . $view_mode;
    $suggestions[] = 'block__' . $bundle . '__' . $view_mode;
    if (!empty($variables['elements']['#id'])) {
      $suggestions[] = 'block__' . $variables['elements']['#id'];
    }
  }
}

/**
 * Implements hook_preprocess_node().
 */
function gesso_preprocess_block__facet_block(&$variables) {
  $facets = [];
  $total = 0;

  if (!in_array($variables['derivative_plugin_id'], [
    'entity_type_list',
    'entity_type_grid',
    'research_area_list',
    'research_area_grid',
  ])) {
    return;
  }

  if ($facet_list = current($variables['content'][0])) {
    foreach($facet_list as $facet_record) {
      $facets[] = [
        'id' => $facet_record['raw_value'],
        'label' => $facet_record['values']['value'],
        'count' => $facet_record['values']['count'],
        'active' => $facet_record['values']['active'],
      ];
      $total += $facet_record['values']['count'];
    }
  }

  $variables['facets'] = $facets;
  if ($variables['derivative_plugin_id'] == 'entity_type_list') {
    $variables['facet_total'] = $total;
  }

}
