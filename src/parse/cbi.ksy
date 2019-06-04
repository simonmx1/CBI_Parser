meta:
  id: cbi
  title: cbi movement
  file-extension: txt
  xref: https://www.cbi-org.eu/
  license: CC0-1.0
  endian: le
  encoding: utf-8


seq:
  - id: record
    size: 122
    type: record
    repeat: eos


types:
  record:
    seq:
      - id: separator
        contents: " "
        size: 1
      - id: tipo_record
        doc: Contiene il tipo die Documento CBI
        size: 2
        type: str
      - id: content
        doc: Tutti i record nel documento CBI incl. saldi
        type:
          switch-on: tipo_record
          cases:
            '"RH"': record_testa
            '"EC"': record_testa
            '"EF"': record_coda
            '"61"': saldo_inziale
            '"62"': movimento
            '"63"': inf_movimento
            '"64"': saldo_finale
            '"65"': liquidita_future
            _: undefined


  undefined: {}
  
  
  record_testa:
    seq:
      - id: mittente
        doc: codice ABI della Banca mittente degli estratti conto
        type: str
        size: 5
      - id: ricevente
        doc: codice SIA dell'Impresa destinataria della rendicontazione conti correnti
        type: str
        size: 5
      - id: data_creazione
        doc: data di creazione del flusso da parte della Banca
        type: str
        size: 6
      - id: nome_supporto
        doc: campo di libera composizione da parte della Banca Mittente
        type: str
        size: 20
      - id: filler
        size: 76
      - id: non_disponibile
        size: 5

  record_coda:
    seq:
      - id: mittente
        doc: codice ABI della Banca mittente degli estratti conto
        type: str
        size: 5
      - id: ricevente
        doc: codice SIA dell'Impresa destinataria della rendicontazione conti correnti
        type: str
        size: 5
      - id: data_creazione
        doc: data di creazione del flusso da parte della Banca
        type: str
        size: 6
      - id: nome_supporto
        doc: campo di libera composizione da parte della Banca Mittente
        type: str
        size: 20
      - id: filler1
        size: 6
      - id: numero_rendicontazioni
        doc: totale delle rendicontazioni di conto corrente contenute nel flusso
        type: str
        size: 7
      - id: filler2
        size: 30
      - id: numero_record
        doc: numero dei record che compongono il flusso
        size: 7
      - id: filler3
        size: 25
      - id: non_disponibile
        size: 6


  saldo_inziale:
    seq:
      - id: numero_progressivo
        doc: numero della rendicontazione all'interno del flusso
        type: str
        size: 7
      - id: filler1
        size: 13
      - id: codice_abi_originario_banca
        doc: da valorizzare con il codice della Banca assorbita
        type: str
        size: 5
      - id: causale
        doc: assume il valore fisso 93001 o 93011
        type: str
        size: 5
      - id: descrizione
        doc: descrizione del rapporto di c/c
        type: str
        size: 16
      - id: tipo_conto
        doc: codice tipo conto assegnato dalla Banca
        type: str
        size: 2
      - id: cin_banca
        doc: carattere di controllo delle coordinate bancarie ABI
        type: str
        size: 1
      - id: codice_abi_banca
        doc: codice ABI banca mittente
        size: 5
      - id: cab_banca
        doc: cab banca mittente
        type: str
        size: 5
      - id: conto_corrente
        doc: codice conto corrente BBAN
        size: 12
      - id: codice_divisa
        doc: Codice divisa
        size: 3
      - id: data_contabile
        doc: data contabile di riferimento del saldo
        size: 6
      - id: segno
        doc: assume i valori D (Debito) - C (Credito)
        size: 1
      - id: saldo_iniziale
        doc: Saldo iniziale di quadrattura della rendicontazione
        size: 15
      - id: codice_paese
        doc: Puo assumere solo i valori IT o SM
        size: 2
      - id: check_digit
        doc: Check digit IBAN
        size: 2
      - id: filler2
        size: 17
  
  
  movimento:
    seq:
      - id: numero_progressivo
        doc: stesso numero del tipo record 61 della rendicontazione
        size: 7
      - id: progressivo_movimento
        doc: inizia da 001; al raggiongimento di 999 reinizia da 001
        size: 3
      - id: data_valuta
        doc: valuta del movimento
        size: 6
      - id: data_registrazione
        doc: data di registrazione/contabile del movimento
        size: 6
      - id: segno_movimento
        doc: assume i valori D (Debito) - C (Credito)
        size: 1
      - id: importo_movimento
        doc: Importodel Movimento
        size: 15
      - id: causale_cbi
        doc: causale CBI
        size: 2
      - id: causale_interna
        doc: causale secondo la codifica proprietaria della banca
        size: 2
      - id: numero_assegno
        size: 16
      - id: riferimento_banca
        doc: numero di riferimento operazione attribuito dalla Banca
        size: 16
      - id: tipo_riferimento_cliente
        doc: NROSUPCBI o PAYORDREF o NRPRATICA o NDISTINTA o RIFESICBI
        size: 9
      - id: descrizione_movimento
        doc: NROSUPCBI o PAYORDREF o NRPRATICA o NDISTINTA o RIFESICBI
        size: 34
  
  
  inf_movimento:
    seq:
      - id: numero_progressivo
        doc: stesso numero del record 61 della rendicontazione
        size: 7
      - id: progressivo_movimento
        doc: stesso progressivo del tipo 62
        size: 3
      - id: flag_struttura
        doc: se presente, tipo di informazione
        type: str
        size: 3
      - id: content
        type:
          switch-on: flag_struttura
          cases:
            '"KKK"': primo_record63
            '"YYY"': primo_record63_causale_cbi48
            '"YY2"': secondo_record63
            '"ZZ1"': bonifici_estero1
            '"ZZ2"': bonifici_estero2
            '"ZZ3"': bonifici_estero3
            '"ID1"': record_id1
            '"RI1"': record_ri1
            '"RI2"': record_ri2
            _: record_gen

  
  primo_record63:
    seq:
      - id: identificativo_rapporto
        doc: per le operazioni di cash pooling contiene le coordinate bancarie
        size: 23
      - id: filler
        size: 81
  
  
  primo_record63_causale_cbi48:
    seq:
      - id: data_ordine
        doc: data ordine del cliente ordinante nel formato GGMMAAAA
        size: 8
      - id: codice_fiscale_ordinante
        doc: codice fiscale dell'ordinante
        size: 16
      - id: cliente_ordinante
        doc: cognome nome ovvero denominazione / ragione sociale dell'ordinante
        size: 40
      - id: localita
        doc: localita di residenza del cliente ordinante
        size: 40
  
  
  secondo_record63:
    seq:
      - id: indirizzo_ordinante
        doc: Via/piazza e numero civico di residenza del cliente ordinante
        size: 50
      - id: iban_ordinante
        doc: Coordinata IBAN completa secondo lo standard ISO 3166
        size: 34
      - id: filler
        size: 20
  
  
  bonifici_estero1:
    seq:
      - id: importo_originario_pagamento
        doc: importo disposto dall'ordinante al lordo delle commissioni
        size: 18
      - id: codice_divisa_importo_originario
        doc: codice divisa dell'importo precedente
        size: 3
      - id: importo_regolato
        doc: importo regolato tra banche
        size: 18
      - id: codive_divisa_regolamento
        doc: codice divisa dell'importo precedente
        size: 18
      - id: importo_negoziato
        doc: rapresenta il contravalore in divisa dell'importo contabilizzato
        size: 3
      - id: codice_divisa_importo_negoziato
        doc: codice divisa dell'importo precedente
        size: 3
      - id: cambio_applicato
        doc: tasso di cambio applicato
        size: 12
      - id: importo_commissioni
        doc: da indicare se non contabilizzate separamente dall'importo del pagamento
        size: 13
      - id: importo_spese
        doc: da indicare se non contabilizzate separamente dall'importo del pagamento
        size: 13
      - id: codice_paese
        doc: cod. Paese di provenienza o di destinazione dei fondi, secondo UIC
        size: 3
  
  
  bonifici_estero2: 
    seq:
      - id: ordinante_del_pagamento
        doc: indica per esteso l'ordinante del pagamento
        size: 104


  bonifici_estero3:
    seq:
      - id: beneficiario
        doc: beneficario del pagamento
        size: 50
      - id: motivazione_del_pagamento
        doc: motivazione del pagamento come indicata dalla banca
        size: 54
  
  
  record_id1:
    seq:
      - id: indentificativo_univoco_messaggio
        doc: identificativo univoco messagio
        size: 35
      - id: identificativo_ete
        doc: identificativo End to End
        size: 35
      - id: filler
        size: 34
  
  
  record_ri1:
    seq:
      - id: informazioni_riconcilazione
        doc: Informazioni di riconciliazione
        size: 104
  
  
  record_ri2:
    seq:
      - id: informazioni_riconcilazione
        doc: Informazioni di riconciliazione
        size: 36
      - id: filler
        size: 68


  record_gen:
    instances:
      descrizione:
        doc: descrizione del movimento in testo libero
        pos: 13
        size: 107

  
  saldo_finale:
    seq:
      - id: numero_progressivo
        doc: stesso numero del tipo record 61 della rendicontazione
        size: 7
      - id: codice_divisa
        doc: codice divisa
        size: 3
      - id: data_contabile
        doc: data con la quale la Banca ha contabilizzato il saldo
        size: 6
      - id: segno_saldo_contabile
        doc: assume i valori D (Debito) - C (Credito)
        size: 1
      - id: saldo_contabile
        doc: saldo contabile di chiusura della giornata di riferimento
        size: 15
      - id: segno_saldo_liquido
        doc: assume i valori D (Debito) - C (Credito)
        size: 1
      - id: saldo_liquido
        doc: saldo liquido della giornata
        size: 15
      - id: filler1
        size: 54
      - id: filler2
        size: 15


  liquidita_future:
    seq:
      - id: numero_progressivo
        doc: stesso numero del tipo record 61 della rendicontazione
        size: 7
      - id: saldo1
        type: saldo_liquido
      - id: saldo2
        type: saldo_liquido
      - id: saldo3
        type: saldo_liquido
      - id: saldo4
        type: saldo_liquido
      - id: saldo5
        type: saldo_liquido
      
      
  saldo_liquido:
    seq:
      - id: data_liquidita
        doc: data di riferimento del saldo successivo
        size: 6
      - id: segno
        doc: assume i valori D (Debito) - C (Credito)
        size: 1
      - id: saldo_liquido
        doc: saldo liquido alla data precedente
        size: 6