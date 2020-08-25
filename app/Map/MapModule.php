<?php
 
namespace App\Map;

use App\Router\Router;
use App\Summary\Summary;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class MapModule
{
    private $renderer;

    public function __construct(Router $router,RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath("map",dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/map", [$this,"index"], "map.page");
    }

    public function index(ServerRequestInterface $request): string
    {
        $summary = new Summary("https://api.covid19api.com/summary");
        $results = $summary->getSummaryFromAPI()["Countries"];
        return $this->renderer->render("map",["results" => $results]);
    }
}
