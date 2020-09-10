<?php

use App\Init\Init;
use App\Map\MapModule;
use App\Router\Router;
use App\Home\HomeModule;
use function DI\factory;
use App\About\AboutModule;
use App\Error\ErrorModule;
use App\Module\ModuleFactory;
use App\Router\RouterFactory;
use App\ApiData\ApiDataModule;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;
use App\Renderer\RendererInterface;
use App\Renderer\TwigRendererFactory;
use Psr\Container\ContainerInterface;

return [
    "modules_controller" => [
        HomeModule::class,
        ApiDataModule::class,
        MapModule::class,
        AboutModule::class,
        ErrorModule::class
    ],
    "template_path" => dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates",
    "error.path" => dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "errors",
    RendererInterface::class => factory([TwigRendererFactory::class, "__invoke"]),
    "listmodules" => factory([ModuleFactory::class, "__invoke"]),
    "init" => function (ContainerInterface $container) {
        $init = new Init($container);
        $response = $init->run(ServerRequest::fromGlobals());
        send($response);
    },
    "router" => new Router(),
    Router::class => factory([RouterFactory::class, "__invoke"])
];