<?php
// This is a generated file! Please edit source .ksy file and use kaitai-struct-compiler to rebuild

namespace cbi\parse;

class Cbi extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \Kaitai\Struct\Struct $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m__raw_record = [];
        $this->_m_record = [];
        $i = 0;
        while (!$this->_io->isEof()) {
            $this->_m__raw_record[] = $this->_io->readBytes(122);
            $_io__raw_record = new \Kaitai\Struct\Stream(end($this->_m__raw_record));
            $this->_m_record[] = new \cbi\parse\Record($_io__raw_record, $this, $this->_root);
            $i++;
        }
    }

    protected $_m_record;
    protected $_m__raw_record;

    public function record()
    {
        return $this->_m_record;
    }

    public function _raw_record()
    {
        return $this->_m__raw_record;
    }
}

namespace cbi\parse;

class BonificiEstero1 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_importoOriginarioPagamento = $this->_io->readBytes(18);
        $this->_m_codiceDivisaImportoOriginario = $this->_io->readBytes(3);
        $this->_m_importoRegolato = $this->_io->readBytes(18);
        $this->_m_codiveDivisaRegolamento = $this->_io->readBytes(18);
        $this->_m_importoNegoziato = $this->_io->readBytes(3);
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
    protected $_m_cambioApplicato;
    protected $_m_importoCommissioni;
    protected $_m_importoSpese;
    protected $_m_codicePaese;

    public function importoOriginarioPagamento()
    {
        return $this->_m_importoOriginarioPagamento;
    }

    public function codiceDivisaImportoOriginario()
    {
        return $this->_m_codiceDivisaImportoOriginario;
    }

    public function importoRegolato()
    {
        return $this->_m_importoRegolato;
    }

    public function codiveDivisaRegolamento()
    {
        return $this->_m_codiveDivisaRegolamento;
    }

    public function importoNegoziato()
    {
        return $this->_m_importoNegoziato;
    }

    public function cambioApplicato()
    {
        return $this->_m_cambioApplicato;
    }

    public function importoCommissioni()
    {
        return $this->_m_importoCommissioni;
    }

    public function importoSpese()
    {
        return $this->_m_importoSpese;
    }

    public function codicePaese()
    {
        return $this->_m_codicePaese;
    }
}

namespace cbi\parse;

class PrimoRecord63CausaleCbi extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_dataOrdine = $this->_io->readBytes(8);
        $this->_m_codiceFiscaleOrdinante = $this->_io->readBytes(16);
        $this->_m_clienteOrdinante = $this->_io->readBytes(40);
        $this->_m_localita = $this->_io->readBytes(40);
    }

    protected $_m_dataOrdine;
    protected $_m_codiceFiscaleOrdinante;
    protected $_m_clienteOrdinante;
    protected $_m_localita;

    public function dataOrdine()
    {
        return $this->_m_dataOrdine;
    }

    public function codiceFiscaleOrdinante()
    {
        return $this->_m_codiceFiscaleOrdinante;
    }

    public function clienteOrdinante()
    {
        return $this->_m_clienteOrdinante;
    }

    public function localita()
    {
        return $this->_m_localita;
    }
}

namespace cbi\parse;

class PrimoRecord63 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_identificativoRapporto = $this->_io->readBytes(23);
        $this->_m_filler = $this->_io->readBytes(81);
    }

    protected $_m_identificativoRapporto;
    protected $_m_filler;

    public function identificativoRapporto()
    {
        return $this->_m_identificativoRapporto;
    }

    public function filler()
    {
        return $this->_m_filler;
    }
}

namespace cbi\parse;

class RecordRi1 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_informazioniRiconcilazione = $this->_io->readBytes(104);
    }

    protected $_m_informazioniRiconcilazione;

    public function informazioniRiconcilazione()
    {
        return $this->_m_informazioniRiconcilazione;
    }
}

namespace cbi\parse;

