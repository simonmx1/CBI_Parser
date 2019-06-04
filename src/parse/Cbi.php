<?php

/**
 * Cbi.php
 *
 * CBI-Standard parser
 *
 * @package    src/parse
 * @author     Simon Muscatello
 */

namespace cbi\parse;

class Cbi extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \Kaitai\Struct\Struct $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m__raw_record = [];
        $this->_m_record = [];
        $i = 0;
        while (!$this->_io->isEof()) {
            $this->_m__raw_record[] = $this->_io->readBytes(122);
            $_io__raw_record = new \Kaitai\Struct\Stream(end($this->_m__raw_record));
            $this->_m_record[] = new \cbi\parse\Cbi\Record($_io__raw_record, $this, $this->_root);
            $i++;
        }
    }
    protected $_m_record;
    protected $_m__raw_record;
    public function record() { return $this->_m_record; }
    public function _raw_record() { return $this->_m__raw_record; }
}

namespace cbi\parse\Cbi;

class BonificiEstero1 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_importoOriginarioPagamento = $this->_io->readBytes(18);
        $this->_m_codiceDivisaImportoOriginario = $this->_io->readBytes(3);
        $this->_m_importoRegolato = $this->_io->readBytes(18);
        $this->_m_codiveDivisaRegolamento = $this->_io->readBytes(18);
        $this->_m_importoNegoziato = $this->_io->readBytes(3);
        $this->_m_codiceDivisaImportoNegoziato = $this->_io->readBytes(3);
        $this->_m_cambioApplicato = $this->_io->readBytes(12);
        $this->_m_importoCommissioni = $this->_io->readBytes(13);
        $this->_m_importoSpese = $this->_io->readBytes(13);
        $this->_m_codicePaese = $this->_io->readBytes(3);
    }
    protected $_m_importoOriginarioPagamento;
    protected $_m_codiceDivisaImportoOriginario;
    protected $_m_importoRegolato;
    protected $_m_codiveDivisaRegolamento;
    protected $_m_importoNegoziato;
    protected $_m_codiceDivisaImportoNegoziato;
    protected $_m_cambioApplicato;
    protected $_m_importoCommissioni;
    protected $_m_importoSpese;
    protected $_m_codicePaese;

    /**
     * importo disposto dall'ordinante al lordo delle commissioni
     */
    public function importoOriginarioPagamento() { return $this->_m_importoOriginarioPagamento; }

    /**
     * codice divisa dell'importo precedente
     */
    public function codiceDivisaImportoOriginario() { return $this->_m_codiceDivisaImportoOriginario; }

    /**
     * importo regolato tra banche
     */
    public function importoRegolato() { return $this->_m_importoRegolato; }

    /**
     * codice divisa dell'importo precedente
     */
    public function codiveDivisaRegolamento() { return $this->_m_codiveDivisaRegolamento; }

    /**
     * rapresenta il contravalore in divisa dell'importo contabilizzato
     */
    public function importoNegoziato() { return $this->_m_importoNegoziato; }

    /**
     * codice divisa dell'importo precedente
     */
    public function codiceDivisaImportoNegoziato() { return $this->_m_codiceDivisaImportoNegoziato; }

    /**
     * tasso di cambio applicato
     */
    public function cambioApplicato() { return $this->_m_cambioApplicato; }

    /**
     * da indicare se non contabilizzate separamente dall'importo del pagamento
     */
    public function importoCommissioni() { return $this->_m_importoCommissioni; }

    /**
     * da indicare se non contabilizzate separamente dall'importo del pagamento
     */
    public function importoSpese() { return $this->_m_importoSpese; }

    /**
     * cod. Paese di provenienza o di destinazione dei fondi, secondo UIC
     */
    public function codicePaese() { return $this->_m_codicePaese; }
}

namespace cbi\parse\Cbi;

