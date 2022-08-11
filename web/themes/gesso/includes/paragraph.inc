<?php

/**
 * @file
 * Paragraph-related hook implementations.
 */

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
  $paragraph = $vars['elements']['#paragraph'];

  // If a caption override is selected and the override text field is populated,
  // write the override caption into the media entity for templating by the
  // image template.
  if ($paragraph->field_boolean->value && !empty($vars['content']['field_image'][0])) {
    // Extract the media entity from the image field. Note that if the view mode
    // being used to render the field is not Rendered Entity then ['#media'] will not
    // be set and the code will error. Only overwrite the media item's caption with
    // the override *if* the field is displayed as a Rendered entity.
    if ($media = $vars['content']['field_image'][0]['#media']) {
      // If there's an override string specified in the paragraph, assign it into
      // the caption field on the image, otherwise empty the image's caption field,
      // presumably because the editor did not want the image's caption to display.
      if ($paragraph->field_long_text->value) {
        $media->field_caption = $paragraph->field_long_text;
      }
      else {
        $media->field_caption = NULL;
      }
    }
  }

  // Regardless of whether an override was selected, the override text is not
  // needed for theming, so unset as a theming variable.
  unset($vars['content']['field_long_text']);
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
function gesso_preprocess_paragraph__accordion(&$vars) {
  /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
  $paragraph = $vars['paragraph'];
  $parent = $paragraph->getParentEntity();
  $vars['is_nested'] = $parent && $parent->getEntityTypeId() == 'paragraph';
}

function gesso_preprocess_paragraph__video_hero(&$vars) {
  $media_ids = \Drupal\Core\Render\Element::children($vars['content']['field_video_hero_videos']);
  $hero_videos = [];
  foreach($media_ids as $id) {
    /** @var \Drupal\media\Entity\Media $media */
    $media = $vars['content']['field_video_hero_videos'][$id]['#media'];
    $hero_videos[] = [
      'embed' => $media->field_media_oembed_video->view('video_hero'),
      'caption' => $media->field_caption->view('video_hero'),
    ];
  }
  $vars['hero_videos'] = $hero_videos;
}
