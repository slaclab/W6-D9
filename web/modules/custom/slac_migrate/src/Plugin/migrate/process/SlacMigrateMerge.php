<?php

namespace Drupal\slac_migrate\Plugin\migrate\process;

use Drupal\migrate\MigrateException;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Drupal\migrate_plus\Plugin\migrate\process\Merge;


/**
 * Provides a slac_migrate_merge plugin.
 *
 * @MigrateProcessPlugin(
 *   id = "slac_migrate_merge"
 * )
 * Usage:
 *
 * Use to merge several fields into one. In the following example, imagine a D7
 * node with a field_collections field and an image field that migrations were
 * written for to make paragraph entities in D8. We would like to add those
 * paragraph entities to the 'paragraphs_field'. Consider the following:
 *
 * Available configuration keys:
 * - skip_non_array: (optional) Indicates if migration should stop in case an
 *   element to merge is not array of just ignore it. Default is false.
 *
 * @code
 *  source:
 *    plugin: d7_node
 *  process:
 *    temp_body:
 *      plugin: sub_process
 *      source: field_section
 *      process:
 *        target_id:
 *          plugin: migration_lookup
 *          migration: field_collection_field_section_to_paragraph
 *          source: value
 *    temp_images:
 *      plugin: sub_process
 *      source: field_image
 *      process:
 *        target_id:
 *          plugin: migration_lookup
 *          migration: image_entities_to_paragraph
 *          source: fid
 *    paragraphs_field:
 *      plugin: merge
 *      source:
 *        - '@temp_body'
 *        - '@temp_images'
 *  destination:
 *    plugin: 'entity:node'
 * @endcode
 */
class SlacMigrateMerge extends Merge {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    if (!is_array($value)) {
      throw new MigrateException(sprintf('Merge process failed for destination property (%s): input is not an array.', $destination_property));
    }
    $skip_non_array = isset($this->configuration['skip_non_array']) ? $this->configuration['skip_non_array'] : FALSE;
    $new_value = [];
    foreach ($value as $i => $item) {
      if (!is_array($item) && !$skip_non_array) {
        throw new MigrateException(sprintf('Merge process failed for destination property (%s): index (%s) in the source value is not an array that can be merged.', $destination_property, $i));
      }
      elseif (is_array($item)) {
        $new_value[] = $item;
      }
    }

    return array_merge(...$new_value);
  }

}
