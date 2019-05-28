<?php


class Parser
{
    private $connection;
    private $dbserver = "localhost";
    private $database = "cbi_movements";
    private $user = "root";
    private $password = "";

    function __construct()
    {
        try {
            $this->connection = (new ConnectDatabase($this->dbserver, $this->database, $this->user, $this->password))->getConnection();
        } catch (Exception $e) {
        }



    }

}