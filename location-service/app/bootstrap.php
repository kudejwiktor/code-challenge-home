<?php

use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../app/config.php';

$containerBuilder = new ContainerBuilder;

$containerBuilder->addDefinitions(require __DIR__ . '/dependencies.php');
$container = $containerBuilder->build();

return $container;