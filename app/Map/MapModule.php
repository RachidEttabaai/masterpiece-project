<?php
 
namespace App\Map;

use App\Router\Router;
use App\Renderer\Renderer;
use Psr\Http\Message\ServerRequestInterface;

class MapModule
{
    private $renderer;

    public function __construct(Router $router)
    {
        $this->renderer = new Renderer();
        $router->get("/map", [$this,"index"], "map.page");
    }

    public function index(ServerRequestInterface $request): string
    {
        return $this->renderer->render("map");
    }
}
