<?php

namespace App\Router;

use Psr\Container\ContainerInterface;

class RouterFactory
{
    /**
     * Call the Router object like a function from the container
     *
     * @param ContainerInterface $container
     * @return Router
     */
    public function __invoke(ContainerInterface $container): Router
    {
        return $container->get("router");
    }
}