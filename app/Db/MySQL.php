<?php

namespace App\Db;

use PDO;
use PDOException;
use Psr\Container\ContainerInterface;

class MySQL implements Db
{
    /* 
    Object representing a connection between PHP and a database server.
    @var PDO|null 
    */
    protected $pdo;

    public function __construct(ContainerInterface $container)
    {
        if (!$container) {
            $this->pdo = $this->connect(
                $container->get("database.dns"),
                $container->get("database.username"),
                $container->get("database.pwd"),
                $container->get("database.options")
            );
        } else {
            $this->pdo = $this->connect(
                Db::DB_DNS,
                Db::DB_USER,
                Db::DB_PWD,
                Db::DB_OPTIONS
            );
        }
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
     * @param string $selectsqlquery
     * @return array
     */
    public function selectquery(string $selectsqlquery): array
    {
        $stmtselect = $this->pdo->query($selectsqlquery);
        $stmtselect->execute();
        $getresquery = $stmtselect->fetchAll();
        $stmtselect->closeCursor();
        return $getresquery;
    }

    /**
     * Doing a select query for getting the count of records in a table
     *
     * @param string $countsqlquery
     * @return integer
     */
    public function countquery(string $countsqlquery): int
    {
        $stmtcount = $this->pdo->prepare($countsqlquery);
        $stmtcount->execute();
        $countcountries = $stmtcount->columnCount();
        $stmtcount->closeCursor();
        return $countcountries;
    }

    /**
     * Doing an insert query for adding data from an API to the database
     *
     * @param string $insertsqlquery
     * @param array $datas
     * @return void
     */
    public function insertquery(string $insertsqlquery, array $datas): void
    {
        $stmtinsert = $this->pdo->prepare($insertsqlquery);
        $stmtinsert->execute($datas);
        $stmtinsert->closeCursor();
    }
}