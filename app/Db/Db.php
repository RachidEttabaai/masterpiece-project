<?php

namespace App\Db;

use PDO;

interface Db
{

    const DB_HOST = "localhost";
    const DB_NAME = "covid19dashboard";
    const DB_USER = "root";
    const DB_PWD = "root";
    const DB_DNS = "mysql:host=" . Db::DB_HOST . ";dbname=" . Db::DB_NAME;
    const DB_OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
}