<?php

namespace Drupal\slac_core\Callback;

use Drupal\Core\Security\TrustedCallbackInterface;

class TextPreRender implements TrustedCallbackInterface {

  /**
   * {@inheritDoc}
   */
  public static function trustedCallbacks() {
    return ['preRenderText'];
  }

  /**
   * Element #pre_render callback: Alters title into a render array.
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
  public static function preRenderText($element) {
    if (isset($element['#context']) &&
      isset($element['#template']) &&
      $element['#template'] === '{{ value|nl2br }}'
    ) {
      $element['#markup'] = $element['#context']['value'];
    }
    return $element;
  }

}
