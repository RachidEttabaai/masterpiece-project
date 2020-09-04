<?php

namespace App\About;

use App\Router\Router;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class AboutModule
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

    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->defaultpath = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "templates";
        $this->renderer->addPath("about", $this->defaultpath);
        $router->get("/about", [$this, "about"], "about.page");
    }

    /**
     * Render a page according to the name of the view
     *
     * @param ServerRequestInterface $request
     * @return string
     */
    public function about(ServerRequestInterface $request): string
    {
        return $this->renderer->render("about");
    }
}