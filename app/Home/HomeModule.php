<?php

namespace App\Home;

use App\Country\Country;
use App\Router\Router;
use App\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeModule
{

    private $renderer;

    public function __construct(Router $router,RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath("index",dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views");
        $router->get("/index", [$this,"index"], "home.page");
    }

    private function checkCountryinDB(Country $country) : array
    {
        if($country->countCountriesinDB() === 0){
            $country = new Country("https://api.covid19api.com/countries");
            $insertcountry = $country->insertCountriesDatastoDB();
            $rescountries = $country->getAllCountriesFromDB();
        }else{
            $rescountries = $country->getAllCountriesFromDB();
        }

        return $rescountries;
    }

    public function index(ServerRequestInterface $request): string
    {
        $country = new Country(null);
        $countries = $this->checkCountryinDB($country);
        
        return $this->renderer->render("index",["countries" => $countries]);
    }
}
