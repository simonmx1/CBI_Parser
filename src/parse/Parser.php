<?php

namespace cbi\parse;

use cbi\database\ConnectDatabase;
use Exception;

class Parser
{
    private $connection;

    function __construct($dbserver, $database, $user, $password, $filename)
    {
        try {
            $this->connection = (new ConnectDatabase($dbserver, $database, $user, $password))->getConnection();
        } catch (Exception $e) {
        }

        $file = Cbi::fromFile($filename);

        $stream = fopen('php://memory','r+');
        fwrite($stream, $file);
        rewind($stream);

        var_dump($file);
        printf("hello");
    }

}