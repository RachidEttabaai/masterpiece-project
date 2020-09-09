<?php

use App\Init\Init;
use DI\ContainerBuilder;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;
use App\Renderer\RendererInterface;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$configpath = dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";

$containerbuilder = new ContainerBuilder();
$containerbuilder->addDefinitions($configpath);
$container = $containerbuilder->build();

$listrenderer = ["renderer" => $container->get(RendererInterface::class)];

$init = new Init($container->get("listmodules"), $listrenderer);
$response = $init->run(ServerRequest::fromGlobals());
send($response);