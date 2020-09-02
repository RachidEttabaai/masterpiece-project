<?php

namespace App\Map;

use App\Router\Router;
use App\Summary\Summary;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class MapModule
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
        $this->renderer->addPath("map", dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/map", [$this, "map"], "map.page");
    }

    /**
     * Check if a key exists or not in a array
     *
     * @param string $key
     * @param array $tab
     * @return array
     */
    private function keyexistinarray(string $key, array $tab): array
    {
        if (array_key_exists($key, $tab)) {
            $tab = $tab[$key];
        } else {
            $tab = [];
        }

        return $tab;
    }

    /**
     * Render a page according to the name of the view
     *
     * @param ServerRequestInterface $request
     * @return string
     */
    public function map(ServerRequestInterface $request): string
    {
        $summary = new Summary("https://api.covid19api.com/summary");
        $results = $summary->getSummaryFromAPI();

        $results = $this->keyexistinarray("Countries", $results);
        $errorsresults = $this->keyexistinarray("error", $results);

        return $this->renderer->render("map", [
            "results" => $results,
            "errorsresults" => $errorsresults
        ]);
    }
}