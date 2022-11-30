<?php

namespace Drupal\slac_core\Callback;

use Drupal\Core\Security\TrustedCallbackInterface;

class LinkPreRender implements TrustedCallbackInterface {

  /**
   * {@inheritDoc}
   */
  public static function trustedCallbacks() {
    return ['preRenderLink'];
  }

  /**
   * Element #pre_render callback: Alters titl into a render array.
   *
   * By having the type set to 'markup', this avoids html tags from being
   * escaped.
   *
   * @param array $element
   *   The form element.
   *
   * @return array
   *   The modified form element.
   */
  public static function preRenderLink($element) {
    if (isset($element['#title']) && !is_array($element['#title'])) {
      $title = [
        '#type' => 'markup',
        '#markup' => $element['#title'],
      ];
      // TODO: Implement dependency injection if possible.
      $element['#title'] = \Drupal::service('renderer')->render($title);
    }
    return $element;
  }

}
