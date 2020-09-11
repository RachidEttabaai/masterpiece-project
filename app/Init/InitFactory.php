<?php

namespace App\Init;

use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;

class InitFactory
{
    public function __invoke(ContainerInterface $container): void
    {
        $init = new Init($container);
        $response = $init->run(ServerRequest::fromGlobals());
        send($response);
    }
}