class Movimento extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
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

    public function numeroProgressivo()
    {
        return $this->_m_numeroProgressivo;
    }

    public function progressivoMovimento()
    {
        return $this->_m_progressivoMovimento;
    }

    public function dataValuta()
    {
        return $this->_m_dataValuta;
    }

    public function dataRegistrazione()
    {
        return $this->_m_dataRegistrazione;
    }

    public function segnoMovimento()
    {
        return $this->_m_segnoMovimento;
    }

    public function importoMovimento()
    {
        return $this->_m_importoMovimento;
    }

    public function causaleCbi()
    {
        return $this->_m_causaleCbi;
    }

    public function causaleInterna()
    {
        return $this->_m_causaleInterna;
    }

    public function numeroAssegno()
    {
        return $this->_m_numeroAssegno;
    }

    public function riferimentoBanca()
    {
        return $this->_m_riferimentoBanca;
    }

    public function tipoRiferimentoCliente()
    {
        return $this->_m_tipoRiferimentoCliente;
    }

    public function descrizioneMovimento()
    {
        return $this->_m_descrizioneMovimento;
    }
}

namespace cbi\parse;

class RecordRi2 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_informazioniRiconcilazione = $this->_io->readBytes(36);
        $this->_m_filler = $this->_io->readBytes(68);
    }

    protected $_m_informazioniRiconcilazione;
    protected $_m_filler;

    public function informazioniRiconcilazione()
    {
        return $this->_m_informazioniRiconcilazione;
    }

    public function filler()
    {
        return $this->_m_filler;
    }
}

namespace cbi\parse;

class SecondoRecord63 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_indirizzoOrdinante = $this->_io->readBytes(50);
        $this->_m_ibanOrdinante = $this->_io->readBytes(34);
        $this->_m_filler = $this->_io->readBytes(20);
    }

    protected $_m_indirizzoOrdinante;
    protected $_m_ibanOrdinante;
    protected $_m_filler;

    public function indirizzoOrdinante()
    {
        return $this->_m_indirizzoOrdinante;
    }

    public function ibanOrdinante()
    {
        return $this->_m_ibanOrdinante;
    }

    public function filler()
    {
        return $this->_m_filler;
    }
}

namespace cbi\parse;

class InfMovimento extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_numeroProgressivo = $this->_io->readBytes(7);
        $this->_m_progressivoMovimento = $this->_io->readBytes(3);
        $this->_m_flagStruttura = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(3), "utf-8");
        switch ($this->flagStruttura()) {
            case "ZZ2":
                $this->_m_content = new \cbi\parse\BonificiEstero2($this->_io, $this, $this->_root);
                break;
            case "ZZ3":
                $this->_m_content = new \cbi\parse\BonificiEstero3($this->_io, $this, $this->_root);
                break;
            case "YYY":
                $this->_m_content = new \cbi\parse\PrimoRecord63CausaleCbi($this->_io, $this, $this->_root);
                break;
            case "RI2":
                $this->_m_content = new \cbi\parse\RecordRi2($this->_io, $this, $this->_root);
                break;
            case "ID1":
                $this->_m_content = new \cbi\parse\RecordId1($this->_io, $this, $this->_root);
                break;
            case "ZZ1":
                $this->_m_content = new \cbi\parse\BonificiEstero1($this->_io, $this, $this->_root);
                break;
            case "RI1":
                $this->_m_content = new \cbi\parse\RecordRi1($this->_io, $this, $this->_root);
                break;
            case "YY2":
                $this->_m_content = new \cbi\parse\SecondoRecord63($this->_io, $this, $this->_root);
                break;
            case "KKK":
                $this->_m_content = new \cbi\parse\PrimoRecord63($this->_io, $this, $this->_root);
                break;
            default:
                $this->_m_content = new \cbi\parse\RecordGen($this->_io, $this, $this->_root);
                break;
        }
    }

    protected $_m_numeroProgressivo;
    protected $_m_progressivoMovimento;
    protected $_m_flagStruttura;
    protected $_m_content;

    public function numeroProgressivo()
    {
        return $this->_m_numeroProgressivo;
    }

    public function progressivoMovimento()
    {
        return $this->_m_progressivoMovimento;
    }

    public function flagStruttura()
    {
        return $this->_m_flagStruttura;
    }

    public function content()
    {
        return $this->_m_content;
    }
}

