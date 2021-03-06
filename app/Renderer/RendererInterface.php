<?php

namespace App\Renderer;

interface RendererInterface
{
    /**
     * Add a path for page rendering
     *
     * @param string $namespace
     * @param string|null $path
     * @return void
     */
    public function addPath(string $namespace, ?string $path = null): void;

    /**
     * Rendering a template or a page.
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []);

    /**
     * Add global variable to all views
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function addGlobal(string $key, $value): void;
}