<?php

namespace cbi\parse;

use cbi\database\Database;
use Exception;

class Parser
{
    private $db;

    function __construct($server, $database, $user, $password, $filename)
    {
        try {
            $this->db = (new Database($server, $database, $user, $password, "INSERT INTO cbi (m_movements, m_date) VALUES (?, ?)"));
        } catch (Exception $e) {
        }

        $file = Cbi::fromFile($filename);

        $this->db->uploadToDatabase(array(serialize($file), "2019-05-27"));


        var_dump($file->__get("record")[4]->__get("tipoRecord"));

        printf(var_dump($file->__get("_m_record")));


    }

}