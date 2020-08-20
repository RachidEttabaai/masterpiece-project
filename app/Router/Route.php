<?php

namespace App\Router;

class Route
{

    private $name;
    private $callable;
    private $params = [];

    public function __construct(string $name, callable $callable, array $params)
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->params = $params;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCallable(): callable
    {
        return $this->callable;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
