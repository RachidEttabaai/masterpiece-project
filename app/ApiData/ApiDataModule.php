<?php

namespace App\ApiData;

use App\Router\Router;
use App\Summary\Summary;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiDataModule
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
        $this->renderer->addPath("data", dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/data", [$this, "data"], "data.page");
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
        if (array_key_exists($key, $tab) && $key != "error") {
            $tab = $tab[$key];
        } elseif ($key == "error") {
            $tab = ["error_msg" => "Temporary unavailability of API data. Please come back in a moment.We apologize for the inconvenience."];
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
    public function data(ServerRequestInterface $request): string
    {
        $summary = new Summary("https://api.covid19api.com/summary");
        $results = $summary->getSummaryFromAPI();

        $globalresults = $this->keyexistinarray("Global", $results);
        $countriesresults = $this->keyexistinarray("Countries", $results);
        $errorsresults = $this->keyexistinarray("error", $results);

        return $this->renderer->render("data", [
            "globalresults" => $globalresults,
            "countriesresults" => $countriesresults,
            "error_msg" => $errorsresults
        ]);
    }
}