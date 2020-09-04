<?php

namespace Tests\Api;

use App\Api\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{

    private $client;

    protected function setUp(): void
    {
        $this->client = (new Api(""))->getGuzzlehttp();
    }

    protected function tearDown(): void
    {
        $this->client = null;
    }

    public function testGetApi(): void
    {
        $response = $this->client->request("GET", "https://api.covid19api.com");

        $this->assertEquals(200, $response->getStatusCode());

        $typeContent = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json; charset=UTF-8", $typeContent);

        $this->assertTrue($response->hasHeader("Content-Type"));
    }

    public function testSummaryGetContentApi(): void
    {
        $response = $this->client->request("GET", "https://api.covid19api.com/summary");

        $this->assertEquals(200, $response->getStatusCode());

        $typeContent = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json; charset=UTF-8", $typeContent);

        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);

        $this->assertArrayHasKey("Countries", $data);

        $this->assertIsArray($data["Countries"]);

        // foreach ($data["Countries"] as $countrydata) {
        //     $this->assertArrayHasKey("Country", $countrydata);
        //     $this->assertArrayHasKey("Slug", $countrydata);
        //     $this->assertArrayHasKey("CountryCode", $countrydata);
        // }

        $this->assertArrayHasKey("Global", $data);

        $this->assertIsArray($data["Global"]);

        // $this->assertArrayHasKey("NewConfirmed", $data["Global"]);
        // $this->assertArrayHasKey("TotalConfirmed", $data["Global"]);
        // $this->assertArrayHasKey("NewDeaths", $data["Global"]);
        // $this->assertArrayHasKey("TotalDeaths", $data["Global"]);
        // $this->assertArrayHasKey("NewRecovered", $data["Global"]);
        // $this->assertArrayHasKey("TotalRecovered", $data["Global"]);
    }

    public function testCountriesGetContentApi(): void
    {
        $response = $this->client->request("GET", "https://api.covid19api.com/countries");

        $this->assertEquals(200, $response->getStatusCode());

        $datas = json_decode($response->getBody(), true);

        $this->assertIsArray($datas);

        // foreach ($datas as $data) {
        //     $this->assertArrayHasKey("Country", $data);
        //     $this->assertArrayHasKey("Slug", $data);
        //     $this->assertArrayHasKey("ISO2", $data);
        // }
    }
}