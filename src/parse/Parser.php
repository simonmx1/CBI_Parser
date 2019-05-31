<?php

/**
 * Parse.php
 *
 * Manages the Parser for the CBI-standard and the upload to the Database
 *
 * @package    src/parse
 * @author     Simon Muscatello
 */

namespace cbi\parse;

use cbi\database\Database;
use Exception;

class Parser {

    private $db;

    /**
     * Parser constructor.
     * The connection to the database is initiated and the file is passed on to the actual parsing class.
     * Then the parsed document is passed on to prepare the upload.
     *
     * @param $server : The database server address
     * @param $database : The database server name
     * @param $username : The username to access the database
     * @param $password : The password to access the database
     * @param $filename : Name of the file containing the CBI records
     */
    function __construct($server, $database, $username, $password, $filename) {

        try {
            $this->db = new Database($server, $database, $username, $password);
        } catch (Exception $e) {
        }

        $file = Cbi::fromFile($filename);

        $s = sizeof($file->record()) - 2;
        var_dump($file->record()[$s]->_root->_raw_record()[$s]);

        $this->uploadToDB($file);


    }

    /**
     * This function extracts the information needed, to upload a record to the database
     *
     * @param $file : The CBI document
     */
    function uploadToDB($file) {

        $date = $file->record()[0]->content()->dataCreazione();
        $cbi_type = $file->record()[0]->tipoRecord();

        $cbi_num = $this->db->uploadCbi($file, $date, $cbi_type);

        $infos = array($cbi_num, true, 0);
        for ($i = 0; $i < sizeof($file->record()); $i++) {

            $infos[2] = $this->db->uploadRecord($file->record()[$i]->_root->_raw_record()[$i],
                $date, $file->record()[$i]->tipoRecord(), $infos);
            printf($i);

        }
        printf("Upload finished");
    }

}