<?php

namespace App\Summary;

use App\Api\Api;

class Summary
{
    /**
     * API url
     *
     * @var string
     */
    private $apiurlforsummary;

    public function __construct(string  $apiurlforsummary)
    {
        $this->apiurlforsummary = $apiurlforsummary;
    }

    /**
     * Get data from an API
     *
     * @return array
     */
    public function getSummaryFromAPI(): array
    {
        $summaryapi = new Api($this->getApiurlforsummary());

        return $summaryapi->apirequest();
    }

    /**
     * Get the value of apiurlforsummary
     * 
     * @return string
     */
    public function getApiurlforsummary()
    {
        return $this->apiurlforsummary;
    }
}