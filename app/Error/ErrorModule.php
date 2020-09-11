<?php

namespace App\Error;

use App\Router\Router;
use App\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class ErrorModule
{
    /**
     * Interface renderer for page rendering
     *
     * @var RendererInterface
     */
    private $renderer;

    /**
     * Default path for the rendering system with/without template engine
     *
     * @var string
     */
    private $defaultpath;

    /**
     * Dependency injection container
     *
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->renderer = $this->container->get(RendererInterface::class);
        $this->defaultpath = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "errors";
        $this->renderer->addPath("error", $this->defaultpath);
        $this->container->get(Router::class)->get("/error", [$this, "error"], "error.page");
    }

    /**
     * Render a page according to the name of the view
     *
     * @param ServerRequestInterface $request
     * @return string
     */
    public function error(ServerRequestInterface $request): string
    {
        return $this->renderer->render("error");
    }
}