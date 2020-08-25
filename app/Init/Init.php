<?php

namespace App\Init;

use App\Router\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * App initialization
 */
class Init
{

    /**
     * Modules' list
     *
     * @var array
     */
    private $modules = [];

    private $router;

    public function __construct(array $modules = [],array $dependencies = [])
    {
        $this->router = new Router();

        foreach ($modules as $module) {
            $this->modules[] = new $module($this->router,$dependencies["renderer"]);
        }
    }

    /**
     * URI Management
     *
     * @param  ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {

        $uri = $request->getUri()->getPath();
        
        if (!empty($uri) && $uri[-1] === "/") {
            $response = new Response();
            $response = $response->withStatus(301);
            $response = $response->withHeader("Location", "/index");
            return $response;
        }

        $route = $this->router->match($request);

        if (is_null($route)) {
            $response = new Response();
            $response = $response->withStatus(301);
            $response = $response->withHeader("Location", "/index");
            return $response;
        }

        $response = call_user_func_array($route->getCallable(), [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception("Houston we have got a probleme!!!");
        }
    }
}
