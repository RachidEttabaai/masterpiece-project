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

        $this->addTwigFunction("var_dump",function($value){
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
        });

        $this->addTwigFunction("print_r",function($value){
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        });
        
        $this->addTwigFunction("includefct",function($filename,$assetfolder){
            include(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . $assetfolder . DIRECTORY_SEPARATOR . $filename);
        });

        $this->addTwigFunction("bundlejs",function(){
            include(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "bundle.js");
        });

        $this->addTwigFunction("maincss",function(){
            include(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "main.css");
        });

    }

    private function addTwigFunction(string $nametwigfct,callable $callable): void
    {
        $twigfct = new TwigFunction($nametwigfct,$callable);
        $this->twig->addFunction($twigfct);
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