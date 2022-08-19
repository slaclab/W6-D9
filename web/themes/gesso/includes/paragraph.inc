<?php

/**
 * @file
 * Paragraph-related hook implementations.
 */

use Drupal\Component\Utility\Html;

function gesso_preprocess_paragraph(&$vars) {
  /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
  $paragraph = $vars['paragraph'];
  $parent = $paragraph->getParentEntity();
  $vars['is_nested'] = $parent && $parent->getEntityTypeId() == 'paragraph';
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__section(&$vars) {
  $paragraph = $vars['paragraph'];
  $content = $vars['content'];
  // For sections with dark backgrounds, override the default field settings
  // and use the secondary style for buttons.
  if (!empty($content['field_button_links']) &&
    !empty($content['field_button_links'][0]) &&
    !empty($vars['attributes']['class'])
  ) {
    foreach($vars['attributes']['class'] as $class) {
      if (str_contains($class, 'l-section--dark')) {
        $linkIndexes = \Drupal\Core\Render\Element::children($content['field_button_links']);
        foreach ($linkIndexes as $i) {
          $link_classes = $content['field_button_links'][$i]['#options']['attributes']['class'];
          foreach ($link_classes as $key => $link_class) {
            if ($link_class == 'c-button--primary') {
              $link_classes[$key] = 'c-button--secondary';
            }
          }
          $content['field_button_links'][$i]['#options']['attributes']['class'] = $link_classes;
        }
      }
    }
  }
  $vars['content'] = $content;
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__image_embed(&$vars) {
  // Retrieve the paragraph and the image entity from the paragraph.
  // Image field is a required field.
  $paragraph = $vars['elements']['#paragraph'];

  // If a caption override is selected and the override text field is populated,
  // write the override caption into the media entity for templating by the
  // image template.
  if ($paragraph->field_boolean->value) {
    $image_field = $paragraph->get('field_image')->first()->getValue();
    /** @var \Drupal\media\Entity\Media $media */
    $media = Drupal\media\Entity\Media::load($image_field['target_id']);

    // Assign the paragraph's caption field into the caption field.
    // If there's no override caption, empty out the media's caption field.
    if ($paragraph->field_long_text->value) {
      $media->field_caption = $paragraph->field_long_text;
    }
    else {
      $media->field_caption = NULL;
    }
  }
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__image_carousel(&$vars) {
  $vars['pager_items'] = \Drupal\Core\Render\Element::children($vars['content']['field_paragraphs']);
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__table_of_contents(&$vars) {
  $paragraph = $vars['paragraph'];

  // Create a slug as a cleanCSSIdentifier based on the field_short_text value.
  $vars['slug'] = Html::cleanCssIdentifier($paragraph->field_short_text->value);
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__video_hero(&$vars) {
  $media_ids = \Drupal\Core\Render\Element::children($vars['content']['field_video_hero_videos']);
  $hero_videos = [];
  foreach($media_ids as $id) {
    /** @var \Drupal\media\Entity\Media $media */
    $media = $vars['content']['field_video_hero_videos'][$id]['#media'];
    $hero_videos[] = [
      'embed' => $media->field_media_oembed_video->view('video_hero'),
      'caption' => $media->field_caption->view('video_hero'),
      'fallback_image' => $media->field_thumbnail->view('video_hero')
    ];
  }
  $vars['hero_videos'] = $hero_videos;
}

/**
 * Implements hook_preprocess_paragraph__HOOK().
 */
function gesso_preprocess_paragraph__article_hero(&$vars) {
  /** @var \Drupal\media\Entity\Media $media */
  $image = $vars['content']['field_image'][0]['#media'];

  /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
  $paragraph = $vars['paragraph'];

  // Assign either the paragraph's body field or the image's caption field
  // into the template as the caption of the hero.
  $paragraph_caption = $paragraph->field_body[0]->view();
  $vars['hero_caption'] = $paragraph_caption ?: (!empty($image->field_caption[0]) ? $image->field_caption[0]->view() : NULL);

  // Assign the credit, always using the image entity's field.
  if (!empty($image->field_credit[0])) {
    $vars['hero_credit'] = $image->field_credit[0]->view();
  }
}
