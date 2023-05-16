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
  // Set media migration embed token to media_embed and not entity_embed
  $settings['media_migration_embed_token_transform_destination_filter_plugin'] = 'media_embed';

  // Sendgrid configuration override.
  if (!empty($secrets['sendgrid_api_key'])) {
    $config['sendgrid_integration.settings']['apikey'] = $secrets['sendgrid_api_key'];
  }
}

// Configure Redis

if (defined(
    'PANTHEON_ENVIRONMENT'
  ) && !\Drupal\Core\Installer\InstallerKernel::installationAttempted(
  ) && extension_loaded('redis')) {
  // Set Redis as the default backend for any cache bin not otherwise specified.
  $settings['cache']['default'] = 'cache.backend.redis';

  //phpredis is built into the Pantheon application container.
  $settings['redis.connection']['interface'] = 'PhpRedis';

  // These are dynamic variables handled by Pantheon.
  $settings['redis.connection']['host'] = $_ENV['CACHE_HOST'];
  $settings['redis.connection']['port'] = $_ENV['CACHE_PORT'];
  $settings['redis.connection']['password'] = $_ENV['CACHE_PASSWORD'];

  $settings['redis_compress_length'] = 100;
  $settings['redis_compress_level'] = 1;

  $settings['cache_prefix']['default'] = 'pantheon-redis';

  $settings['cache']['bins']['form'] = 'cache.backend.database'; // Use the database for forms

  // Apply changes to the container configuration to make better use of Redis.
  // This includes using Redis for the lock and flood control systems, as well
  // as the cache tag checksum. Alternatively, copy the contents of that file
  // to your project-specific services.yml file, modify as appropriate, and
  // remove this line.
  $settings['container_yamls'][] = 'modules/contrib/redis/example.services.yml';

  // Allow the services to work before the Redis module itself is enabled.
  $settings['container_yamls'][] = 'modules/contrib/redis/redis.services.yml';

  // Manually add the classloader path, this is required for the container
  // cache bin definition below.
  $class_loader->addPsr4('Drupal\\redis\\', 'modules/contrib/redis/src');

  // Use redis for container cache.
  // The container cache is used to load the container definition itself, and
  // thus any configuration stored in the container itself is not available
  // yet. These lines force the container cache to use Redis rather than the
  // default SQL cache.
  $settings['bootstrap_container_definition'] = [
    'parameters' => [],
    'services' => [
      'redis.factory' => [
        'class' => 'Drupal\redis\ClientFactory',
      ],
      'cache.backend.redis' => [
        'class' => 'Drupal\redis\Cache\CacheBackendFactory',
        'arguments' => [
          '@redis.factory',
          '@cache_tags_provider.container',
          '@serialization.phpserialize',
        ],
      ],
      'cache.container' => [
        'class' => '\Drupal\redis\Cache\PhpRedis',
        'factory' => ['@cache.backend.redis', 'get'],
        'arguments' => ['container'],
      ],
      'cache_tags_provider.container' => [
        'class' => 'Drupal\redis\Cache\RedisCacheTagsChecksum',
        'arguments' => ['@redis.factory'],
      ],
      'serialization.phpserialize' => [
        'class' => 'Drupal\Component\Serialization\PhpSerialize',
      ],
    ],
  ];
}

/*
* Environment Indicator module settings.
* see: https://pantheon.io/docs/guides/environment-configuration/environment-indicator
*/
  $conf['environment_indicator_overwrite'] = TRUE;
  $conf['environment_indicator_overwritten_position'] = 'top';
  $conf['environment_indicator_overwritten_fixed'] = FALSE;

  // Set local config split to be active on local environments.
  $config['config_split.config_split.local']['status'] = TRUE;
  $config['config_split.config_split.prod']['status'] = FALSE;
  $config['config_split.config_split.dev']['status'] = FALSE;

  // Pantheon Env Specific Config
  if (isset($_ENV['PANTHEON_ENVIRONMENT'])) {
      switch ($_ENV['PANTHEON_ENVIRONMENT']) {
        case 'dev':
          $config['environment_indicator.indicator']['name'] = 'Dev';
          $config['environment_indicator.indicator']['bg_color'] = '#307b24';
          $config['environment_indicator.indicator']['fg_color'] = '#ffffff';
          $config['config_split.config_split.local']['status'] = FALSE;
          $config['config_split.config_split.prod']['status'] = FALSE;
          $config['config_split.config_split.dev']['status'] = TRUE;
          break;
        case 'test':
          $config['environment_indicator.indicator']['name'] = 'Test';
          $config['environment_indicator.indicator']['bg_color'] = '#b85c00';
          $config['environment_indicator.indicator']['fg_color'] = '#ffffff';
          $config['config_split.config_split.local']['status'] = FALSE;
          $config['config_split.config_split.prod']['status'] = FALSE;
          $config['config_split.config_split.dev']['status'] = TRUE;
          break;
        case 'live':
          $config['environment_indicator.indicator']['name'] = 'Live!';
          $config['environment_indicator.indicator']['bg_color'] = '#e7131a';
          $config['environment_indicator.indicator']['fg_color'] = '#ffffff';
          $config['config_split.config_split.local']['status'] = FALSE;
          $config['config_split.config_split.prod']['status'] = TRUE;
          $config['config_split.config_split.dev']['status'] = FALSE;
          break;
        case 'pmu':
          $config['environment_indicator.indicator']['name'] = 'PMU';
          $config['environment_indicator.indicator']['bg_color'] = '#e7131a';
          $config['environment_indicator.indicator']['fg_color'] = '#ffffff';
          $config['config_split.config_split.local']['status'] = FALSE;
          $config['config_split.config_split.prod']['status'] = FALSE;
          $config['config_split.config_split.dev']['status'] = TRUE;
          break;
        default:
          //Multidev catchall
          $config['environment_indicator.indicator']['name'] = 'Multidev';
          $config['environment_indicator.indicator']['bg_color'] = '#e7131a';
          $config['environment_indicator.indicator']['fg_color'] = '#ffffff';
          $config['config_split.config_split.local']['status'] = TRUE;
          $config['config_split.config_split.prod']['status'] = FALSE;
          $config['config_split.config_split.dev']['status'] = FALSE;
          break;
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

// Include settings required for Redis cache.
if ((file_exists(__DIR__ . '/settings.ddev.redis.php') && getenv('IS_DDEV_PROJECT') == 'true')) {
  include __DIR__ . '/settings.ddev.redis.php';
}

