<?php

// Cache paths
$app['cache.path'] = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

// Database connection
$app['db.options'] = array(
  'driver' => 'pdo_mysql',
  'charset' => 'utf8',
  'host' => '127.0.0.1',
  'dbname' => 'artsper',
  'user' => 'root',
  'password' => '',
);

$app['orm.proxies_dir'] = $app['cache.path'] . '/doctrine/proxies';
$app['orm.default_cache'] = array(
  'driver' => 'filesystem',
  'path' => $app['cache.path'] . '/doctrine/cache',
);

// Entity Mapping
$app['orm.em.options'] = array(
  'mappings' => array(
    array(
      'type' => 'annotation',
      'path' => realpath(__DIR__ . '/../../src'),
      'namespace' => 'Artsper\Entity',
    ),
  ),
);

$app['debug'] = true;
$app['orm.default_cache'] = 'array';
