<?php

namespace App\Router;

class Route
{

    /**
     * Route's name
     *
     * @var string
     */
    private $name;

    /**
     * Route's callable
     *
     * @var callable
     */
    private $callable;

    /**
     * Route's parameters
     *
     * @var array
     */
    private $params = [];

    public function __construct(string $name, callable $callable, array $params)
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->params = $params;
    }

    /**
     * Get the route's name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the route's callable
     *
     * @return callable
     */
    public function getCallable(): callable
    {
        return $this->callable;
    }

    /**
     * Get the route's parameters
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}