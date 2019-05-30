<?php

namespace cbi\database;

use PDO;
use PDOException;

class Database
{

    private $conn;
    private $stmt;

    public function __construct($server, $database, $username, $password, $stmt)
    {

        try {
            $this->conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
            $this->conn->query("SET NAMES utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->stmt = $this->conn->prepare($stmt);
        } catch (PDOException $e) {
            printf($e);
        }

    }


    public function getConnection()
    {
        return $this->conn;
    }

    function uploadToDatabase($upload)
    {
        $this->stmt->execute($upload);
    }

}