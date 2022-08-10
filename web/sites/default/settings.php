<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * Include the Pantheon-specific settings file.
 *
 * n.b. The settings.pantheon.php file makes some changes
 *      that affect all environments that this site
 *      exists in.  Always include this file, even in
 *      a local development environment, to ensure that
 *      the site settings remain consistent.
 */
include __DIR__ . "/settings.pantheon.php";

/**
 * Skipping permissions hardening will make scaffolding
 * work better, but will also raise a warning when you
 * install Drupal.
 *
 * https://www.drupal.org/project/drupal/issues/3091285
 */
// $settings['skip_permissions_hardening'] = TRUE;

/**
 * Secrets-based settings.
 */
if (isset($_ENV['PANTHEON_ENVIRONMENT'])) {
  $secrets_file = $_ENV['HOME'] . '/files/private/secrets.json';
}
else {
  $secrets_file = __DIR__ . '/secrets.json';
}

if (file_exists($secrets_file)) {
  $secrets = json_decode(file_get_contents($secrets_file), TRUE);

  // D7 Migration Source
  if (!empty($secrets['migrate_source_db_url'])) {
    $parsed_url = parse_url($secrets['migrate_source_db_url']);
    if (!empty($parsed_url['port']) && !empty($parsed_url['host']) && !empty($parsed_url['pass'])) {
      $databases['drupal7']['default'] = [
        'database' => 'pantheon',
        'username' => 'pantheon',
        'password' => $parsed_url['pass'],
        'host' => $parsed_url['host'],
        'port' => $parsed_url['port'],
        'driver' => 'mysql',
        'prefix' => '',
        'collation' => 'utf8mb4_general_ci',
      ];
    }
  }

  // Turn off email during migration
  if (!empty($secrets['migration_status']) && $secrets['migration_status'] == 'active') {
    $config['mailsystem.settings']['defaults']['sender'] = 'test_mail_collector';
  }
}

/**
 * If there is a local settings file, then include it
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}

// Set config install directory consistently across environments.
$settings['config_sync_directory'] = dirname(DRUPAL_ROOT) . '/config/sync';

// Automatically generated include for settings managed by ddev.
$ddev_settings = dirname(__FILE__) . '/settings.ddev.php';
if (getenv('IS_DDEV_PROJECT') == 'true' && is_readable($ddev_settings)) {
  require $ddev_settings;
}
