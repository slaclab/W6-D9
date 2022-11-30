<?php

/**
 * @file
 * HTML-related hook implementations.
 */

use Drupal\slac_core\Callback\LinkPreRender;

/**
 * Implements hook_preprocess().
 */
function gesso_preprocess(array &$variables) {
  if (!empty($variables['directory'])) {
    $variables['gesso_image_path'] = '/' . $variables['directory'] . '/dist/images';
    $variables['#attached']['drupalSettings']['gesso']['gessoImagePath'] = '/' . $variables['directory'] . '/dist/images';
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function gesso_preprocess_html(array &$variables) {
  $variables['include_back_to_top']
    = theme_get_setting('include_back_to_top', 'gesso') ?? TRUE;
  /** @var \Drupal\Core\Render\Renderer $renderer */
  $renderer = \Drupal::service('renderer');
  $themeConfig = \Drupal::config('gesso.settings');
  $renderer->addCacheableDependency($variables, $themeConfig);
}

/**
 * Implements hook_page_attachments_alter().
 */
function gesso_page_attachments_alter(array &$attachments) {
  $include_back_to_top = theme_get_setting('include_back_to_top') ?? TRUE;
  if ($include_back_to_top) {
    $attachments['#attached']['drupalSettings']['gesso']['backToTopThreshold']
      = theme_get_setting('threshold', 'gesso');
    $attachments['#attached']['drupalSettings']['gesso']['backToTopSmoothScroll']
      = theme_get_setting('smooth_scroll', 'gesso');
    /** @var \Drupal\Core\Render\Renderer $renderer */
    $renderer = \Drupal::service('renderer');
    $themeConfig = \Drupal::config('gesso.settings');
    $renderer->addCacheableDependency($attachments, $themeConfig);

  }

  $viewport = [
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => [
      'name' => 'viewport',
      'content' => 'initial-scale=1.0, viewport-fit=cover',
    ],
  ];
  $attachments['#attached']['html_head'][] = [$viewport, 'viewport'];
}

/**
 * Implements hook_element_info_alter().
 */
function gesso_element_info_alter(array &$types) {
  // Allow for html tags in link label fields.
  if (isset($types['link'])) {
    // The new prerender needs to happen first.
    $types['link']['#pre_render'][1] = $types['link']['#pre_render'][0];
    $types['link']['#pre_render'][0] = [
      LinkPreRender::class,
      'preRenderLink',
    ];
  }
}

/**
 * Implements hook_element_info_alter().
 */
function gesso_element_info_alter(array &$types) {
  // Allow for html tags in link label fields.
  if (isset($types['link'])) {
    // The new prerender needs to happen first.
    $types['link']['#pre_render'][1] = $types['link']['#pre_render'][0];
    $types['link']['#pre_render'][0] = [
      LinkPreRender::class,
      'preRenderLink',
    ];
  }
}
