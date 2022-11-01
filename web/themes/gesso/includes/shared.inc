<?php

use Drupal\paragraphs\ParagraphInterface;
use Drupal\taxonomy\TermInterface;

/**
* @param array $variables
* @param TermInterface $term
* @return void
*/
function gesso_add_mosaic_filter_classes(array &$variables, TermInterface $term): void
{
  $variables['attributes']['class'][] = 'js-filter-' . $term->id();
  if ($term->parent->target_id) {
    $parent = \Drupal\taxonomy\Entity\Term::load($term->parent->target_id);
    gesso_add_mosaic_filter_classes($variables, $parent);
  }
}

/**
 * Set the hero caption and/or credit.
 *
 * @param array $vars
 * @return void
 */
function _gesso_set_hero_caption(array &$vars) {
  /** @var \Drupal\media\Entity\Media $media */
  $image = $vars['content']['field_image'][0]['#media'];

  /** @var \Drupal\paragraphs\ParagraphInterface $paragraph */
  $paragraph = !empty($vars['paragraph']) ? $vars['paragraph'] : NULL;
  $bundle = $paragraph instanceof ParagraphInterface ? $paragraph->bundle() : 'default';

  // Assign either the paragraph's body field or the image's caption field
  // into the template as the caption of the hero.
  switch ($bundle) {
    case 'article_hero':
      $paragraph_caption = !empty($paragraph->field_body[0]) ? $paragraph->field_body->view('tooltip') : NULL;
      $vars['hero_caption'] = $paragraph_caption ?: (!empty($image->field_caption[0]) ? $image->field_caption->view('tooltip') : NULL);
      break;
    // See template field--paragraph--field-long-text--image-embed.html.twig for caption processing.
    case 'image_embed':
      $paragraph_caption = !empty($paragraph->field_long_text[0]) && $paragraph->field_boolean->value ? $paragraph->field_long_text->view('two_column_hero') : NULL;
      $vars['hero_caption'] = $paragraph_caption ?: (!empty($image->field_caption[0]) ? $image->field_caption->view($vars['view_mode'] == 'two_column_hero' ? 'tooltip' : 'default') : NULL);
      break;
    // See template field--paragraph--field-long-text--overlap-image.html.twig for caption processing.
    case 'overlap_image':
      $paragraph_caption = !empty($paragraph->field_long_text[0]) ? $paragraph->field_long_text->view('tooltip') : NULL;
      $vars['hero_caption'] = $paragraph_caption ?: (!empty($image->field_caption[0]) ? $image->field_caption->view('tooltip') : NULL);
      break;
    default:
      $vars['hero_caption'] = !empty($image->field_caption[0]) ? $image->field_caption->view(in_array($bundle, ['image_hero', 'microsite_hero', 'extra_large_card', 'default']) ? 'tooltip' : 'default') : NULL;
  }

  // Assign the credit, always using the image entity's field.
  if (!empty($image->field_credit[0])) {
    $credit_view_mode = 'default';
    if (in_array($bundle, ['default', 'image_hero', 'overlap_image', 'microsite_hero', 'article_hero', 'extra_large_card'])) {
      $credit_view_mode = 'tooltip';
    }
    if (($bundle == 'image_embed' && $vars['view_mode'] == 'two_column_hero')) {
      $credit_view_mode = 'tooltip';
    }
    $vars['hero_credit'] = !empty($image->field_credit[0]) ? $image->get('field_credit')->view($credit_view_mode) : NULL;
  }

  // Assign the link to the image detail page, if present.
  $vars['hero_url'] = $image->field_boolean->value ? $image->toUrl()->toString() : NULL;
}
