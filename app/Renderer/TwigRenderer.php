<?php

namespace App\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigRenderer implements RendererInterface
{
    /**
     * Stores the Twig configuration and renders templates.
     *
     * @var Environment
     */
    private $twig;

    /**
     * Loads template from the filesystem.
     *
     * @var FilesystemLoader
     */
    private $loader;

    public function __construct(array $defaultPaths = [])
    {

        $this->loader = new FilesystemLoader($defaultPaths);
        $this->twig = new Environment($this->loader, []);

        $this->addTwigFunction("var_dump", function ($value) {
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
        });

        $this->addTwigFunction("print_r", function ($value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        });

        $this->addTwigFunction("bundlejs", function () {
            include(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "bundle.js");
        });
    }

    /**
     * Add a function and use it in a twig template
     *
     * @param string $nametwigfct
     * @param callable $callable
     * @return void
     */
    private function addTwigFunction(string $nametwigfct, callable $callable): void
    {
        $twigfct = new TwigFunction($nametwigfct, $callable);
        $this->twig->addFunction($twigfct);
    }

    /**
     * Add a path to the loader template from the filesystem.
     *
     * @param string $namespace
     * @param string|null $path
     * @return void
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        if (!is_null($path)) {
            $this->loader->addPath($path, $namespace);
        }
    }

    /**
     * Add global variable to all views
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }

    /**
     * Rendering a template with Twig
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view . ".twig", $params);
    }
}