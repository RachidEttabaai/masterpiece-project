<?php

namespace App\Home;

use App\Country\Country;
use App\Router\Router;
use App\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeModule
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
        $this->renderer->addPath("index", $this->defaultpath);
        $this->container->get(Router::class)->get("/index", [$this, "index"], "home.page");
    }

    /**
     * Check if the table Country in the database has records or not
     *
     * @param Country $country
     * @return array
     */
    private function checkCountryinDB(Country $country): array
    {
        $rescountries = [];

        if ($country->countCountriesinDB() === 0) {
            $country = new Country("https://api.covid19api.com/countries", $this->container);
            $country->insertCountriesDatastoDB();
        }

        $rescountries = $country->getAllCountriesFromDB();

        return $rescountries;
    }

    /**
     * Render a page according to the name of the view
     *
     * @param ServerRequestInterface $request
     * @return string
     */
    public function index(ServerRequestInterface $request): string
    {
        $country = new Country(null, $this->container);
        $countries = $this->checkCountryinDB($country);

        return $this->renderer->render("index", compact("countries"));
    }
}