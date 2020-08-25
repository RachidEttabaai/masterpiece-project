<?php

namespace App\Home;

use App\Router\Router;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeModule
{

    private $renderer;

    public function __construct(Router $router,RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath("index",dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/index", [$this,"index"], "home.page");
    }

    public function index(ServerRequestInterface $request): string
    {
        return $this->renderer->render("index");
    }
}
