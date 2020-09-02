<?php

namespace App\Renderer;

class Renderer implements RendererInterface
{
    const NAMESPACE_BYDEFAULT = "__MAIN";

    private $paths = [];

    public function __construct(?string $defaultPath = null)
    {
        if (!is_null($defaultPath)) {
            $this->addPath($defaultPath);
        }
    }

    /**
     * Add a path for the rendering without a templating engine
     *
     * @param string $namespace
     * @param string|null $path
     * @return void
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::NAMESPACE_BYDEFAULT] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }

    /**
     * Rendering a template with output buffering functions
     *
     * @param string $view
     * @param array $params
     * @return string|bool
     */
    public function render(string $view, array $params = [])
    {
        $path = $this->paths[$view] . DIRECTORY_SEPARATOR . $view . ".php";

        ob_start();
        extract($params);
        require($path);
        return ob_get_clean();
    }
}