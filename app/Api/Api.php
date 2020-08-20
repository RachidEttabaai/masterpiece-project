<?php

namespace App\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ServerException;

class Api
{

    private $apiurl;

    private $guzzlehttp;

    public function __construct(string $apiurl)
    {
        $this->apiurl = $apiurl;
        $this->guzzlehttp = new Client();
    }

    /**
     * Get the value of guzzlehttp
     */
    public function getGuzzlehttp()
    {
        return $this->guzzlehttp;
    }

    /**
     * Get the value of apiurl
     */
    public function getApiurl()
    {
        return $this->apiurl;
    }
    
    /**
     * Doing an api request and get datas from the api
     *
     * @return array
     */
    public function apirequest(): array
    {
        $client = $this->getGuzzlehttp();
        $apiurl = $this->getApiurl();

        $request = new Request("GET", $apiurl);

        $res = [];

        try {

            $promise = $client->sendAsync($request)->then(
                function ($response) {
                    return json_decode($response->getBody(), true);
                }
            );
    
            $res = $promise->wait();

        } catch (ServerException $e) {
            
            $res = ["error" => $e->getMessage()];
        }

        return $res;

    }
}
