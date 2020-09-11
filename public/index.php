<?php

use DI\ContainerBuilder;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$containerbuilder = new ContainerBuilder();
$containerbuilder->addDefinitions(dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php");
$containerbuilder->addDefinitions(dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "env.php");
$container = $containerbuilder->build();

$container->get("init");