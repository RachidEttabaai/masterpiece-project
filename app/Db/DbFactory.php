<?php

namespace App\Db;

use PDO;
use Psr\Container\ContainerInterface;

class DbFactory
{
    public function getDNS(ContainerInterface $container): string
    {
        return "mysql:host=" . $container->get("database.host") . ";dbname=" . $container->get("database.name");
    }

    public function getDbOptions(): array
    {
        return [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
    }
}