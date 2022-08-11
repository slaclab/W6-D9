<?php

namespace Drupal\slac_core\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;
use Drupal\media\Plugin\Field\FieldFormatter\OEmbedFormatter;

/**
 * Return just the URL of the oEmbed iframe.
 *
 * @FieldFormatter(
 *   id = "iframe_url",
 *   label = @Translation("oEmbed URL"),
 *   field_types = {
 *     "link",
 *     "string",
 *     "string_long",
 *   },
 * )
 */
class IframeUrlFormatter extends OEmbedFormatter {
  /**
   * {@inheritDoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode)
  {
    $parentElem = parent::viewElements($items, $langcode);
    $element = [];
    foreach ($parentElem as $delta => $item) {
      if (!empty($item['#tag']) && $item['#tag'] == 'iframe') {
        $url = $item['#attributes']['src'];
      } else if (!empty($item['#url'])) {
        $url = $item['#url'];
      } else {
        $url = $item['#uri'];
      }
      if ($url) {
        $element[$delta] = [
          '#plain_text' => $url
        ];
      }
    }
    return $element;
  }
}
