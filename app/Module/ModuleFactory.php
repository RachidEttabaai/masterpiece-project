<?php

namespace App\Module;

use Psr\Container\ContainerInterface;

class ModuleFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return $container->get("modules_controller");
    }
}