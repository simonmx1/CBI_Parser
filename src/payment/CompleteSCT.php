<?php

/**
 * CompleteSCT.php
 *
 * The necessary information for one payment can be stored in this object.
 *
 * @package    src/payment
 * @author     Simon Muscatello
 */

namespace cbi\payment;

use cbi\parse\Cbi;

class CompleteSCT {

    private $debIBAN;
    private $creIBAN;
    private $dataCrea;
    private $dataEsec;
    private $codiceCUC;
    private $aziendaDeb;
    private $aziendaCre;
    private $codificaFiscaleDeb;
    private $codificaFiscaleCre;
    private $importo;
    private $messaggio;

    /**
     * CompletePayment constructor.
     * Calls all the setters to complete the object.
     * @param float $importo
     * @param $deb : information of the debiting account
     * @param $cre : information of the crediting account
     * @param $dataEsec : date of execution
     * @param $msg : message of payment
     */
    public function __construct(float $importo, $deb, $cre, $dataEsec, $msg) {

        $this->setDebIBAN($deb['IBAN']);
        $this->setCreIBAN($cre['IBAN']);
        $this->setDataCrea();
        $this->setDataEsec($dataEsec);
        $this->setImporto($importo);
        $this->setAziendaDeb($deb['nome']);
        $this->setAziendaCre($cre['nome']);
        $this->setCodificaFiscaleDeb($deb['codFisc']);
        $this->setCodificaFiscaleCre($cre['codFisc']);
        $this->setCodiceCUC($deb['codCUC']);
        $this->setMessaggio($msg);

    }

    //Getter

    /**
     * @param mixed $debIBAN
     */
    public function setDebIBAN($debIBAN): void {

        $this->debIBAN = $debIBAN;
    }

    /**
     * @param mixed $creIBAN
     */
    public function setCreIBAN($creIBAN): void {

        $this->creIBAN = $creIBAN;
    }

    /**
     * @param float $importo
     */
    public function setImporto(float $importo): void {

        $this->importo = $importo;
    }

    /**
     * Set the current Date
     */
    public function setDataCrea(): void {

        $this->dataCrea = Date("Y-m-d H:i:s");
    }

    /**
     * @param string $dataEsec
     */
    public function setDataEsec(string $dataEsec): void {

        $this->dataEsec = $dataEsec;
    }

    /**
     * @param mixed $codiceCUC
     */
    public function setCodiceCUC($codiceCUC): void {

        $this->codiceCUC = $codiceCUC;
    }

    /**
     * @param string $aziendaDeb
     */
    public function setAziendaDeb(string $aziendaDeb): void {

        $this->aziendaDeb = $aziendaDeb;
    }

    /**
     * @param string $aziendaCre
     */
    public function setAziendaCre(string $aziendaCre): void {

        $this->aziendaCre = $aziendaCre;
    }

    /**
     * @param string $codificaFiscaleDeb
     */
    public function setCodificaFiscaleDeb(string $codificaFiscaleDeb): void {

        $this->codificaFiscaleDeb = $codificaFiscaleDeb;
    }

    /**
     * @param mixed $codificaFiscaleCre
     */
    public function setCodificaFiscaleCre($codificaFiscaleCre): void {

        $this->codificaFiscaleCre = $codificaFiscaleCre;
    }

    /**
     * @param mixed $messaggio
     */
    public function setMessaggio($messaggio): void {

        $this->messaggio = $messaggio;
    }


    //Getter

    /**
     * @return mixed
     */
    public function getDebIBAN() {

        return $this->debIBAN;
    }

    /**
     * @return mixed
     */
    public function getCreIBAN() {

        return $this->creIBAN;
    }

    /**
     * @return float
     */
    public function getImporto(): float {

        return $this->importo;
    }

    /**
     * @return string
     */
    public function getDataCrea(): string {

        return $this->dataCrea;
    }

    /**
     * @return string
     */
    public function getDataEsec(): string {

        return $this->dataEsec;
    }

    /**
     * @return string
     */
    public function getAziendaDeb(): string {

        return $this->aziendaDeb;
    }

    /**
     * @return mixed
     */
    public function getCodiceCUC() {

        return $this->codiceCUC;
    }

    /**
     * @return string
     */
    public function getAziendaCre(): string {

        return $this->aziendaCre;
    }

    /**
     * @return string
     */
    public function getCodificaFiscaleDeb(): string {

        return $this->codificaFiscaleDeb;
    }

    /**
     * @return mixed
     */
    public function getCodificaFiscaleCre() {

        return $this->codificaFiscaleCre;
    }

    /**
     * @return mixed
     */
    public function getMessaggio() {

        return $this->messaggio;
    }

}