<?php

namespace App\Map;

use App\Router\Router;
use App\Summary\Summary;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class MapModule
{
    private $renderer;

    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath("map", dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/map", [$this, "map"], "map.page");
    }

    public function map(ServerRequestInterface $request): string
    {
        $summary = new Summary("https://api.covid19api.com/summary");
        $results = $summary->getSummaryFromAPI();

        if (array_key_exists("Countries", $results)) {
            $results = $results["Countries"];
        } else {
            $results = [];
        }

        if (array_key_exists('error', $results)) {
            $errorsresults = ["error_msg" => "Temporary unavailability of API data for showing the map. Please come back in a moment.We apologize for the inconvenience."];
        } else {
            $errorsresults = [];
        }

        return $this->renderer->render("map", [
            "results" => $results,
            "errorsresults" => $errorsresults
        ]);
    }
}