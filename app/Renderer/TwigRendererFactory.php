<?php

namespace App\Renderer;

use Psr\Container\ContainerInterface;

class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        return new TwigRenderer([$container->get("template_path"), $container->get("error.path")]);
    }
}