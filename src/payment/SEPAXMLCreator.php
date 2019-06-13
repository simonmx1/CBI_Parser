<?php

/**
 * SEPAXMLCreator.php
 *
 * The main class to create an XML-Structure with the SEPA Credit Transfer Standard.
 *
 * @package    src/payment
 * @author     Simon Muscatello
 */

namespace cbi\payment;


use DOMDocument;
use DOMElement;

class SEPAXMLCreator {

    private $sct;
    private $importoTotPos = 0;
    private $numDisp = 0;
    private $xml;
    private $id;

    /**
     * SEPAXMLCreator constructor.
     * Creates an XML-Document containing the given payments in the SEPA Credit Transfer Standard.
     * @param $payments : the payments to put into an XML
     */
    public function __construct($payments) {

        $this->sct = $payments[0];

        $this->id = "XML-" . str_replace(' ', 'T', $this->sct['p_data_creazione']);

        $this->xml = new DOMDocument('1.0', 'UTF-8');

        $CBIPaymentRequest = $this->xml->createElement('CBIPaymentRequest');
        $CBIPaymentRequest->setAttribute("xsi:schemaLocation", "urn:CBI:xsd:CBIPaymentRequest.00.04.00 CBIPaymentRequest.00.04.00.xsd");
        $CBIPaymentRequest->setAttribute("xmlns", "urn:CBI:xsd:CBIPaymentRequest.00.04.00");
        $CBIPaymentRequest->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
        $CBIPaymentRequest = $this->xml->appendChild($CBIPaymentRequest);

        $PmtInf = $this->createPmtInf($payments);
        $GrpHdr = $this->createGrpHdr();

        $CBIPaymentRequest->appendChild($GrpHdr);
        $CBIPaymentRequest->appendChild($PmtInf);

        $this->xml->formatOutput = true;
        printf($this->xml->saveXML());

        $this->xml->save("test.xml");

    }

    /**
     * This function creates the header of the XML tree.
     * @return DOMElement : The header element of the XML tree
     */
    private function createGrpHdr() {

        $GrpHdr = $this->xml->createElement('GrpHdr');

        $MsgId = $GrpHdr->appendChild($this->xml->createElement('MsgId'));
        $MsgId->textContent = $this->id;

        $CreDtTm = $GrpHdr->appendChild($this->xml->createElement('CreDtTm'));
        $CreDtTm->textContent = str_replace(' ', 'T', $this->sct['p_data_creazione']);

        $NbOfTxs = $GrpHdr->appendChild($this->xml->createElement('NbOfTxs'));

        $CtrlSum = $GrpHdr->appendChild($this->xml->createElement('CtrlSum'));

        $InitgPty = $GrpHdr->appendChild($this->xml->createElement('InitgPty'));

        $Nm = $InitgPty->appendChild($this->xml->createElement('Nm'));
        $Nm->textContent = $this->sct['p_nome_azienda_deb'];

        $Id = $InitgPty->appendChild($this->xml->createElement('Id'));
        $OrgId = $Id->appendChild($this->xml->createElement('OrgId'));
        $Othr = $OrgId->appendChild($this->xml->createElement('Othr'));

        $Id = $Othr->appendChild($this->xml->createElement('Id'));
        $Id->textContent = $this->sct['p_codiceCUC'];

        $Issr = $Othr->appendChild($this->xml->createElement('Issr'));
        $Issr->textContent = 'CBI';

        $FwdgAgt = $GrpHdr->appendChild($this->xml->createElement('FwdgAgt'));
        $FinInstnId = $FwdgAgt->appendChild($this->xml->createElement('FinInstnId'));
        $ClrSysMmbId = $FinInstnId->appendChild($this->xml->createElement('ClrSysMmbId'));

        $MmbId = $ClrSysMmbId->appendChild($this->xml->createElement('MmbId'));
        $MmbId->textContent = self::getABI($this->sct['p_IBAN_deb']);

        $NbOfTxs->textContent = $this->numDisp;
        $CtrlSum->textContent = $this->importoTotPos;

        return $GrpHdr;
    }

