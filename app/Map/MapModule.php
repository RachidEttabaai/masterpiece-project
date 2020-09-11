<?php

namespace App\Map;

use App\Router\Router;
use App\Summary\Summary;
use App\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class MapModule
{
    /**
     * Interface renderer for page rendering
     *
     * @var RendererInterface
     */
    private $renderer;

    /**
     * Default path for the rendering system with/without template engine
     *
     * @var string
     */
    private $defaultpath;

    /**
     * Dependency injection container
     *
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->renderer = $this->container->get(RendererInterface::class);
        $this->defaultpath = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "templates";
        $this->renderer->addPath("map", $this->defaultpath);
        $this->container->get(Router::class)->get("/map", [$this, "map"], "map.page");
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
        $summary = new Summary($this->container->get("apiCovid19") . "summary");
        $results = $summary->getSummaryFromAPI();

        $results = $this->keyexistinarray("Countries", $results);
        $errorsresults = $this->keyexistinarray("message", $results);

        return $this->renderer->render("map", compact("results", "errorsresults"));
    }
}