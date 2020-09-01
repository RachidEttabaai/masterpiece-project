<?php

namespace App\Api;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ServerException;
use Kevinrob\GuzzleCache\CacheMiddleware;

class Api
{

    private $apiurl;

    private $guzzlehttp;

    private $stack;

    public function __construct(string $apiurl)
    {
        $this->stack = HandlerStack::create();
        $this->stack->push(new CacheMiddleware(), 'cache');
        $this->apiurl = $apiurl;
        $this->guzzlehttp = new Client(['handler' => $this->stack]);
    }

    /**
     * Get the value of guzzlehttp
     */
    public function getGuzzlehttp(): Client
    {
        return $this->guzzlehttp;
    }

    /**
     * Get the value of apiurl
     */
    public function getApiurl(): string
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