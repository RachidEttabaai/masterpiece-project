<?php

namespace App\ApiData;

use App\Router\Router;
use App\Summary\Summary;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiDataModule
{
    private $renderer;

    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath("data", dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/data", [$this, "data"], "data.page");
    }

    public function data(ServerRequestInterface $request): string
    {
        $summary = new Summary("https://api.covid19api.com/summary");
        $results = $summary->getSummaryFromAPI();

        if (array_key_exists("Global", $results)) {
            $globalresults = $results["Global"];
        } else {
            $globalresults = [];
        }

        if (array_key_exists("Countries", $results)) {
            $countriesresults = $results["Countries"];
        } else {
            $countriesresults = [];
        }

        if (array_key_exists("error", $results)) {
            $errorsresults = ["error_msg" => "Temporary unavailability of API data. Please come back in a moment.We apologize for the inconvenience."];
        } else {
            $errorsresults = [];
        }

        return $this->renderer->render("data", [
            "globalresults" => $globalresults,
            "countriesresults" => $countriesresults,
            "error_msg" => $errorsresults
        ]);
    }
}