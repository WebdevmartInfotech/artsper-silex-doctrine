<?php

$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider());

return $app;