namespace cbi\parse;

class BonificiEstero2 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_ordinanteDelPagamento = $this->_io->readBytes(104);
    }

    protected $_m_ordinanteDelPagamento;

    public function ordinanteDelPagamento()
    {
        return $this->_m_ordinanteDelPagamento;
    }
}

namespace cbi\parse;

class RecordCoda extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_mittente = $this->_io->readBytes(5);
        $this->_m_ricevente = $this->_io->readBytes(5);
        $this->_m_dataCreazione = $this->_io->readBytes(6);
        $this->_m_nomeSupporto = $this->_io->readBytes(20);
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

    public function mittente()
    {
        return $this->_m_mittente;
    }

    public function ricevente()
    {
        return $this->_m_ricevente;
    }

    public function dataCreazione()
    {
        return $this->_m_dataCreazione;
    }

    public function nomeSupporto()
    {
        return $this->_m_nomeSupporto;
    }

    public function filler1()
    {
        return $this->_m_filler1;
    }

    public function numeroRendicontazioni()
    {
        return $this->_m_numeroRendicontazioni;
    }

    public function filler2()
    {
        return $this->_m_filler2;
    }

    public function numeroRecord()
    {
        return $this->_m_numeroRecord;
    }

    public function filler3()
    {
        return $this->_m_filler3;
    }

    public function nonDisponibile()
    {
        return $this->_m_nonDisponibile;
    }
}

namespace cbi\parse;

class RecordGen extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
    }

    protected $_m_descrizione;

    public function descrizione()
    {
        if ($this->_m_descrizione !== null)
            return $this->_m_descrizione;
        $_pos = $this->_io->pos();
        $this->_io->seek(13);
        $this->_m_descrizione = $this->_io->readBytes(107);
        $this->_io->seek($_pos);
        return $this->_m_descrizione;
    }
}

namespace cbi\parse;

class BonificiEstero3 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_beneficiario = $this->_io->readBytes(50);
        $this->_m_motivazioneDelPagamento = $this->_io->readBytes(54);
    }

    protected $_m_beneficiario;
    protected $_m_motivazioneDelPagamento;

    public function beneficiario()
    {
        return $this->_m_beneficiario;
    }

    public function motivazioneDelPagamento()
    {
        return $this->_m_motivazioneDelPagamento;
    }
}

namespace cbi\parse;

class SaldoLiquido extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\LiquiditaFuture $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_dataLiquidita = $this->_io->readBytes(6);
        $this->_m_segno = $this->_io->readBytes(1);
        $this->_m_saldoLiquido = $this->_io->readBytes(6);
    }

    protected $_m_dataLiquidita;
    protected $_m_segno;
    protected $_m_saldoLiquido;

    public function dataLiquidita()
    {
        return $this->_m_dataLiquidita;
    }

    public function segno()
    {
        return $this->_m_segno;
    }

    public function saldoLiquido()
    {
        return $this->_m_saldoLiquido;
    }
}

namespace cbi\parse;

class RecordId1 extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\InfMovimento $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_indentificativoUnivocoMessaggio = $this->_io->readBytes(35);
        $this->_m_identificativoEte = $this->_io->readBytes(35);
        $this->_m_filler = $this->_io->readBytes(34);
    }

    protected $_m_indentificativoUnivocoMessaggio;
    protected $_m_identificativoEte;
    protected $_m_filler;

    public function indentificativoUnivocoMessaggio()
    {
        return $this->_m_indentificativoUnivocoMessaggio;
    }

    public function identificativoEte()
    {
        return $this->_m_identificativoEte;
    }

    public function filler()
    {
        return $this->_m_filler;
    }
}

