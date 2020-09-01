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

    public function testGetContentApi(): void
    {
        $response = $this->client->request("GET", "https://api.covid19api.com/summary");

        $this->assertEquals(200, $response->getStatusCode());

        $typeContent = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json; charset=UTF-8", $typeContent);

        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey("Countries", $data);
        $this->assertArrayHasKey("Global", $data);
    }
}