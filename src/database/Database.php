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

use cbi\payment\CompleteSCT;
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
    private $cm_stmt;
    private $sct_stmt;

    /**
     * Database constructor.
     * It creates the connection to the database and prepares the statements to insert the records.
     *
     * @param $server : The database server address
     * @param $database : The database server name
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

            //INSERT-statement for the whole movement in one table
            $this->cm_stmt = $this->conn->prepare("INSERT INTO `movimenti_completi` "
                . "(mc_data_valuta, mc_data_contabile, mc_segno, mc_importo, "
                . "mc_riferimento_banca, mc_tipo_riferimento_cliente, mc_descrizione_movimento, "
                . "mc_codice_fiscale_ordinante, mc_cliente_ordinante, mc_localita, "
                . "mc_indirizzo_ordinante, mc_IBAN_ordinante, mc_estero, mc_completato, mc_banca) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            //INSERT-statement for a payment
            $this->sct_stmt = $this->conn->prepare("INSERT INTO pagamenti_SCT "
                . "(p_IBAN_deb, p_IBAN_cre, p_importo, p_data_creazione, p_data_esecuzione, p_codiceCUC, p_nome_azienda_deb, "
                . "p_nome_azienda_cre, p_codifica_fiscale_deb, p_codifica_fiscale_cre, p_messaggio, p_dist_id) "
                . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        } catch (PDOException $e) {
            printf("A database error occurred: " . $e);
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
     * @param $date : The creation date of the document
     * @param $type : The type of the document and record_testa (RH, EC, RA, etc.)
     * @param $ofile : The file to upload
     * @return string: The index of the last inserted cbi record (the $blob)
     */
    public function uploadCbi($date, $type, $ofile) {

        $date = self::convertDate($date);
        $this->cbi_stmt->bindParam(1, $ofile, PDO::PARAM_LOB);
        $this->cbi_stmt->bindParam(2, $date);
        $this->cbi_stmt->bindParam(3, $type);
        $this->cbi_stmt->execute();

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
    public function uploadRecord($blob, $date, $type, $infos) {

        $date = self::convertDate($date);

        switch ($type) {
            case 'RH':
            case 'EC':
                $this->r_testa_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;
            case '61':
                $this->saldo_i_stmt->execute(array(serialize($blob), $date, $infos[0]));
                break;
            case '62':
                $this->r_mov_stmt->execute(array(serialize($blob), $date, $infos[0], $infos[1]));
                $infos[2] = $this->conn->lastInsertId();
                break;
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

    /**
     * This function uploads the movement with only needed information
     * @param CompleteMovement $cm : The whole movement as Object
     */
    public function uploadCompleteMovement(CompleteMovement $cm) {

        $this->cm_stmt->execute(array($cm->getDataValuta(), $cm->getDataContabile(), $cm->getISegno(),
            $cm->getImporto(), $cm->getRifBanca(), $cm->getTipoRifBanca(), $cm->getDes(),
            $cm->getCodFisOrd(), $cm->getClienteOrd(), $cm->getLocalita(), $cm->getIndirizzoOrd(),
            $cm->getIbanOrd(), $cm->getEstero(), $cm->getCompletato(), $cm->getBancaCliente()));
    }

    /**
     * This function is for fetching the movement records and their information and returning them in an array
     *
     * @param $cbi_id : The ID of the CBI document that the records are part of
     * @return array with the movement records and infos
     */
    public function queryMovements($cbi_id) {

        $sql62 = "SELECT rm_record, rm_id FROM record_movement WHERE rm_cbi = $cbi_id";
        $sqlSI = "SELECT rsi_record FROM record_saldo_iniziale WHERE rsi_cbi = $cbi_id";
        $ar = array();

        //this is needed for the bank information
        foreach ($this->conn->query($sqlSI) as $aSI) {
            $ar[] = $aSI['rsi_record'];
        }

        //get the movements + information
        foreach ($this->conn->query($sql62) as $a62) {

            $sql63 = "SELECT rmi_record FROM record_movement_info WHERE rmi_cbi = $cbi_id AND rmi_movement = $a62[rm_id]";
            $movInf = array();

            //get movement information of each movement
            foreach ($this->conn->query($sql63) as $a63) {

                $movInf[] = $a63['rmi_record'];
            }

            $ar[] = array($a62['rm_record'], $movInf);
        }

        return $ar;
    }

    public static $pi = 3.1415926535897932384626433832795028841971693993751058209749445923078164;

    /**
     * This function uploads the payment with only needed information
     * @param CompleteSCT $cs : The complete payment as an object
     * @param $dist_id : ID of the document it is part of
     */
    public function uploadCompleteSCT(CompleteSCT $cs, $dist_id) {

        $this->sct_stmt->execute(array($cs->getDebIBAN(), $cs->getCreIBAN(), $cs->getImporto(), $cs->getDataCrea(),
            $cs->getDataEsec(), $cs->getCodiceCUC(), $cs->getAziendaDeb(), $cs->getAziendaCre(),
            $cs->getCodificaFiscaleDeb(), $cs->getCodificaFiscaleCre(), $cs->getMessaggio(), $dist_id));
    }

    /**
     * This function is for fetching a payment
     * @param $csid : ID of the  payment to query
     * @return array|null : The payment as array
     */
    public function querySCT($csid) {

        $sql = "SELECT * FROM pagamenti_SCT WHERE p_id = $csid";

        foreach ($this->conn->query($sql) as $p)
            return $p;

        return null;
    }

    /**
     * This function is for fetching all the p_ids that have the right dist_id.
     * @param $dist_id : the dist_id to search for
     * @return array : the p_ids
     */
    public function querySCTIDs($dist_id) {

        $sql = "SELECT p_id FROM pagamenti_SCT WHERE p_dist_id = $dist_id";

        $ids = array();

        foreach ($this->conn->query($sql) as $id)
            $ids[] = $id;

        return $ids;
    }

    /**
     * Converting the dates from DDMMYY to YYYY-MM-DD
     * @param $date : The date DDMMYY
     * @return string : The date YYYY-MM-DD
     */
    public static function convertDate($date) {

        return substr(date("Y"), 0, 2) . substr($date, 4, 2)
            . "-" . substr($date, 2, 2) . "-" . substr($date, 0, 2);
    }

}