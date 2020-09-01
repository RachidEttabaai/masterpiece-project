<?php

namespace App\About;

use App\Router\Router;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class AboutModule
{
    private $renderer;

    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath("about", dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/about", [$this, "about"], "about.page");
    }

    public function about(ServerRequestInterface $request): string
    {
        return $this->renderer->render("about");
    }
}