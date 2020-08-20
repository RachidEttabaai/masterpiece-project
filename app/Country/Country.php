<?php

namespace App\Country;

use App\Api\Api;
use App\Db\MySQL;

class Country extends MySQL
{

    private $apiurlforcountries;

    public function __construct(?string $apiurlforcountries)
    {
        parent::__construct();
        $this->apiurlforcountries = $apiurlforcountries;
    }

    private function getAllCountriesFromAPI(): array
    {
        
        $countriesapi = new Api($this->getApiurlforcountries());
        
        $countries = $countriesapi->apirequest();

        $arrres = [];

        foreach ($countries as $country) {
            if ($country["ISO2"] != "AN") {
                $coordonnesgpsforcountriesapi = new Api("https://restcountries.eu/rest/v2/alpha/".$country["ISO2"]);
            
                $coordonnesgpsforcountries = $coordonnesgpsforcountriesapi->apirequest();
                
                $latitude = $coordonnesgpsforcountries["latlng"][0];
                $longitude = $coordonnesgpsforcountries["latlng"][1];
            } else {
                $latitude =  12.226079;
                $longitude = -69.060087;
            }

            $countrydatas = ["country_name" => $country["Country"],
                             "country_slug" => $country["Slug"],
                             "country_code" => $country["ISO2"],
                             "latitude" => $latitude,
                             "longitude" => $longitude];
            
            array_push($arrres, $countrydatas);
        }

        return $arrres;
    }

    public function getAllCountriesFromDB(): array
    {
        $querygetallcountries = "SELECT * FROM Country ORDER BY country_name";
        $stmtgetall = $this->pdo->prepare($querygetallcountries);
        $stmtgetall->execute();
        $getallcountries = $stmtgetall->fetchAll();
        $stmtgetall->closeCursor();
        return $getallcountries;
    }

    public function countCountriesinDB(): int
    {
        $querycountcountries = "SELECT COUNT(*) AS Nbcountries FROM Country";
        $stmtcount = $this->pdo->prepare($querycountcountries);
        $stmtcount->execute();
        $countcountries = $stmtcount->fetch();
        $stmtcount->closeCursor();
        return $countcountries["Nbcountries"];
    }

    public function insertCountriesDatastoDB()
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
     */
    public function getApiurlforcountries()
    {
        return $this->apiurlforcountries;
    }
}
