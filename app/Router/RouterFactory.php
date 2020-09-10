<?php

namespace App\Router;

use Psr\Container\ContainerInterface;

class RouterFactory
{
    public function __invoke(ContainerInterface $container): Router
    {
        return $container->get("router");
    }
}