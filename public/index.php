<!DOCTYPE HTML>
<html lang="EN">
<head>
    <title>Input for SCT-Payments</title>
    <style>
        body {
            font-family: Arial, serif;
        }

        input {
            border: 2px solid black;
        }

    </style>
</head>
<body>
<form id="general">
    Importo:<br>
    <input type="text" name="importo"><br>
    Data Esecuzione:<br>
    <input type="text" name="data_esec"><br>
    Messaggio:<br>
    <input type="text" name="msg"><br>

</form>
<form id="deb" style="float: right">
    IBAN Debitore:<br>
    <input type="text" name="iban_deb"><br>
    Nome Azienda Debitore:<br>
    <input type="text" name="nome_deb"><br>
    Codice Fiscale Debitore:<br>
    <input type="text" name="codFisc_deb"><br>
    codCUC:<br>
    <input type="text" name="cuc"><br>
</form>
<form id="cre" style="float: left">
    IBAN Creditore:<br>
    <input type="text" name="iban_cre"><br>
    Nome Azienda Creditore:<br>
    <input type="text" name="nome_cre"><br>
    Codice Fiscale Creditore:<br>
    <input type="text" name="codFisc_cre"><br>
</form>
</body>
</html>
<?php
