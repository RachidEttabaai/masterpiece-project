<?php

namespace App\Module;

use App\Map\MapModule;
use App\Home\HomeModule;
use App\About\AboutModule;
use App\Error\ErrorModule;
use App\ApiData\ApiDataModule;
use Psr\Container\ContainerInterface;

class ModuleFactory
{
    public function __invoke(ContainerInterface $container): array
    {
        return $container->get("modules_controller");
    }

    public function getModules(): array
    {
        return [
            HomeModule::class,
            ApiDataModule::class,
            MapModule::class,
            AboutModule::class,
            ErrorModule::class
        ];
    }
}