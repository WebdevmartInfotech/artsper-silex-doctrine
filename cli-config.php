<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/resources/config/dev.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Artsper"), $isDevMode);

$entityManager = EntityManager::create($app['db.options'], $config);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);