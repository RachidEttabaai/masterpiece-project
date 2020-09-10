<?php

use DI\ContainerBuilder;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$configpath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";

$containerbuilder = new ContainerBuilder();
$containerbuilder->addDefinitions($configpath);
$container = $containerbuilder->build();

$container->get("init");