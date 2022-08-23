<?php

/**
 * @file
 * PAGE-related hook implementations.
 */

use Drupal\slac_core\Services\MicrositeUtilities;

/**
 * Implements hook_theme_suggestions_HOOK_alter().
 */
function gesso_theme_suggestions_page_alter(array &$suggestions, array $variables) {
  if ($node = \Drupal::routeMatch()->getParameter('node')) {
    $content_type = $node->bundle();

    /** @var \Drupal\slac_core\Services\MicrositeUtilities $microsite_utilities */
    $microsite_utilities = \Drupal::service('slac_core.microsite_utilities');

    if ($microsite_utilities->IsMicrositePage()) {
      $suggestions[] = 'page__microsite';
    }
  }
}
