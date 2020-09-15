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
    /**
     * Call the modules controller list from the container
     *
     * @param ContainerInterface $container
     * @return array
     */
    public function __invoke(ContainerInterface $container): array
    {
        return $container->get("modules_controller");
    }

    /**
     * Return the modules controller array 
     *
     * @return array
     */
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