<?php

use App\Router\Router;
use function DI\factory;
use App\Init\InitFactory;
use App\Module\ModuleFactory;
use App\Router\RouterFactory;
use App\Renderer\RendererInterface;
use App\Renderer\TwigRendererFactory;

return [
    "modules_controller" => factory([ModuleFactory::class, "getModules"]),
    "template_path" => dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates",
    "error.path" => dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "errors",
    RendererInterface::class => factory([TwigRendererFactory::class, "__invoke"]),
    "listmodules" => factory([ModuleFactory::class, "__invoke"]),
    "init" => factory([InitFactory::class, "__invoke"]),
    "router" => new Router(),
    Router::class => factory([RouterFactory::class, "__invoke"]),
    "apiCovid19" => "https://api.covid19api.com/",
    "apiRestCountries" => "https://restcountries.eu/rest/v2/alpha/"
];