<?php

/**
 * Database.php
 *
 * Database connection and INSERT functions
 *
 * @package    src/database
 * @author     Simon Muscatello
 */

namespace cbi\database;

use PDO;
use PDOException;

class Database {

    private $conn;
    private $cbi_stmt;
    private $r_testa_stmt;
    private $saldo_i_stmt;
    private $r_mov_stmt;
    private $r_mov_info_stmt;
    private $saldo_f_stmt;
    private $r_liq_fut_stmt;
    private $r_coda_stmt;

    /**
     * Database constructor.
     * It builds the connection to the database and creates the statement for inserting hte records.
     *
     * @param $server : The database server address
     * @param $database : The databse server name
     * @param $username : The username to access the database
     * @param $password : The password to access the database
     */
    public function __construct($server, $database, $username, $password) {

        try {
            //Build connection to the database
            $this->conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
            $this->conn->query("SET NAMES utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Prepare INSERT-statements for the records
            $this->cbi_stmt = $this->conn->prepare("INSERT INTO cbi"
                . "(cbi_doc, cbi_date, cbi_type) VALUES (?, ?, ?)");
            $this->r_testa_stmt = $this->conn->prepare("INSERT INTO record_testa "
                . "(rt_record, rt_date, rt_cbi) VALUES (?, ?, ?)");
            $this->saldo_i_stmt = $this->conn->prepare("INSERT INTO record_saldo_iniziale "
                . "(rsi_record, rsi_date, rsi_cbi) VALUES (?, ?, ?)");
            $this->r_mov_stmt = $this->conn->prepare("INSERT INTO record_movement "
                . "(rm_record, rm_date, rm_cbi, rm_transferred) VALUES (?, ?, ?, ?)");
            $this->r_mov_info_stmt = $this->conn->prepare("INSERT INTO record_movement_info "
                . "(rmi_record, rmi_date, rmi_cbi, rmi_movement) VALUES (?, ?, ?, ?)");
            $this->saldo_f_stmt = $this->conn->prepare("INSERT INTO record_saldo_finale "
                . "(rsf_record, rsf_date, rsf_cbi) VALUES (?, ?, ?)");
            $this->r_coda_stmt = $this->conn->prepare("INSERT INTO record_coda "
                . "(rc_record, rc_date, rc_cbi) VALUES (?, ?, ?)");
            $this->r_liq_fut_stmt = $this->conn->prepare("INSERT INTO record_liquidita_future "
                . "(rlf_record, rlf_date, rlf_cbi) VALUES (?, ?, ?)");

        } catch (PDOException $e) {
            printf($e);
        }

    }

    /**
     * @return PDO: The connection to the database.
     */
    public function getConnection() {

        return $this->conn;
    }

    /**
     * This function uploads the whole CBI Document to the Database and returns it's index.
     *
     * @param $blob : The document as blob
     * @param $date : The creation date of the document
     * @param $type : The type of the document and record_testa(RH, EC, RA, etc.)
     * @return string: The index of the last inserted cbi record (the $blob)
     */
    function uploadCbi($blob, $date, $type) {

        $date = substr(date("Y"), 0, 2) . substr($date, 4, 2)
            . "-" . substr($date, 2, 2) . "-" . substr($date, 0, 2);

        if ($type != "EC")
            $this->cbi_stmt->execute(array(serialize($blob), $date, $type));
        else {
            if ($date == "2019-04-01")
                $doc = fopen('/home/simon/Desktop/CBI/records/06045_06045E8330_'
                    . 'REND-EC_20190401_3714_p2_INFO.T190920238325.MOV.txt', 'rb');
            else
                $doc = fopen('/home/simon/Desktop/CBI/records/06045_06045E8330'
                    . '_REND-EC_20190502_2735_p2_INFO.T191230507243.MOV.txt', 'rb');
            $this->cbi_stmt->bindParam(1, $doc, PDO::PARAM_LOB);
            $this->cbi_stmt->bindParam(2, $date);
            $this->cbi_stmt->bindParam(3, $type);
            $this->cbi_stmt->execute();

        }

        return $this->conn->lastInsertId();
    }

    /**
     * This function gets all types of records and decides into which table it has to be inserted.
     * Then it uses the statements created in the __construct() to upload the record.
     *
     * @param $blob : The raw record
     * @param $date : The creation date of the record
     * @param $type : The type of the record (RH, EF, 62, etc.)
     * @param $infos : Information like movement transferred or the foreign keys
     * @return string : Returns the id of the last movement made
     */
    function uploadRecord($blob, $date, $type, $infos) {

        $date = substr(date("Y"), 0, 2) . substr($date, 4, 2)
            . "-" . substr($date, 2, 2) . "-" . substr($date, 0, 2);

        switch ($type) {
            case 'RH':
                $this->r_testa_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;
            case 'EC':
                $this->r_testa_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;
            case '61':
                $this->saldo_i_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;
            case '62':
                $this->r_mov_stmt->execute(array(serialize($blob), $date, $infos[0], $infos[1]));
                return $this->conn->lastInsertId();
            case '63':
                $this->r_mov_info_stmt->execute(array(serialize($blob), $date, $infos[0], $infos[2]));
                break;
            case '64':
                $this->saldo_f_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;
            case '65':
                $this->r_liq_fut_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;
            case 'EF':
                $this->r_coda_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;

        }
        return $infos[2];
    }

}