namespace cbi\parse;

class SaldoFinale extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
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

    public function numeroProgressivo()
    {
        return $this->_m_numeroProgressivo;
    }

    public function codiceDivisa()
    {
        return $this->_m_codiceDivisa;
    }

    public function dataContabile()
    {
        return $this->_m_dataContabile;
    }

    public function segnoSaldoContabile()
    {
        return $this->_m_segnoSaldoContabile;
    }

    public function saldoContabile()
    {
        return $this->_m_saldoContabile;
    }

    public function segnoSaldoLiquido()
    {
        return $this->_m_segnoSaldoLiquido;
    }

    public function saldoLiquido()
    {
        return $this->_m_saldoLiquido;
    }

    public function filler1()
    {
        return $this->_m_filler1;
    }

    public function filler2()
    {
        return $this->_m_filler2;
    }
}

namespace cbi\parse;

class LiquiditaFuture extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_numeroProgressivo = $this->_io->readBytes(7);
        $this->_m_saldo1 = new \cbi\parse\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo2 = new \cbi\parse\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo3 = new \cbi\parse\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo4 = new \cbi\parse\SaldoLiquido($this->_io, $this, $this->_root);
        $this->_m_saldo5 = new \cbi\parse\SaldoLiquido($this->_io, $this, $this->_root);
    }

    protected $_m_numeroProgressivo;
    protected $_m_saldo1;
    protected $_m_saldo2;
    protected $_m_saldo3;
    protected $_m_saldo4;
    protected $_m_saldo5;

    public function numeroProgressivo()
    {
        return $this->_m_numeroProgressivo;
    }

    public function saldo1()
    {
        return $this->_m_saldo1;
    }

    public function saldo2()
    {
        return $this->_m_saldo2;
    }

    public function saldo3()
    {
        return $this->_m_saldo3;
    }

    public function saldo4()
    {
        return $this->_m_saldo4;
    }

    public function saldo5()
    {
        return $this->_m_saldo5;
    }
}

namespace cbi\parse;

class Record extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Cbi $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_separator = $this->_io->ensureFixedContents("\x20");
        $this->_m_tipoRecord = \Kaitai\Struct\Stream::bytesToStr($this->_io->readBytes(2), "utf-8");
        switch ($this->tipoRecord()) {
            case "64":
                $this->_m_content = new \cbi\parse\SaldoFinale($this->_io, $this, $this->_root);
                break;
            case "EF":
                $this->_m_content = new \cbi\parse\RecordCoda($this->_io, $this, $this->_root);
                break;
            case "65":
                $this->_m_content = new \cbi\parse\LiquiditaFuture($this->_io, $this, $this->_root);
                break;
            case "RH":
                $this->_m_content = new \cbi\parse\RecordTesta($this->_io, $this, $this->_root);
                break;
            case "61":
                $this->_m_content = new \cbi\parse\SaldoInziale($this->_io, $this, $this->_root);
                break;
            case "62":
                $this->_m_content = new \cbi\parse\Movimento($this->_io, $this, $this->_root);
                break;
            case "63":
                $this->_m_content = new \cbi\parse\InfMovimento($this->_io, $this, $this->_root);
                break;
            default:
                $this->_m_content = new \cbi\parse\Undefined($this->_io, $this, $this->_root);
                break;
        }
    }

    protected $_m_separator;
    protected $_m_tipoRecord;
    protected $_m_content;

    public function separator()
    {
        return $this->_m_separator;
    }

    public function tipoRecord()
    {
        return $this->_m_tipoRecord;
    }

    public function content()
    {
        return $this->_m_content;
    }
}

namespace cbi\parse;

class Undefined extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
    }
}

namespace cbi\parse;

