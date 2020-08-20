<?php

namespace App\Db;

use PDO;
use App\Db\Db;
use PDOException;

class MySQL implements Db
{
    
    protected $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect(Db::DB_DNS, Db::DB_USER, Db::DB_PWD, Db::DB_OPTIONS);
    }

    /**
     * Connection to the database with PDO class
     *
     * @param  string $dns
     * @param  string $user
     * @param  string $pwd
     * @param  array  $options
     * @return PDO|null
     */
    public function connect(string $dns, string $user = '', string $pwd = '', array $options = []): ?PDO
    {
        try {
            $connect = new PDO($dns, $user, $pwd, $options);
        } catch (PDOException $ex) {
            die("Error while connection to the database !!!!!" . $ex->getMessage());
        }
        
        return $connect;
    }
}
