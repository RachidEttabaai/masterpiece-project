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

    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath("about", dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
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