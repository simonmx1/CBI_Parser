<?php


namespace cbi\database;

class CompleteMovement {

    private $record62;
    private $record63s;

    private $dataValuta;
    private $dataContabile;
    private $iSegno;
    private $importo;
    private $rifBanca;
    private $tipoRifBanca;
    private $des;
    private $codFisOrd;
    private $clienteOrd;
    private $localita;
    private $indirizzoOrd;
    private $ibanOrd;
    private $estero;
    private $completato;

    public function __construct($record62, $record63s) {

        $this->record62 = $record62;
        $this->record63s = $record63s;

        $this->set62();
        $this->set63();

    }

    private function set62() {

        $this->dataValuta = Database::convertDate(substr($this->record62, 20, 6));

        $this->dataContabile = Database::convertDate(substr($this->record62, 26, 6));

        //$this->completato = strcmp($this->dataContabile, Date("Y-M-D"));

        $this->iSegno = substr($this->record62, 32, 1);

        $this->importo = floatval(str_replace(',', '.', substr($this->record62, 33, 15)));

        $this->rifBanca = substr($this->record62, 68, 16);

        $this->tipoRifBanca = substr($this->record62, 84, 9);
    }

    private function set63() {

        $des = substr($this->record62, 93, 34);
        for ($i = 0; $i < sizeof($this->record63s); $i++) {
            switch (substr($this->record63s[$i], 20, 3)) {
                case "KKK":
                    break;
                case "YYY":
                    $this->codFisOrd = substr($this->record63s[$i], 31, 16);
                    $this->clienteOrd = substr($this->record63s[$i], 47, 40);
                    $this->localita = substr($this->record63s[$i], 87, 40);
                    break;
                case "YY2":
                    $this->indirizzoOrd = substr($this->record63s[$i], 23, 50);
                    $this->ibanOrd = substr($this->record63s[$i], 73, 34);
                    if (substr($this->ibanOrd, 0, 2) == "IT")
                        $this->estero = false;
                    else
                        $this->estero = true;
                    break;
                case "ZZ1":
                case "ZZ2":
                case "ZZ3":
                    $this->estero = true;
                    $des .= substr($this->record63s[$i], 23, 107);
                    break;
                case "RI1":
                    break;
                case "RI2":
                    break;
                case "ID1":
                    break;
                default:
                    $des .= substr($this->record63s[$i], 20, 107);
                    break;
            }
        }

        $this->des = $des;
    }

    //Getters

    public function getDataValuta() {

        return $this->dataValuta;
    }

    public function getDataContabile() {

        return $this->dataContabile;
    }

    public function getISegno() {

        return $this->iSegno;
    }

    public function getImporto() {

        return $this->importo;
    }

    public function getRifBanca() {

        return $this->rifBanca;
    }

    public function getTipoRifBanca() {

        return $this->tipoRifBanca;
    }

    public function getDes() {

        return $this->des;
    }

    public function getCodFisOrd() {

        return $this->codFisOrd;
    }

    public function getClienteOrd() {

        return $this->clienteOrd;
    }

    public function getLocalita() {

        return $this->localita;
    }

    public function getIndirizzoOrd() {

        return $this->indirizzoOrd;
    }

    public function getIbanOrd() {

        return $this->ibanOrd;
    }

    public function getEstero() {

        return $this->estero;
    }

    public function getCompletato() {

        return $this->completato;
    }

}