class PrimoRecord63 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_identificativoRapporto = $this->_io->readBytes(23);
        $this->_m_filler = $this->_io->readBytes(81);
    }
    protected $_m_identificativoRapporto;
    protected $_m_filler;

    /**
     * per le operazioni di cash pooling contiene le coordinate bancarie
     */
    public function identificativoRapporto() { return $this->_m_identificativoRapporto; }
    public function filler() { return $this->_m_filler; }
}

namespace cbi\parse\Cbi;

class RecordRi1 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_informazioniRiconcilazione = $this->_io->readBytes(104);
    }
    protected $_m_informazioniRiconcilazione;

    /**
     * Informazioni di riconciliazione
     */
    public function informazioniRiconcilazione() { return $this->_m_informazioniRiconcilazione; }
}

namespace cbi\parse\Cbi;

class Movimento extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_numeroProgressivo = $this->_io->readBytes(7);
        $this->_m_progressivoMovimento = $this->_io->readBytes(3);
        $this->_m_dataValuta = $this->_io->readBytes(6);
        $this->_m_dataRegistrazione = $this->_io->readBytes(6);
        $this->_m_segnoMovimento = $this->_io->readBytes(1);
        $this->_m_importoMovimento = $this->_io->readBytes(15);
        $this->_m_causaleCbi = $this->_io->readBytes(2);
        $this->_m_causaleInterna = $this->_io->readBytes(2);
        $this->_m_numeroAssegno = $this->_io->readBytes(16);
        $this->_m_riferimentoBanca = $this->_io->readBytes(16);
        $this->_m_tipoRiferimentoCliente = $this->_io->readBytes(9);
        $this->_m_descrizioneMovimento = $this->_io->readBytes(34);
    }
    protected $_m_numeroProgressivo;
    protected $_m_progressivoMovimento;
    protected $_m_dataValuta;
    protected $_m_dataRegistrazione;
    protected $_m_segnoMovimento;
    protected $_m_importoMovimento;
    protected $_m_causaleCbi;
    protected $_m_causaleInterna;
    protected $_m_numeroAssegno;
    protected $_m_riferimentoBanca;
    protected $_m_tipoRiferimentoCliente;
    protected $_m_descrizioneMovimento;

    /**
     * stesso numero del tipo record 61 della rendicontazione
     */
    public function numeroProgressivo() { return $this->_m_numeroProgressivo; }

    /**
     * inizia da 001; al raggiongimento di 999 reinizia da 001
     */
    public function progressivoMovimento() { return $this->_m_progressivoMovimento; }

    /**
     * valuta del movimento
     */
    public function dataValuta() { return $this->_m_dataValuta; }

    /**
     * data di registrazione/contabile del movimento
     */
    public function dataRegistrazione() { return $this->_m_dataRegistrazione; }

    /**
     * assume i valori D (Debito) - C (Credito)
     */
    public function segnoMovimento() { return $this->_m_segnoMovimento; }

    /**
     * Importodel Movimento
     */
    public function importoMovimento() { return $this->_m_importoMovimento; }

    /**
     * causale CBI
     */
    public function causaleCbi() { return $this->_m_causaleCbi; }

    /**
     * causale secondo la codifica proprietaria della banca
     */
    public function causaleInterna() { return $this->_m_causaleInterna; }
    public function numeroAssegno() { return $this->_m_numeroAssegno; }

    /**
     * numero di riferimento operazione attribuito dalla Banca
     */
    public function riferimentoBanca() { return $this->_m_riferimentoBanca; }

    /**
     * NROSUPCBI o PAYORDREF o NRPRATICA o NDISTINTA o RIFESICBI
     */
    public function tipoRiferimentoCliente() { return $this->_m_tipoRiferimentoCliente; }

    /**
     * NROSUPCBI o PAYORDREF o NRPRATICA o NDISTINTA o RIFESICBI
     */
    public function descrizioneMovimento() { return $this->_m_descrizioneMovimento; }
}

namespace cbi\parse\Cbi;

class RecordRi2 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_informazioniRiconcilazione = $this->_io->readBytes(36);
        $this->_m_filler = $this->_io->readBytes(68);
    }
    protected $_m_informazioniRiconcilazione;
    protected $_m_filler;

    /**
     * Informazioni di riconciliazione
     */
    public function informazioniRiconcilazione() { return $this->_m_informazioniRiconcilazione; }
    public function filler() { return $this->_m_filler; }
}

