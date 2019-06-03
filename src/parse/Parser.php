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

use cbi\database\CompleteMovement;
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
     * @param $filenames : Names of the files containing the CBI records
     */
    public function __construct($server, $database, $username, $password, $filenames) {

        try {
            $this->db = new Database($server, $database, $username, $password);
        } catch (Exception $e) {
        }

        //Parse all files
        for ($i = 0; $i < sizeof($filenames); $i++) {

            $file = Cbi::fromFile($filenames[$i]);

            $cbi = $this->uploadToDB($file, fopen($filenames[$i], 'rb'));

            $this->uploadCompleteMovements($cbi);

        }

    }

    /**
     * This function extracts the information needed, to upload a record to the database
     *
     * @param $file : The CBI document
     * @param $ofile : The same document, but different
     * @return string : ID of the CBI document that has been uploaded
     */
    private function uploadToDB($file, $ofile) {

        $date = $file->record()[0]->content()->dataCreazione();

        //save whole CBI document to the database and get the index for the other records
        $cbi_num = $this->db->uploadCbi($date, $file->record()[0]->tipoRecord(), $ofile);

        //infos are needed for some records
        $infos = array($cbi_num, true, 0);


        /*  var_dump($file->record()[2]->content()->dataContabile());
          $file->record()[$i]->content()->dataContabile()
          > date("Y-m-d"), */


        //read all the single records and insert them into the database
        for ($i = 0; $i < sizeof($file->record()); $i++) {
            $infos[2] = $this->db->uploadRecord($file->record()[$i]->_root->_raw_record()[$i], $date,
                $file->record()[$i]->tipoRecord(), $infos);

        }
        printf("Upload finished\n");
        return $cbi_num;
    }

    /**
     * Upload the movement without
     * @param $cbi : The CBI document the movement is part of
     */
    private function uploadCompleteMovements($cbi) {

        $mov = $this->db->queryMovements($cbi);
        for ($i = 0; $i < sizeof($mov); $i++) {

            $cm = new CompleteMovement($mov[$i][0], $mov[$i][1]);
            $this->db->uploadCompleteMovement($cm);

        }
    }

}