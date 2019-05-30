<?php

/**
 * index.php
 *
 * Main php-file to start the CBI-Parse-application
 *
 * @package    public
 * @author     Simon Muscatello
 */

namespace cbi\parse;

use cbi\database\Database;
use Exception;

class Parser {

    private $db;

    function __construct($server, $database, $user, $password, $filename) {

        try {
            $this->db = new Database($server, $database, $user, $password);
        } catch (Exception $e) {
        }

        $file = Cbi::fromFile($filename);

        ///$this->db->uploadCbi(array(serialize($file), "2019-05-27"));

        //var_dump($file);
        var_dump($file->record()[4]->content()->saldoContabile());
        var_dump($file->record()[4]->_root->_raw_record()[4]);
        //printf("mittente: " . $file->__get("record")[0]->__get("content")->__get("mittente") . "\n");
        //printf("ricevente: " . $file->__get("record")[0]->__get("content")->__get("ricevente") . "\n");
        //var_dump($file->__get("record")[12]->__get("content")->__get("numeroProgressivo") . "\n");

        printf(var_dump($file->__get("_m_record")));

    }

}