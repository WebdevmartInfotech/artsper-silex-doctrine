<?php

/**
 * Cache paths
 */
$app['cache.path'] = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

/**
 * Database connection credentials
 */
$app['db.options'] = array(
  'driver' => 'pdo_mysql',
  'charset' => 'utf8',
  'host' => '127.0.0.1',
  'dbname' => 'artsper',
  'user' => 'root',
  'password' => '',
);

/**
 * Proxy path
 */
$app['orm.proxies_dir'] = $app['cache.path'] . '/doctrine/proxies';

/**
 * Cache configuration
 */
$app['orm.default_cache'] = array(
  'driver' => 'filesystem',
  'path' => $app['cache.path'] . '/doctrine/cache',
);

/**
 * Entity mapping
 */
$app['orm.em.options'] = array(
  'mappings' => array(
    array(
      'type' => 'annotation',
      'path' => __DIR__ . '/../../src/Artsper/Entity',
      'namespace' => 'Artsper\Entity',
      'alias' => 'Artsper'
    ),
  ),
);

/**
 * Digest encoder
 */
$app['security.encoder.digest'] = $app->share(function($app) {
  return new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder();
});

/**
 * Users for HTTP Authentication
 */
$app['security.users'] = array(
  'admin' => array('ROLE_ADMIN', $app['security.encoder.digest']->encodePassword('pwd', ''))
);

/**
 * Firewall configuration for authentication
 */
$app['security.firewalls'] = array(
  'admin' => array(
    'pattern' => '^/artwork',
    'http' => true,
    'users' => $app['security.users']
  ),
);

/**
 * Debug for development
 */
$app['debug'] = true;

/**
 * Default cache configuration
 */
$app['orm.default_cache'] = 'array';
