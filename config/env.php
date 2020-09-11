<?php

use PDO;
use Psr\Container\ContainerInterface;

return [
    "database.host" => "localhost",
    "database.name" => "covid19dashboard",
    "database.username" => "root",
    "database.pwd" => "root",
    "database.dns" => function (ContainerInterface $container) {
        return "mysql:host=" . $container->get("database.host") . ";dbname=" . $container->get("database.name");
    },
    "database.options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];