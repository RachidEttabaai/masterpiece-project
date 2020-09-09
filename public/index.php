<?php

use App\Init\Init;
use DI\ContainerBuilder;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$configpath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";

$containerbuilder = new ContainerBuilder();
$containerbuilder->addDefinitions($configpath);
$container = $containerbuilder->build();

$init = new Init($container);
$response = $init->run(ServerRequest::fromGlobals());
send($response);