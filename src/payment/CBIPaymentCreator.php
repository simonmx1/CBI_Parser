<?php

/**
 * CBIPaymentCreator.php
 *
 * From the Database to the records.
 *
 * @package    src/payment
 * @author     Simon Muscatello
 *
 * @deprecated since 2013, replaced with SEPA-XML-Standard
 *
 */

namespace cbi\payment;

class CBIPaymentCreator {

    private $cp;
    private $recordAP;
    private $records;
    private $recordEF;
    private $importoTotPos = 0;
    private $numRec = 0;
    private $numDisp = 0;

    /**
     * CBIPaymentCreator constructor.
     * Creates an output file and converts the information from the database to the records.
     * Then the records are being written to the output file.
     *
     * @param $payments : the payments in an array
     *
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    public function __construct($payments) {

        $this->cp = $payments[0];

        $this->recordAP = $this->recordAP();

        $this->records = array();

        for ($i = 0; $i < sizeof($payments); $i++) {

            $this->cp = $payments[$i];
            $this->numDisp++;

            $a = array("10" => $this->record10($i + 1), "20" => $this->record20($i + 1));

            if ($this->cp["p_cliente_creditore"] != null && strlen($this->cp["p_cliente_creditore"]) != 0)
                $a["30"] = $this->record30($i + 1);

            $a["70"] = $this->record70($i + 1);

            $this->records[] = $a;
        }

        $this->recordEF = $this->recordEF();

        $this->printToFile();
    }

    /**
     * This function prints the records with the payments to a txt-file.
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    public function printToFile() {

        $my_file = '/home/simon/Desktop/pagamento.txt';
        $handle = fopen($my_file, 'w+') or die('Cannot open file: ' . $my_file);

        $payments = $this->recordAP;

        for ($i = 0; $i < sizeof($this->records); $i++) {
            $payments .= $this->records[$i][10];
            $payments .= $this->records[$i][20];
            if (array_key_exists("30", $this->records[$i]))
                $payments .= $this->records[$i][30];
            $payments .= $this->records[$i][70];
        }

        $payments .= $this->recordEF;

        fwrite($handle, $payments);

        fclose($handle);
    }

    /**
     * Puts the information in the AP-record
     * @return string : the AP-record
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    function recordAP(): string {

        $this->numRec++;

        $recordAP = " AP";

        strlen($this->cp["p_SIA_mittente"]) == 5 ? $recordAP .= $this->cp["p_SIA_mittente"] : $recordAP .= "     ";
        strlen($this->cp["p_ABI_ricevente"]) == 5 ? $recordAP .= $this->cp["p_ABI_ricevente"] : $recordAP .= "     ";

        $recordAP .= self::convertDate($this->cp["p_data_creazione"]);

        $recordAP .= self::addBlanks($this->cp["p_nome_supporto"], 20);

        $recordAP .= "      ";

        $recordAP = self::addFiller($recordAP, 68);

        strlen($this->cp["p_codice_divisa"]) == 1 ? $recordAP .= $this->cp["p_codice_divisa"] : $recordAP .= 'E';

        $recordAP .= " " . "     ";

        return $recordAP . "\n";
    }

    /**
     * Puts the information in the EF-record
     * @return string : the EF-record
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    function recordEF(): string {

        $this->numRec++;

        $recordEF = " EF";

        strlen($this->cp["p_SIA_mittente"]) == 5 ? $recordEF .= $this->cp["p_SIA_mittente"] : $recordEF .= "     ";
        strlen($this->cp["p_ABI_ricevente"]) == 5 ? $recordEF .= $this->cp["p_ABI_ricevente"] : $recordEF .= "     ";

        $recordEF .= self::convertDate($this->cp["p_data_creazione"]);

        $recordEF .= self::addBlanks($this->cp["p_nome_supporto"], 20);

        $recordEF .= "      ";

        $recordEF .= self::addZeros($this->numDisp, 7);

        $recordEF .= self::addZeros("", 15);

        $recordEF .= self::addZeros(str_replace(".", "", $this->importoTotPos), 15);

        $recordEF .= self::addZeros($this->numRec, 7);

        $recordEF = self::addFiller($recordEF, 24);

        $recordEF .= $this->cp["p_codice_divisa"];

        $recordEF .= "      ";

        return $recordEF;
    }

    /**
     * Puts the information in the 10-record
     * @param $numProg : number of the payment
     * @return string : the 10-record
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    function record10($numProg): string {

        $this->numRec++;

        $record10 = " 10";

        $record10 .= self::addZeros($numProg, 7);

        $record10 .= "      ";

        $record10 .= self::convertDate($this->cp["p_data_esecuzione"]);
        $record10 .= self::convertDate($this->cp["p_data_scadenza"]);

        $record10 .= 31000;

        $this->importoTotPos += $this->cp["p_importo"];

        $this->cp["p_importo"] = self::convertMoney($this->cp["p_importo"]);

        $record10 .= self::addZeros($this->cp["p_importo"], 13);

        $record10 .= '+';

        strlen($this->cp["p_ABI_ricevente"]) == 5 ? $record10 .= $this->cp["p_ABI_ricevente"] : $record10 .= "     ";
        strlen($this->cp["p_CAB_banca"]) == 5 ? $record10 .= $this->cp["p_CAB_banca"] : $record10 .= "     ";
        strlen($this->cp["p_codice_conto"]) == 12 ? $record10 .= $this->cp["p_codice_conto"] : $record10 .= "     ";

        strlen($this->cp["p_ABI_banca_dom"]) == 5 ? $record10 .= $this->cp["p_ABI_banca_dom"] : $record10 .= "     ";
        strlen($this->cp["p_CAB_banca_dom"]) == 5 ? $record10 .= $this->cp["p_CAB_banca_dom"] : $record10 .= "     ";
        $record10 = self::addFiller($record10, 12);

        strlen($this->cp["p_codice_azienda"]) == 5 ? $record10 .= $this->cp["p_codice_azienda"] : $record10 .= "00000";

        $record10 = self::addFiller($record10, 23);

        $record10 .= $this->cp["p_codice_divisa"];

        return $record10 . "\n";
    }

    /**
     * Puts the information in the 20-record
     * @param $numProg : number of the payment
     * @return string : the 20-record
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    function record20($numProg): string {

        $this->numRec++;

        $record20 = " 20";

        $record20 .= self::addZeros($numProg, 7);

        $record20 .= self::addBlanks($this->cp["p_denominazione_azienda"], 30);

        $record20 .= self::addBlanks($this->cp["p_indirizzo"], 30);

        $record20 .= self::addBlanks($this->cp["p_localita"], 30);

        $record20 .= self::addBlanks($this->cp["p_codifica_fiscale"], 16);

        $record20 = self::addFiller($record20, 4);

        return $record20 . "\n";
    }

    /**
     * Puts the information in the 30-record
     * @param $numProg : number of the payment
     * @return string : the 30-record
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    function record30($numProg): string {

        $this->numRec++;

        $record30 = " 30";

        $record30 .= self::addZeros($numProg, 7);

        $record30 .= self::addBlanks($this->cp["p_cliente_creditore"], 90);

        $record30 = self::addFiller($record30, 20);

        return $record30 . "\n";
    }

    /**
     * Puts the information in the 70-record
     * @param $numProg : number of the payment
     * @return string : the 70-record
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    function record70($numProg): string {

        $this->numRec++;

        $record70 = " 70";

        $record70 .= self::addZeros($numProg, 7);

        $record70 = self::addFiller($record70, 5);

        $record70 .= self::addBlanks($this->cp["p_numero_avviso"], 36);

        $record70 .= $this->cp["p_tipo_effetto"];

        $record70 .= $this->cp["p_flag_vista"];

        $record70 = self::addFiller($record70, 1);

        $record70 .= $this->cp["p_tipo_caricamento"];

        $record70 = self::addFiller($record70, 56);

        $record70 .= self::addBlanks($this->cp["p_chiavi_controllo"], 8);

        return $record70 . "\n";
    }

    /**
     * This function adds a filler to the record.
     * @param $record : the record to add the filler to
     * @param $fill : length of the filler
     * @return string : the record with the filler
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    static function addFiller($record, $fill): string {

        for ($i = 0; $i < $fill; $i++)
            $record .= " ";

        return $record;
    }

    /**
     * This function adds an amount of zeros (0) in front of the string until it has the desired length.
     * @param $info : the string to add the zeros to
     * @param $length : desired length of the string
     * @return string : the string with the zeros in front
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    static function addZeros($info, $length): string {

        while (strlen($info) < $length)
            $info = '0' . $info;

        return $info;
    }

    /**
     * This function adds an amount of blanks after of the string until it has the desired length.
     * @param $info : the string to add the blanks to
     * @param $length : desired length of the string
     * @return string : the string with the blanks
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    static function addBlanks($info, $length): string {

        while (strlen($info) < $length)
            $info .= ' ';

        return $info;
    }

    /**
     * Converts a Date from YYYY-MM-DD to DDMMYY
     * @param $date : Date in YYYY-MM-DD
     * @return string : Date in DDMMYY
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    public static function convertDate($date) {

        return substr($date, 8, 2) . substr($date, 5, 2) . substr($date, 2, 2);
    }

    /**
     * Converts a value from 2.99 to 2,99;
     * @param $m : Value with dot .
     * @return mixed: Value with comma ,
     * @deprecated since 2013, replaced with SEPA-XML-Standard. Use SEPAXMLCreator.php.
     */
    public static function convertMoney($m) {

        $m = (string)$m;


        if (strpos($m, '.') !== false) {
            if (strlen(substr($m, strpos($m, '.'))) != 3)
                $m .= '0';
            return str_replace('.', ',', $m);
        } else
            return $m . ',00';
    }
}