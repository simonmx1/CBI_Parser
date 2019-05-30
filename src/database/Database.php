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
    private $r_coda_stmt;

    public function __construct($server, $database, $username, $password) {

        try {
            $this->conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
            $this->conn->query("SET NAMES utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Prepare INSERT-statements for the records
            $this->cbi_stmt = $this->conn->prepare("INSERT INTO cbi"
                . "(m_movements, m_date) VALUES (?, ?)");
            $this->r_testa_stmt = $this->conn->prepare("INSERT INTO record_testa "
                . "(rt_record, rt_date, rt_cbi) VALUES (?, ?, ?)");
            $this->saldo_i_stmt = $this->conn->prepare("INSERT INTO saldo_iniziale "
                . "(si_record, si_date, si_cbi) VALUES (?, ?, ?)");
            $this->r_mov_stmt = $this->conn->prepare("INSERT INTO record_movement "
                . "(rm_record, rm_date, rm_cbi, rm_transferred) VALUES (?, ?, ?, ?)");
            $this->r_mov_info_stmt = $this->conn->prepare("INSERT INTO record_movement_info "
                . "(rmi_record, rmi_date, rmi_cbi, rmi_movement) VALUES (?, ?, ?, ?)");
            $this->saldo_f_stmt = $this->conn->prepare("INSERT INTO saldo_finale "
                . "(sf_record, sf_date, sf_cbi) VALUES (?, ?, ?)");
            $this->r_coda_stmt = $this->conn->prepare("INSERT INTO record_coda "
                . "(rc_record, rc_date, rc_cbi) VALUES (?, ?, ?)");

        } catch (PDOException $e) {
            printf($e);
        }

    }


    public function getConnection() {

        return $this->conn;
    }

    function uploadCbi($blob) {

        $this->cbi_stmt->execute($blob);
    }

    function uploadRecordTesta($blob) {

        $this->r_testa_stmt->execute($blob);
    }

    function uploadSaldoIniziale($blob) {

        $this->saldo_i_stmt->execute($blob);
    }

    function uploadRecordMovement($blob) {

        $this->r_mov_stmt->execute($blob);
    }

    function uploadRecordMovementInfo($blob) {

        $this->r_mov_info_stmt->execute($blob);
    }

    function uploadSaldoFinale($blob) {

        $this->saldo_f_stmt->execute($blob);
    }

    function uploadRecordCoda($blob) {

        $this->r_coda_stmt->execute($blob);
    }
}