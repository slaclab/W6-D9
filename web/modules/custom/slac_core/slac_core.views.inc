<?php

/**
 * @file
 * Views hook implementations for the Slac CORE module.
 */

/**
 * Implements hook_views_data().
 */
function slac_core_views_data() {

  $data['views']['area_facet_list'] = [
    'title' => t('Facet checkbox summary'),
    'help' => t('Displays an augmented search results string. Use only on search views.'),
    'area' => [
      'id' => 'area_facet_list',
    ],
  ];

  return $data;
}