namespace cbi\parse\Cbi;

class SecondoRecord63 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_indirizzoOrdinante = $this->_io->readBytes(50);
        $this->_m_ibanOrdinante = $this->_io->readBytes(34);
        $this->_m_filler = $this->_io->readBytes(20);
    }
    protected $_m_indirizzoOrdinante;
    protected $_m_ibanOrdinante;
    protected $_m_filler;

    /**
     * Via/piazza e numero civico di residenza del cliente ordinante
     */
    public function indirizzoOrdinante() { return $this->_m_indirizzoOrdinante; }

    /**
     * Coordinata IBAN completa secondo lo standard ISO 3166
     */
    public function ibanOrdinante() { return $this->_m_ibanOrdinante; }
    public function filler() { return $this->_m_filler; }
}

namespace cbi\parse\Cbi;

class PrimoRecord63CausaleCbi48 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_dataOrdine = $this->_io->readBytes(8);
        $this->_m_codiceFiscaleOrdinante = $this->_io->readBytes(16);
        $this->_m_clienteOrdinante = $this->_io->readBytes(40);
        $this->_m_localita = $this->_io->readBytes(40);
    }
    protected $_m_dataOrdine;
    protected $_m_codiceFiscaleOrdinante;
    protected $_m_clienteOrdinante;
    protected $_m_localita;

    /**
     * data ordine del cliente ordinante nel formato GGMMAAAA
     */
    public function dataOrdine() { return $this->_m_dataOrdine; }

    /**
     * codice fiscale dell'ordinante
     */
    public function codiceFiscaleOrdinante() { return $this->_m_codiceFiscaleOrdinante; }

    /**
     * cognome nome ovvero denominazione / ragione sociale dell'ordinante
     */
    public function clienteOrdinante() { return $this->_m_clienteOrdinante; }

    /**
     * localita di residenza del cliente ordinante
     */
    public function localita() { return $this->_m_localita; }
}

namespace cbi\parse\Cbi;

class InfMovimento extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_numeroProgressivo = $this->_io->readBytes(7);
        $this->_m_progressivoMovimento = $this->_io->readBytes(3);
        $this->_m_flagStruttura = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(3), "utf-8");
        switch ($this->flagStruttura()) {
            case "ZZ2":
                $this->_m_content = new \cbi\parse\Cbi\BonificiEstero2($this->_io, $this, $this->_root);
                break;
            case "ZZ3":
                $this->_m_content = new \cbi\parse\Cbi\BonificiEstero3($this->_io, $this, $this->_root);
                break;
            case "YYY":
                $this->_m_content = new \cbi\parse\Cbi\PrimoRecord63CausaleCbi48($this->_io, $this, $this->_root);
                break;
            case "RI2":
                $this->_m_content = new \cbi\parse\Cbi\RecordRi2($this->_io, $this, $this->_root);
                break;
            case "ID1":
                $this->_m_content = new \cbi\parse\Cbi\RecordId1($this->_io, $this, $this->_root);
                break;
            case "ZZ1":
                $this->_m_content = new \cbi\parse\Cbi\BonificiEstero1($this->_io, $this, $this->_root);
                break;
            case "RI1":
                $this->_m_content = new \cbi\parse\Cbi\RecordRi1($this->_io, $this, $this->_root);
                break;
            case "YY2":
                $this->_m_content = new \cbi\parse\Cbi\SecondoRecord63($this->_io, $this, $this->_root);
                break;
            case "KKK":
                $this->_m_content = new \cbi\parse\Cbi\PrimoRecord63($this->_io, $this, $this->_root);
                break;
            default:
                $this->_m_content = new \cbi\parse\Cbi\RecordGen($this->_io, $this, $this->_root);
                break;
        }
    }
    protected $_m_numeroProgressivo;
    protected $_m_progressivoMovimento;
    protected $_m_flagStruttura;
    protected $_m_content;

    /**
     * stesso numero del record 61 della rendicontazione
     */
    public function numeroProgressivo() { return $this->_m_numeroProgressivo; }

    /**
     * stesso progressivo del tipo 62
     */
    public function progressivoMovimento() { return $this->_m_progressivoMovimento; }

    /**
     * se presente, tipo di informazione
     */
    public function flagStruttura() { return $this->_m_flagStruttura; }
    public function content() { return $this->_m_content; }
}

