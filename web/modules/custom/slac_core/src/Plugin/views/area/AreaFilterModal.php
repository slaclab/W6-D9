<?php

namespace Drupal\slac_core\Plugin\views\area;

use Drupal\views\Plugin\views\area\Result;

/**
 * Views area area_filter_modal handler.
 *
 * @ingroup views_area_handlers
 * @ViewsArea("area_filter_modal")
 *
 */
class AreaFilterModal extends Result {
  /**
   * {@inheritdoc}
   */
  public function render($empty = FALSE) {
    $render = parent::render($empty);
    if (empty($render['#markup'])) {
      return $render;
    }
    return [
      '#theme' => 'filter_modal',
      '#results' => $render,
      '#modal_content' => NULL,
    ];
  }
}
