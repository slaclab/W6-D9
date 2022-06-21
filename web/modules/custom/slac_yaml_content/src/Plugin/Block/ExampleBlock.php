<?php

namespace Drupal\slac_yaml_content\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "slac_yaml_content_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("slac_yaml_content")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