namespace cbi\parse\Cbi;

class BonificiEstero2 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_ordinanteDelPagamento = $this->_io->readBytes(104);
    }
    protected $_m_ordinanteDelPagamento;

    /**
     * indica per esteso l'ordinante del pagamento
     */
    public function ordinanteDelPagamento() { return $this->_m_ordinanteDelPagamento; }
}

namespace cbi\parse\Cbi;

class RecordCoda extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_mittente = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(5), "utf-8");
        $this->_m_ricevente = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(5), "utf-8");
        $this->_m_dataCreazione = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(6), "utf-8");
        $this->_m_nomeSupporto = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(20), "utf-8");
        $this->_m_filler1 = $this->_io->readBytes(6);
        $this->_m_numeroRendicontazioni = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(7), "utf-8");
        $this->_m_filler2 = $this->_io->readBytes(30);
        $this->_m_numeroRecord = $this->_io->readBytes(7);
        $this->_m_filler3 = $this->_io->readBytes(25);
        $this->_m_nonDisponibile = $this->_io->readBytes(6);
    }
    protected $_m_mittente;
    protected $_m_ricevente;
    protected $_m_dataCreazione;
    protected $_m_nomeSupporto;
    protected $_m_filler1;
    protected $_m_numeroRendicontazioni;
    protected $_m_filler2;
    protected $_m_numeroRecord;
    protected $_m_filler3;
    protected $_m_nonDisponibile;

    /**
     * codice ABI della Banca mittente degli estratti conto
     */
    public function mittente() { return $this->_m_mittente; }

    /**
     * codice SIA dell'Impresa destinataria della rendicontazione conti correnti
     */
    public function ricevente() { return $this->_m_ricevente; }

    /**
     * data di creazione del flusso da parte della Banca
     */
    public function dataCreazione() { return $this->_m_dataCreazione; }

    /**
     * campo di libera composizione da parte della Banca Mittente
     */
    public function nomeSupporto() { return $this->_m_nomeSupporto; }
    public function filler1() { return $this->_m_filler1; }

    /**
     * totale delle rendicontazioni di conto corrente contenute nel flusso
     */
    public function numeroRendicontazioni() { return $this->_m_numeroRendicontazioni; }
    public function filler2() { return $this->_m_filler2; }

    /**
     * numero dei record che compongono il flusso
     */
    public function numeroRecord() { return $this->_m_numeroRecord; }
    public function filler3() { return $this->_m_filler3; }
    public function nonDisponibile() { return $this->_m_nonDisponibile; }
}

namespace cbi\parse\Cbi;

class RecordGen extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
    }
    protected $_m_descrizione;

    /**
     * descrizione del movimento in testo libero
     */
    public function descrizione() {
        if ($this->_m_descrizione !== null)
            return $this->_m_descrizione;
        $_pos = $this->_io->pos();
        $this->_io->seek(13);
        $this->_m_descrizione = $this->_io->readBytes(107);
        $this->_io->seek($_pos);
        return $this->_m_descrizione;
    }
}

namespace cbi\parse\Cbi;

class BonificiEstero3 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_beneficiario = $this->_io->readBytes(50);
        $this->_m_motivazioneDelPagamento = $this->_io->readBytes(54);
    }
    protected $_m_beneficiario;
    protected $_m_motivazioneDelPagamento;

    /**
     * beneficario del pagamento
     */
    public function beneficiario() { return $this->_m_beneficiario; }

    /**
     * motivazione del pagamento come indicata dalla banca
     */
    public function motivazioneDelPagamento() { return $this->_m_motivazioneDelPagamento; }
}

