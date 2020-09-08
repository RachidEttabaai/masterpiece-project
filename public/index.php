<?php

use App\Init\Init;
use App\Map\MapModule;
use App\Home\HomeModule;
use App\About\AboutModule;
use App\Renderer\TwigRenderer;
use App\ApiData\ApiDataModule;
use App\Error\ErrorModule;

use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$defaultpathforviews = dirname(__DIR__) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "templates";

$defaultpathforerrors = $defaultpathforviews . DIRECTORY_SEPARATOR . "errors";

$tabpaths = [$defaultpathforviews, $defaultpathforerrors];

$renderer = new TwigRenderer($tabpaths);

$listmodules = [
    HomeModule::class,
    ApiDataModule::class,
    MapModule::class,
    AboutModule::class,
    ErrorModule::class
];

$listrenderer = ["renderer" => $renderer];

$init = new Init($listmodules, $listrenderer);
$response = $init->run(ServerRequest::fromGlobals());
send($response);