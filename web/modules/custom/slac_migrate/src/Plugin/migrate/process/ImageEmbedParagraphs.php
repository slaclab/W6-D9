<?php

namespace Drupal\slac_migrate\Plugin\migrate\process;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\paragraphs\Entity\Paragraph;

/**
 * Provides an image_embed_paragraphs plugin.
 *
 * Usage:
 *
 * @code
 * process:
 *   bar:
 *     plugin: image_embed_paragraphs
 *     source: source_field_name
 * @endcode
 *
 * @MigrateProcessPlugin(
 *   id = "image_embed_paragraphs",
 *   handle_multiples = TRUE
 * )
 *
 * @DCG
 * ContainerFactoryPluginInterface is optional here. If you have no need for
 * external services just remove it and all other stuff except transform()
 * method.
 */
class ImageEmbedParagraphs extends ProcessPluginBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs an ImageEmbedParagraphs plugin.
   *
   * @param array $configuration
   *   The plugin configuration.
   * @param string $plugin_id
   *   The plugin ID.
   * @param mixed $plugin_definition
   *   The plugin definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    $paragraphs = [];

    if (isset($value)) {
      foreach ($value as $image_item) {
        $paragraphs[] = $this->createImageEmbedParagraphsItem($image_item);
      }
    }

    return $paragraphs;
  }

  /**
   * {@inheritdoc}
   */
  public function multiple(): bool {
    return TRUE;
  }

  protected function createImageEmbedParagraphsItem(array $item): array {

    $paragraph = Paragraph::create([

      'type' => 'image_embed',
      'field_image' => [
        'target_id' => $item['fid'],
      ],
      'field_view_mode' => [
        'value' => 'centered',
      ],
    ]);

    $paragraph->save();

    return [
      'target_id' => $paragraph->id(),
      'target_revision_id' => $paragraph->getRevisionId(),
    ];
  }

}