namespace cbi\parse\Cbi;

class SaldoLiquido extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\LiquiditaFuture $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_dataLiquidita = $this->_io->readBytes(6);
        $this->_m_segno = $this->_io->readBytes(1);
        $this->_m_saldoLiquido = $this->_io->readBytes(6);
    }
    protected $_m_dataLiquidita;
    protected $_m_segno;
    protected $_m_saldoLiquido;

    /**
     * data di riferimento del saldo successivo
     */
    public function dataLiquidita() { return $this->_m_dataLiquidita; }

    /**
     * assume i valori D (Debito) - C (Credito)
     */
    public function segno() { return $this->_m_segno; }

    /**
     * saldo liquido alla data precedente
     */
    public function saldoLiquido() { return $this->_m_saldoLiquido; }
}

namespace cbi\parse\Cbi;

class RecordId1 extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_indentificativoUnivocoMessaggio = $this->_io->readBytes(35);
        $this->_m_identificativoEte = $this->_io->readBytes(35);
        $this->_m_filler = $this->_io->readBytes(34);
    }
    protected $_m_indentificativoUnivocoMessaggio;
    protected $_m_identificativoEte;
    protected $_m_filler;

    /**
     * identificativo univoco messagio
     */
    public function indentificativoUnivocoMessaggio() { return $this->_m_indentificativoUnivocoMessaggio; }

    /**
     * identificativo End to End
     */
    public function identificativoEte() { return $this->_m_identificativoEte; }
    public function filler() { return $this->_m_filler; }
}

namespace cbi\parse\Cbi;

class SaldoFinale extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_numeroProgressivo = $this->_io->readBytes(7);
        $this->_m_codiceDivisa = $this->_io->readBytes(3);
        $this->_m_dataContabile = $this->_io->readBytes(6);
        $this->_m_segnoSaldoContabile = $this->_io->readBytes(1);
        $this->_m_saldoContabile = $this->_io->readBytes(15);
        $this->_m_segnoSaldoLiquido = $this->_io->readBytes(1);
        $this->_m_saldoLiquido = $this->_io->readBytes(15);
        $this->_m_filler1 = $this->_io->readBytes(54);
        $this->_m_filler2 = $this->_io->readBytes(15);
    }
    protected $_m_numeroProgressivo;
    protected $_m_codiceDivisa;
    protected $_m_dataContabile;
    protected $_m_segnoSaldoContabile;
    protected $_m_saldoContabile;
    protected $_m_segnoSaldoLiquido;
    protected $_m_saldoLiquido;
    protected $_m_filler1;
    protected $_m_filler2;

    /**
     * stesso numero del tipo record 61 della rendicontazione
     */
    public function numeroProgressivo() { return $this->_m_numeroProgressivo; }

    /**
     * codice divisa
     */
    public function codiceDivisa() { return $this->_m_codiceDivisa; }

    /**
     * data con la quale la Banca ha contabilizzato il saldo
     */
    public function dataContabile() { return $this->_m_dataContabile; }

    /**
     * assume i valori D (Debito) - C (Credito)
     */
    public function segnoSaldoContabile() { return $this->_m_segnoSaldoContabile; }

    /**
     * saldo contabile di chiusura della giornata di riferimento
     */
    public function saldoContabile() { return $this->_m_saldoContabile; }

    /**
     * assume i valori D (Debito) - C (Credito)
     */
    public function segnoSaldoLiquido() { return $this->_m_segnoSaldoLiquido; }

    /**
     * saldo liquido della giornata
     */
    public function saldoLiquido() { return $this->_m_saldoLiquido; }
    public function filler1() { return $this->_m_filler1; }
    public function filler2() { return $this->_m_filler2; }
}

namespace cbi\parse\Cbi;

