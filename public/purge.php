<?php

/**
 * purge.php
 *
 * Connects to database and DELETES everything
 *
 * @package    public
 * @author     Simon Muscatello
 */

//remove all data from the database
$c = new PDO("mysql:host=127.0.0.1;dbname=cbi_movements", "root", "");
$c->query("SET NAMES utf8");
$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$action = readline("Delete Action (all, mov or pay): ");

if ($action == 'all') {
    printf($c->exec("DELETE FROM movimenti_completi") . " complete movements deleted\n");
    printf($c->exec("DELETE FROM cbi") . " cbi documents deleted (and all their records)\n");
    printf($c->exec("DELETE FROM pagamenti_SCT") . " SEPA Transfer Credit payments deleted\n");
} else
    if ($action == "mov") {
        printf($c->exec("DELETE FROM movimenti_completi") . " complete movements deleted\n");
        printf($c->exec("DELETE FROM cbi") . " cbi documents deleted (and all their records)\n");
    } else
        if ($action == 'pay')
            printf($c->exec("DELETE FROM pagamenti_SCT") . " SEPA Transfer Credit payments deleted\n");
