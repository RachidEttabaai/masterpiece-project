<?php

use App\Init\Init;
use App\Map\MapModule;
use App\Home\HomeModule;
use App\About\AboutModule;
use App\ApiData\ApiDataModule;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$init = new Init([HomeModule::class,ApiDataModule::class,MapModule::class,AboutModule::class]);
$response = $init->run(ServerRequest::fromGlobals());
send($response);
