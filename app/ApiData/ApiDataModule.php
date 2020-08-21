<?php

namespace App\ApiData;

use App\Router\Router;
use App\Renderer\Renderer;
use Psr\Http\Message\ServerRequestInterface;

class ApiDataModule
{
    private $renderer;

    public function __construct(Router $router)
    {
        $this->renderer = new Renderer();
        $this->renderer->addPath("data",dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/data", [$this,"index"], "data.page");
    }

    public function index(ServerRequestInterface $request): string
    {
        return $this->renderer->render("data");
    }
}
