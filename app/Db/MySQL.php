<?php

namespace App\Db;

use PDO;
use App\Db\Db;
use PDOException;

class MySQL implements Db
{
    /* 
    Object representing a connection between PHP and a database server.
    @var PDO|null 
    */
    protected $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect(Db::DB_DNS, Db::DB_USER, Db::DB_PWD, Db::DB_OPTIONS);
    }

    /**
     * Connection to the database with PDO object
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

    /**
     * Doing a select query and return query result
     *
     * @param string $sqlquery
     * @return array
     */
    public function selectquery(string $sqlquery): array
    {
        $stmtquery = $this->pdo->query($sqlquery);
        $stmtquery->execute();
        $getresquery = $stmtquery->fetchAll();
        $stmtquery->closeCursor();
        return $getresquery;
    }

    public function countquery(string $sqlquery): int
    {
        $stmtcount = $this->pdo->prepare($sqlquery);
        $stmtcount->execute();
        $countcountries = $stmtcount->columnCount();
        $stmtcount->closeCursor();
        return $countcountries;
    }
}