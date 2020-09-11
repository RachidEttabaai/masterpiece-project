<?php

use App\Map\MapModule;
use App\Router\Router;
use function DI\factory;
use App\Home\HomeModule;
use App\Init\InitFactory;
use App\About\AboutModule;
use App\Error\ErrorModule;
use App\Module\ModuleFactory;
use App\Router\RouterFactory;
use App\ApiData\ApiDataModule;
use App\Renderer\RendererInterface;
use App\Renderer\TwigRendererFactory;

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
    "init" => factory([InitFactory::class, "__invoke"]),
    "router" => new Router(),
    Router::class => factory([RouterFactory::class, "__invoke"])
];