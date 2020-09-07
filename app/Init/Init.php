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

    /**
     * Router
     *
     * @var Router
     */
    private $router;

    public function __construct(array $modules = [], array $dependencies = [])
    {
        $this->router = new Router();
        if (!empty($modules)) {

            foreach ($modules as $module) {
                $this->modules[] = new $module($this->router, $dependencies["renderer"]);
            }
        }
    }

    /**
     * URI Redirection
     *
     * @param integer $statusCode
     * @param string $uri
     * @return Response
     */
    private function redirectUri(int $statusCode, string $uri): Response
    {
        $response = new Response();
        $response = $response->withStatus($statusCode);
        $response = $response->withHeader("Location", $uri);
        return $response;
    }

    /**
     * Checking the response of the request and return the result
     *
     * @param mixed $response
     * @return ResponseInterface
     */
    private function ckeckRequestResponse($response): ResponseInterface
    {
        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception("Houston we have got a probleme!!!");
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
            //echo rtrim($uri, "/");
            return $this->redirectUri(301, rtrim($uri, "/"));
        }

        $route = $this->router->match($request);

        if (is_null($route)) {
            return $this->redirectUri(404, "/error");
        } else {

            $response = call_user_func_array($route->getCallable(), [$request]);

            return $this->ckeckRequestResponse($response);
        }
    }
}