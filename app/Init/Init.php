<?php

namespace App\Init;

use App\Router\Router;
use GuzzleHttp\Psr7\Response;
use App\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;
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

    /**
     * Dependency injection container
     *
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->router = $this->container->get(Router::class);

        if ($this->container->has(RendererInterface::class)) {
            $this->container->get(RendererInterface::class)->addGlobal("router", $this->router);
        }

        $modules = $this->container->get("listmodules");

        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = new $module($this->container);
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
            throw new \Exception("Houston we have got a problem!!!");
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