<?php

namespace Tests\Router;

use App\Router\Router;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\ServerRequest;

class RouterTest extends TestCase
{

    private $router;

    protected function setUp(): void
    {
        $this->router = new Router();
    }

    protected function tearDown(): void
    {
        $this->router = null;
    }

    public function testGetDemoMethod(): void
    {
        $request = new ServerRequest("GET", "/demo");
        $this->router->get("/demo", function () {
            return "Demo";
        }, "demo");
        $route = $this->router->match($request);
        $this->assertEquals("demo", $route->getName());
        $this->assertEquals("Demo", call_user_func_array($route->getCallable(), [$request]));
    }

    public function testGetMethodNotExist(): void
    {
        $request = new ServerRequest("GET", "/demo");
        $this->router->get("/demodfdf", function () {
            return "Demo";
        }, "demo");
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }
}