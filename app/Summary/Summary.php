<?php

namespace App\Summary;

use App\Api\Api;

class Summary
{

    private $apiurlforsummary;

    public function __construct(string  $apiurlforsummary)
    {
        $this->apiurlforsummary = $apiurlforsummary;
    }

    public function getSummaryFromAPI(): array
    {
        $summaryapi = new Api($this->getApiurlforsummary());

        return $summaryapi->apirequest();
    }

    /**
     * Get the value of apiurlforsummary
     */
    public function getApiurlforsummary()
    {
        return $this->apiurlforsummary;
    }
}
