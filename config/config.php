<?php

use App\Map\MapModule;
use App\Home\HomeModule;
use function DI\factory;
use App\About\AboutModule;
use App\Error\ErrorModule;
use App\ApiData\ApiDataModule;
use App\Module\ModuleFactory;
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
    "listmodules" => factory([ModuleFactory::class, "__invoke"])
];