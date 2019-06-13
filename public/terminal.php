<?php

/**
 * terminal.php
 *
 * Main php-file of my CBI-Standard parser and SEPA Credit Transfer XML-Generator
 *
 * @package    public
 * @author     Simon Muscatello
 */

namespace cbi\pub;

require_once __DIR__ . "/../vendor/autoload.php";

use cbi\parse\Parser;
use cbi\payment\Payment;
use cbi\pub\prv\Infos;

include "private/Infos.php";

$i = new Infos();

$database = $i->database;

while (true) {
    $action = readline("Action (ec, pay, del or ex): ");
    if (strpos($action, ' ') !== false) {
        $m = substr($action, strpos($action, ' ') + 1);
        var_dump($m);
        $action = substr($action, 0, strpos($action, ' '));
    } else
        $m = null;
    switch ($action) {

        case 'ec':
            $files = glob("/home/simon/Desktop/CBI/records/TXT/*.txt");
            new Parser($database, $files);
            break;

        case 'pay':
            if ($m == null)
                $importo = readline("Importo (0.00): ");
            else
                $importo = $m;
            $sct = array('importo' => $importo, 'dataEsec' => $i->dataEsec, 'msg' => $i->msg, 'deb' => $i->deb, 'cre' => $i->cre);
            new Payment($database, $sct);
            break;

        case 'del':
            include 'purge.php';
            break;

        case 'delall':

            break;
        default:
            break;
    }

    if ($action == 'ex' || $action == 'exit')
        break;
}