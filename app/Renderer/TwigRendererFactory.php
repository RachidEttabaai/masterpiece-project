<?php

namespace App\Renderer;

use Psr\Container\ContainerInterface;

class TwigRendererFactory
{
    /**
     * Call the TwigRenderer object like a function from the container
     *
     * @param ContainerInterface $container
     * @return TwigRenderer
     */
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        return new TwigRenderer([$container->get("template_path"), $container->get("error.path")]);
    }
}