class SaldoInziale extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_numeroProgressivo = $this->_io->readBytes(7);
        $this->_m_filler1 = $this->_io->readBytes(13);
        $this->_m_codiceAbiOriginarioBanca = $this->_io->readBytes(5);
        $this->_m_causale = $this->_io->readBytes(5);
        $this->_m_descrizione = $this->_io->readBytes(16);
        $this->_m_tipoConto = $this->_io->readBytes(2);
        $this->_m_cinBanca = $this->_io->readBytes(1);
        $this->_m_codiceAbiBanca = $this->_io->readBytes(5);
        $this->_m_cabBanca = $this->_io->readBytes(5);
        $this->_m_contoCorrenteBanca = $this->_io->readBytes(12);
        $this->_m_codiceDivisa = $this->_io->readBytes(3);
        $this->_m_dataContabile = $this->_io->readBytes(6);
        $this->_m_segno = $this->_io->readBytes(1);
        $this->_m_saldoInizialeQuadratura = $this->_io->readBytes(15);
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
    protected $_m_contoCorrenteBanca;
    protected $_m_codiceDivisa;
    protected $_m_dataContabile;
    protected $_m_segno;
    protected $_m_saldoInizialeQuadratura;
    protected $_m_codicePaese;
    protected $_m_checkDigit;
    protected $_m_filler2;

    public function numeroProgressivo()
    {
        return $this->_m_numeroProgressivo;
    }

    public function filler1()
    {
        return $this->_m_filler1;
    }

    public function codiceAbiOriginarioBanca()
    {
        return $this->_m_codiceAbiOriginarioBanca;
    }

    public function causale()
    {
        return $this->_m_causale;
    }

    public function descrizione()
    {
        return $this->_m_descrizione;
    }

    public function tipoConto()
    {
        return $this->_m_tipoConto;
    }

    public function cinBanca()
    {
        return $this->_m_cinBanca;
    }

    public function codiceAbiBanca()
    {
        return $this->_m_codiceAbiBanca;
    }

    public function cabBanca()
    {
        return $this->_m_cabBanca;
    }

    public function contoCorrenteBanca()
    {
        return $this->_m_contoCorrenteBanca;
    }

    public function codiceDivisa()
    {
        return $this->_m_codiceDivisa;
    }

    public function dataContabile()
    {
        return $this->_m_dataContabile;
    }

    public function segno()
    {
        return $this->_m_segno;
    }

    public function saldoInizialeQuadratura()
    {
        return $this->_m_saldoInizialeQuadratura;
    }

    public function codicePaese()
    {
        return $this->_m_codicePaese;
    }

    public function checkDigit()
    {
        return $this->_m_checkDigit;
    }

    public function filler2()
    {
        return $this->_m_filler2;
    }
}

namespace cbi\parse;

class RecordTesta extends \Kaitai\Struct\Struct
{
    public function __construct(\Kaitai\Struct\Stream $_io, \cbi\parse\Record $_parent = null, \cbi\parse\Cbi $_root = null)
    {
        parent::__construct($_io, $_parent, $_root);
        $this->_read();
    }

    private function _read()
    {
        $this->_m_mittente = $this->_io->readBytes(5);
        $this->_m_ricevente = $this->_io->readBytes(5);
        $this->_m_dataCreazione = $this->_io->readBytes(6);
        $this->_m_nomeSupporto = $this->_io->readBytes(20);
        $this->_m_filler = $this->_io->readBytes(76);
        $this->_m_nonDisponibile = $this->_io->readBytes(5);
    }

    protected $_m_mittente;
    protected $_m_ricevente;
    protected $_m_dataCreazione;
    protected $_m_nomeSupporto;
    protected $_m_filler;
    protected $_m_nonDisponibile;

    public function mittente()
    {
        return $this->_m_mittente;
    }

    public function ricevente()
    {
        return $this->_m_ricevente;
    }

    public function dataCreazione()
    {
        return $this->_m_dataCreazione;
    }

    public function nomeSupporto()
    {
        return $this->_m_nomeSupporto;
    }

    public function filler()
    {
        return $this->_m_filler;
    }

    public function nonDisponibile()
    {
        return $this->_m_nonDisponibile;
    }
}
