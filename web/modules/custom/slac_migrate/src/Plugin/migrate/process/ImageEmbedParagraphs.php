<?php

namespace Drupal\slac_migrate\Plugin\migrate\process;

use Drupal\Component\Transliteration\TransliterationInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an image_embed_paragraphs plugin.
 *
 * Usage:
 *
 * @code
 * process:
 *   bar:
 *     plugin: image_embed_paragraphs
 *     source: foo
 * @endcode
 *
 * @MigrateProcessPlugin(
 *   id = "image_embed_paragraphs"
 * )
 *
 * @DCG
 * ContainerFactoryPluginInterface is optional here. If you have no need for
 * external services just remove it and all other stuff except transform()
 * method.
 */
class ImageEmbedParagraphs extends ProcessPluginBase implements ContainerFactoryPluginInterface {

  /**
   * The transliteration service.
   *
   * @var \Drupal\Component\Transliteration\TransliterationInterface
   */
  protected $transliteration;

  /**
   * Constructs an ImageEmbedParagraphs plugin.
   *
   * @param array $configuration
   *   The plugin configuration.
   * @param string $plugin_id
   *   The plugin ID.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param \Drupal\Component\Transliteration\TransliterationInterface $transliteration
   *   The transliteration service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TransliterationInterface $transliteration) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->transliteration = $transliteration;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('transliteration')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    return $this->transliteration->transliterate($value, LanguageInterface::LANGCODE_DEFAULT);
  }

}
