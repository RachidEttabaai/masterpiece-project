<?php

namespace App\Country;

use App\Api\Api;
use App\Db\MySQL;
use Psr\Container\ContainerInterface;

class Country extends MySQL
{
    /**
     * API url
     *
     * @var string|null
     */
    private $apiurlforcountries;

    /**
     * Dependency injection container
     *
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct($this->container);
        $this->apiurlforcountries = $this->container->get("apiCovid19") . "countries";
    }

    /**
     * Create structured associate table using API data before insert in the database
     *
     * @param array $apidatatables
     * @return array
     */
    private function createDataTableBeforeInserttoDb(array $apidatatables): array
    {
        $arrres = [];

        foreach ($apidatatables as $apidatatable) {

            if ($apidatatable["ISO2"] != "AN") {
                $coordonnesgpsforcountriesapi = new Api($this->container->get("apiRestCountries") . $apidatatable["ISO2"]);

                $coordonnesgpsforcountries = $coordonnesgpsforcountriesapi->apirequest();

                $latitude = $coordonnesgpsforcountries["latlng"][0];
                $longitude = $coordonnesgpsforcountries["latlng"][1];
            } else {
                $latitude =  12.226079;
                $longitude = -69.060087;
            }

            $countrydatas = [
                "country_name" => $apidatatable["Country"],
                "country_slug" => $apidatatable["Slug"],
                "country_code" => $apidatatable["ISO2"],
                "latitude" => $latitude,
                "longitude" => $longitude
            ];

            array_push($arrres, $countrydatas);
        }

        return $arrres;
    }

    /**
     * Get data from an API with using Client object from GuzzleHttp
     *
     * @return array
     */
    private function getAllCountriesFromAPI(): array
    {

        $countriesapi = new Api($this->getApiurlforcountries());

        $countries = $countriesapi->apirequest();

        return $this->createDataTableBeforeInserttoDb($countries);
    }

    /**
     * Get data from the table Country in the database
     *
     * @return array
     */
    public function getAllCountriesFromDB(): array
    {
        return $this->selectquery("SELECT * FROM Country ORDER BY country_name");
    }

    /**
     * Get the count of records in the table Country in the database 
     *
     * @return integer
     */
    public function countCountriesinDB(): int
    {
        return $this->countquery("SELECT COUNT(*) AS Nbcountries FROM Country");
    }

    /**
     * Insert data from an API in the database
     *
     * @return void
     */
    public function insertCountriesDatastoDB(): void
    {
        $countriesdatas = $this->getAllCountriesFromAPI();

        $insertcountry = "INSERT INTO Country(country_name,country_slug,country_code,latitude,longitude)
                                 VALUES (:country_name,:country_slug,:country_code,:latitude,:longitude)";

        foreach ($countriesdatas as $countrydatas) {

            $this->insertquery($insertcountry, $countrydatas);
        }
    }


    /**
     * Get the value of _apiurlforcountries
     * 
     * @return string|null
     */
    public function getApiurlforcountries()
    {
        return $this->apiurlforcountries;
    }
}