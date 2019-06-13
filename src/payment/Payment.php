<?php

/**
 * Payment.php
 *
 * The main class to create and process a Payment.
 *
 * @package    src/payment
 * @author     Simon Muscatello
 */

namespace cbi\payment;

use cbi\database\Database;
use Exception;

class Payment {

    private $db;

    /**
     * Payment constructor.
     * The connection to the database is initiated and a CompleteSCT is created.
     * Then the SEPA CREDIT TRANSFER is being stored in the database.
     *
     * @param $database : Contains all the information for the database connection
     * @param $sctInfos : Contains all the information for the SCT-Payment
     */
    function __construct($database, $sctInfos) {

        try {
            $this->db = new Database($database['server'], $database['database'], $database['username'], $database['password']);
        } catch (Exception $e) {
        }

        $sct = new CompleteSCT($sctInfos['importo'], $sctInfos['deb'], $sctInfos['cre'], $sctInfos['dataEsec'], $sctInfos['msg']);

        $dist_id = 1;

        $this->db->uploadCompleteSCT($sct, $dist_id);

        $payments = array();

        $sctIds = $this->db->querySCTIDs($dist_id);

        for ($i = 0; $i < sizeof($sctIds); $i++)
            $payments[] = $this->db->querySCT($sctIds[$i]["p_id"]);

        new SEPAXMLCreator($payments);
    }

}