    /**
     * This function creates an Element of the XML tree.
     * @param $payments : Amount of payments included in this document
     * @return DOMElement : The piece of XML tree containing the payments
     */
    private function createPmtInf($payments) {

        $PmtInf = $this->xml->createElement('PmtInf');

        $PmtInfId = $PmtInf->appendChild($this->xml->createElement('PmtInfId'));
        $PmtInfId->textContent = $this->id . "-" . $this->sct['p_dist_id'];

        $PmtMtd = $PmtInf->appendChild($this->xml->createElement('PmtMtd'));
        $PmtMtd->textContent = 'TRA';

        $BtchBookg = $PmtInf->appendChild($this->xml->createElement('BtchBookg'));
        $BtchBookg->textContent = 'false';

        $PmtTpInf = $PmtInf->appendChild($this->xml->createElement('PmtTpInf'));

        $InstrPrty = $PmtTpInf->appendChild($this->xml->createElement('InstrPrty'));
        $InstrPrty->textContent = 'NORM';

        $SvcLvl = $PmtTpInf->appendChild($this->xml->createElement('SvcLvl'));

        $Cd = $SvcLvl->appendChild($this->xml->createElement('Cd'));
        $Cd->textContent = 'SEPA';

        $ReqdExctnDt = $PmtInf->appendChild($this->xml->createElement('ReqdExctnDt'));
        $ReqdExctnDt->textContent = $this->sct['p_data_esecuzione'];

        $Dbtr = $PmtInf->appendChild($this->xml->createElement('Dbtr'));

        $Nm = $Dbtr->appendChild($this->xml->createElement('Nm'));
        $Nm->textContent = $this->sct["p_nome_azienda_deb"];

        $Id = $Dbtr->appendChild($this->xml->createElement('Id'));
        $OrgId = $Id->appendChild($this->xml->createElement('OrgId'));
        $Othr = $OrgId->appendChild($this->xml->createElement('Othr'));

        $Id = $Othr->appendChild($this->xml->createElement('Id'));
        $Id->textContent = $this->sct['p_codifica_fiscale_deb'];

        $Issr = $Othr->appendChild($this->xml->createElement('Issr'));
        $Issr->textContent = 'ADE';

        $DbtrAcct = $PmtInf->appendChild($this->xml->createElement('DbtrAcct'));
        $Id = $DbtrAcct->appendChild($this->xml->createElement('Id'));

        $IBAN = $Id->appendChild($this->xml->createElement('IBAN'));
        $IBAN->textContent = $this->sct["p_IBAN_deb"];

        $DbtrAgt = $PmtInf->appendChild($this->xml->createElement('DbtrAgt'));
        $FinInstnId = $DbtrAgt->appendChild($this->xml->createElement('FinInstnId'));
        $ClrSysMmbId = $FinInstnId->appendChild($this->xml->createElement('ClrSysMmbId'));

        $MmbId = $ClrSysMmbId->appendChild($this->xml->createElement('MmbId'));
        $MmbId->textContent = self::getABI($this->sct['p_IBAN_deb']);

        $ChrgBr = $PmtInf->appendChild($this->xml->createElement('ChrgBr'));
        $ChrgBr->textContent = 'SLEV';

        for ($i = 0; $i < sizeof($payments); $i++) {

            $this->sct = $payments[$i];
            $PmtInf->appendChild($this->createCdtTrfTxInf());
            $this->importoTotPos += $payments[$i]['p_importo'];
            $this->numDisp++;

        }

        return $PmtInf;
    }

    /**
     * This function creates an Element of the XML tree.
     * @return DOMElement : The complete CdtTrfTxInf-Element of the XML
     */
    private function createCdtTrfTxInf(): DOMElement {

        $CdtTrfTxInf = $this->xml->createElement('CdtTrfTxInf');

        $PmtId = $CdtTrfTxInf->appendChild($this->xml->createElement('PmtId'));

        $InstrId = $PmtId->appendChild($this->xml->createElement('InstrId'));
        $InstrId->textContent = 1;

        $EndToEndId = $PmtId->appendChild($this->xml->createElement('EndToEndId'));
        $EndToEndId->textContent = $this->id . "-p" . $this->sct['p_id'];

        $PmtTpInf = $CdtTrfTxInf->appendChild($this->xml->createElement('PmtTpInf'));

        $CtgyPurp = $PmtTpInf->appendChild($this->xml->createElement('CtgyPurp'));

        $Cd = $CtgyPurp->appendChild($this->xml->createElement('Cd'));
        $Cd->textContent = 'SUPP';

        $Amt = $CdtTrfTxInf->appendChild($this->xml->createElement('Amt'));

        $InstdAmt = $this->xml->createElement('InstdAmt');
        $InstdAmt->setAttribute('Ccy', 'EUR');
        $InstdAmt = $Amt->appendChild($InstdAmt);
        $InstdAmt->textContent = $this->sct['p_importo'];

        $Cbtr = $CdtTrfTxInf->appendChild($this->xml->createElement('Cdtr'));

        $Nm = $Cbtr->appendChild($this->xml->createElement('Nm'));
        $Nm->textContent = $this->sct["p_nome_azienda_cre"];

        $Id = $Cbtr->appendChild($this->xml->createElement('Id'));
        $OrgId = $Id->appendChild($this->xml->createElement('OrgId'));
        $Othr = $OrgId->appendChild($this->xml->createElement('Othr'));

        $Id = $Othr->appendChild($this->xml->createElement('Id'));
        $Id->textContent = $this->sct['p_codifica_fiscale_cre'];

        $Issr = $Othr->appendChild($this->xml->createElement('Issr'));
        $Issr->textContent = 'ADE';

        $CbtrAcct = $CdtTrfTxInf->appendChild($this->xml->createElement('CdtrAcct'));
        $Id = $CbtrAcct->appendChild($this->xml->createElement('Id'));

        $IBAN = $Id->appendChild($this->xml->createElement('IBAN'));
        $IBAN->textContent = $this->sct["p_IBAN_cre"];

        $RmtInf = $CdtTrfTxInf->appendChild($this->xml->createElement('RmtInf'));

        $Ustrd = $RmtInf->appendChild($this->xml->createElement('Ustrd'));
        $Ustrd->textContent = $this->sct["p_messaggio"];

        return $CdtTrfTxInf;
    }

    /**
     * Extracts the ABI-code from the IBAN
     * @param string $iban : The IBAN which contains the ABI
     * @return bool|string : The ABI
     */
    public static function getABI(string $iban): string {

        return substr($iban, 5, 5);
    }

    /**
     * Extracts the CAB-code from the IBAN
     * @param string $iban : The IBAN which contains the CAB
     * @return bool|string : The CAB
     */
    public static function getCAB(string $iban): string {

        return substr($iban, 10, 5);
    }

}