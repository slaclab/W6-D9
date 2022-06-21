<?php

namespace Drupal\slac_yaml_content\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for slac_yaml_content routes.
 */
class SlacYamlContentController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