class LiquiditaFuture extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_numeroProgressivo = $this->_io->readBytes(7);
        $this->_m_saldo1 = new \cbi\parse\Cbi\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo2 = new \cbi\parse\Cbi\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo3 = new \cbi\parse\Cbi\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo4 = new \cbi\parse\Cbi\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo5 = new \cbi\parse\Cbi\SaldoLiquido($this->_io, $this, $this->_root);
    }
    protected $_m_numeroProgressivo;
    protected $_m_saldo1;
    protected $_m_saldo2;
    protected $_m_saldo3;
    protected $_m_saldo4;
    protected $_m_saldo5;

    /**
     * stesso numero del tipo record 61 della rendicontazione
     */
    public function numeroProgressivo() { return $this->_m_numeroProgressivo; }
    public function saldo1() { return $this->_m_saldo1; }
    public function saldo2() { return $this->_m_saldo2; }
    public function saldo3() { return $this->_m_saldo3; }
    public function saldo4() { return $this->_m_saldo4; }
    public function saldo5() { return $this->_m_saldo5; }
}

namespace cbi\parse\Cbi;

class Record extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_separator = $this->_io->ensureFixedContents("\x20");
        $this->_m_tipoRecord = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(2), "utf-8");
        switch ($this->tipoRecord()) {
            case "64":
                $this->_m_content = new \cbi\parse\Cbi\SaldoFinale($this->_io, $this, $this->_root);
                break;
            case "EF":
                $this->_m_content = new \cbi\parse\Cbi\RecordCoda($this->_io, $this, $this->_root);
                break;
            case "EC":
                $this->_m_content = new \cbi\parse\Cbi\RecordTesta($this->_io, $this, $this->_root);
                break;
            case "65":
                $this->_m_content = new \cbi\parse\Cbi\LiquiditaFuture($this->_io, $this, $this->_root);
                break;
            case "RH":
                $this->_m_content = new \cbi\parse\Cbi\RecordTesta($this->_io, $this, $this->_root);
                break;
            case "61":
                $this->_m_content = new \cbi\parse\Cbi\SaldoInziale($this->_io, $this, $this->_root);
                break;
            case "62":
                $this->_m_content = new \cbi\parse\Cbi\Movimento($this->_io, $this, $this->_root);
                break;
            case "63":
                $this->_m_content = new \cbi\parse\Cbi\InfMovimento($this->_io, $this, $this->_root);
                break;
            default:
                $this->_m_content = new \cbi\parse\Cbi\Undefined($this->_io, $this, $this->_root);
                break;
        }
    }
    protected $_m_separator;
    protected $_m_tipoRecord;
    protected $_m_content;
    public function separator() { return $this->_m_separator; }

    /**
     * Contiene il tipo die Documento CBI
     */
    public function tipoRecord() { return $this->_m_tipoRecord; }

    /**
     * Tutti i record nel documento CBI incl. saldi
     */
    public function content() { return $this->_m_content; }
}

namespace cbi\parse\Cbi;

class Undefined extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
    }
}

namespace cbi\parse\Cbi;

