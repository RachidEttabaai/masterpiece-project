<?php

namespace App\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigRenderer implements RendererInterface
{

    private $twig;

    private $loader;

    public function __construct(string $defaultPath)
    {

        $this->loader = new FilesystemLoader($defaultPath);
        $this->twig = new Environment($this->loader,[]);
        $includefunction = new TwigFunction("includefct",function($filename,$assetfolder){
            include(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . $assetfolder . DIRECTORY_SEPARATOR . $filename);
        });
        $this->twig->addFunction($includefunction);
    }

    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path,$namespace);
    }

    public function render(string $view,array $params = []): string
    {
        return $this->twig->render($view. ".twig",$params);
    }
}