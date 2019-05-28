<?php


class ConnectDatabase
{

    private $connection;

    public function __construct($server, $database, $user, $password)
    {

        try {

            $this->connection = new \PDO("mysql:host=$server;dbname=$database", $user, $password);

            $this->connection->query("SET NAMES utf8");
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {

            throw new Exception();

        }

    }


    public function getConnection()
    {
        return $this->connection;
    }

}