class SaldoInziale extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_numeroProgressivo = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(7), "utf-8");
        $this->_m_filler1 = $this->_io->readBytes(13);
        $this->_m_codiceAbiOriginarioBanca = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(5), "utf-8");
        $this->_m_causale = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(5), "utf-8");
        $this->_m_descrizione = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(16), "utf-8");
        $this->_m_tipoConto = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(2), "utf-8");
        $this->_m_cinBanca = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(1), "utf-8");
        $this->_m_codiceAbiBanca = $this->_io->readBytes(5);
        $this->_m_cabBanca = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(5), "utf-8");
        $this->_m_contoCorrente = $this->_io->readBytes(12);
        $this->_m_codiceDivisa = $this->_io->readBytes(3);
        $this->_m_dataContabile = $this->_io->readBytes(6);
        $this->_m_segno = $this->_io->readBytes(1);
        $this->_m_saldoIniziale = $this->_io->readBytes(15);
        $this->_m_codicePaese = $this->_io->readBytes(2);
        $this->_m_checkDigit = $this->_io->readBytes(2);
        $this->_m_filler2 = $this->_io->readBytes(17);
    }
    protected $_m_numeroProgressivo;
    protected $_m_filler1;
    protected $_m_codiceAbiOriginarioBanca;
    protected $_m_causale;
    protected $_m_descrizione;
    protected $_m_tipoConto;
    protected $_m_cinBanca;
    protected $_m_codiceAbiBanca;
    protected $_m_cabBanca;
    protected $_m_contoCorrente;
    protected $_m_codiceDivisa;
    protected $_m_dataContabile;
    protected $_m_segno;
    protected $_m_saldoIniziale;
    protected $_m_codicePaese;
    protected $_m_checkDigit;
    protected $_m_filler2;

    /**
     * numero della rendicontazione all'interno del flusso
     */
    public function numeroProgressivo() { return $this->_m_numeroProgressivo; }
    public function filler1() { return $this->_m_filler1; }

    /**
     * da valorizzare con il codice della Banca assorbita
     */
    public function codiceAbiOriginarioBanca() { return $this->_m_codiceAbiOriginarioBanca; }

    /**
     * assume il valore fisso 93001 o 93011
     */
    public function causale() { return $this->_m_causale; }

    /**
     * descrizione del rapporto di c/c
     */
    public function descrizione() { return $this->_m_descrizione; }

    /**
     * codice tipo conto assegnato dalla Banca
     */
    public function tipoConto() { return $this->_m_tipoConto; }

    /**
     * carattere di controllo delle coordinate bancarie ABI
     */
    public function cinBanca() { return $this->_m_cinBanca; }

    /**
     * codice ABI banca mittente
     */
    public function codiceAbiBanca() { return $this->_m_codiceAbiBanca; }

    /**
     * cab banca mittente
     */
    public function cabBanca() { return $this->_m_cabBanca; }

    /**
     * codice conto corrente BBAN
     */
    public function contoCorrente() { return $this->_m_contoCorrente; }

    /**
     * Codice divisa
     */
    public function codiceDivisa() { return $this->_m_codiceDivisa; }

    /**
     * data contabile di riferimento del saldo
     */
    public function dataContabile() { return $this->_m_dataContabile; }

    /**
     * assume i valori D (Debito) - C (Credito)
     */
    public function segno() { return $this->_m_segno; }

    /**
     * Saldo iniziale di quadrattura della rendicontazione
     */
    public function saldoIniziale() { return $this->_m_saldoIniziale; }

    /**
     * Puo assumere solo i valori IT o SM
     */
    public function codicePaese() { return $this->_m_codicePaese; }

    /**
     * Check digit IBAN
     */
    public function checkDigit() { return $this->_m_checkDigit; }
    public function filler2() { return $this->_m_filler2; }
}

namespace cbi\parse\Cbi;

class RecordTesta extends \Kaitai\Struct\Struct {
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi\Record $_parent = null, \cbi\parse\Cbi $_root = null) {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read() {
        $this->_m_mittente = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(5), "utf-8");
        $this->_m_ricevente = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(5), "utf-8");
        $this->_m_dataCreazione = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(6), "utf-8");
        $this->_m_nomeSupporto = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(20), "utf-8");
        $this->_m_filler = $this->_io->readBytes(76);
        $this->_m_nonDisponibile = $this->_io->readBytes(5);
    }
    protected $_m_mittente;
    protected $_m_ricevente;
    protected $_m_dataCreazione;
    protected $_m_nomeSupporto;
    protected $_m_filler;
    protected $_m_nonDisponibile;

    /**
     * codice ABI della Banca mittente degli estratti conto
     */
    public function mittente() { return $this->_m_mittente; }

    /**
     * codice SIA dell'Impresa destinataria della rendicontazione conti correnti
     */
    public function ricevente() { return $this->_m_ricevente; }

    /**
     * data di creazione del flusso da parte della Banca
     */
    public function dataCreazione() { return $this->_m_dataCreazione; }

    /**
     * campo di libera composizione da parte della Banca Mittente
     */
    public function nomeSupporto() { return $this->_m_nomeSupporto; }
    public function filler() { return $this->_m_filler; }
    public function nonDisponibile() { return $this->_m_nonDisponibile; }
}
