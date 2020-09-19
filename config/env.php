<?php

use App\Db\DbFactory;
use function DI\factory;

if (getenv("REMOTE_ADDR") == "127.0.0.1") {

    return [
        "database.host" => "localhost",
        "database.name" => "covid19dashboard",
        "database.username" => "root",
        "database.pwd" => "root",
        "database.dns" => factory([DbFactory::class, "getDNS"]),
        "database.options" => factory([DbFactory::class, "getDbOptions"])
    ];
} else {
    return [];
}