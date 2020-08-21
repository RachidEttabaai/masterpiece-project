<?php

namespace App\About;

use App\Router\Router;
use App\Renderer\Renderer;
use Psr\Http\Message\ServerRequestInterface;

class AboutModule
{
    private $renderer;

    public function __construct(Router $router)
    {
        $this->renderer = new Renderer();
        $this->renderer->addPath("about",dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/about", [$this,"index"], "about.page");
    }

    public function index(ServerRequestInterface $request): string
    {
        return $this->renderer->render("about");
    }
}
