<?php

namespace App\Api;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ServerException;
use Kevinrob\GuzzleCache\CacheMiddleware;

class Api
{
    /**
     * API url
     *
     * @var string|null
     */
    private $apiurl;

    /**
     * Client object from GuzzleHttp
     *
     * @var Client
     */
    private $guzzlehttp;

    /**
     * HandlerStack object who creates a composed Guzzle handler function by 
     * stacking middlewares on top of an HTTP handler function.
     * 
     * @var HandlerStack
     */
    private $stack;

    public function __construct(?string $apiurl)
    {
        $this->stack = HandlerStack::create();
        $this->stack->push(new CacheMiddleware(), 'cache');
        $this->apiurl = $apiurl;
        $this->guzzlehttp = new Client(['handler' => $this->stack]);
    }

    /**
     * Get the value of guzzlehttp
     * 
     * @return Client
     */
    public function getGuzzlehttp(): Client
    {
        return $this->guzzlehttp;
    }

    /**
     * Get the value of apiurl
     * 
     * @return string|null
     */
    public function getApiurl(): ?string
    {
        return $this->apiurl;
    }

    /**
     * Send an HTTP request for getting data from an API
     *
     * @param Request $request
     * @return array
     */
    private function sendRequest(Request $request): array
    {
        $resrequest = [];

        $client = $this->getGuzzlehttp();

        try {

            $promise = $client->sendAsync($request)->then(
                function ($response) {
                    return json_decode($response->getBody(), true);
                }
            );

            $resrequest = $promise->wait();
        } catch (ServerException $e) {

            $resrequest = ["message" => $e->getMessage()];
        }

        return $resrequest;
    }

    /**
     * Doing an api request and get datas from the api
     *
     * @return array
     */
    public function apirequest(): array
    {

        $apiurl = $this->getApiurl();

        $res = [];

        if (!is_null($apiurl)) {

            $request = new Request("GET", $apiurl);
            $res = $this->sendRequest($request);
        } else {

            $res = ["message" => "Problem with the API url"];
        }

        return $res;
    }
}