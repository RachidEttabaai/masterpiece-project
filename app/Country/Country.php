<?php

namespace App\Country;

use App\Api\Api;
use App\Db\MySQL;

class Country extends MySQL
{
    /**
     * API url
     *
     * @var string|null
     */
    private $apiurlforcountries;

    public function __construct(?string $apiurlforcountries)
    {
        parent::__construct();
        $this->apiurlforcountries = $apiurlforcountries;
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
                $coordonnesgpsforcountriesapi = new Api("https://restcountries.eu/rest/v2/alpha/" . $apidatatable["ISO2"]);

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
        $querycountcountries = "SELECT COUNT(*) AS Nbcountries FROM Country";
        $stmtcount = $this->pdo->prepare($querycountcountries);
        $stmtcount->execute();
        $countcountries = $stmtcount->fetch();
        $stmtcount->closeCursor();
        return $countcountries["Nbcountries"];
    }

    /**
     * Insert data from an API in the database
     *
     * @return void
     */
    public function insertCountriesDatastoDB(): void
    {

        $countriesdatas = $this->getAllCountriesFromAPI();

        foreach ($countriesdatas as $countrydatas) {
            $insertcountry = "INSERT INTO Country(country_name,country_slug,country_code,latitude,longitude)
                                     VALUES (:country_name,:country_slug,:country_code,:latitude,:longitude)";
            $pdostatementinsert = $this->pdo->prepare($insertcountry);
            $pdostatementinsert->bindParam(":country_name", $countrydatas["country_name"]);
            $pdostatementinsert->bindParam(":country_slug", $countrydatas["country_slug"]);
            $pdostatementinsert->bindParam(":country_code", $countrydatas["country_code"]);
            $pdostatementinsert->bindParam(":latitude", $countrydatas["latitude"]);
            $pdostatementinsert->bindParam(":longitude", $countrydatas["longitude"]);
            $pdostatementinsert->execute();
            $pdostatementinsert->closeCursor();
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