<?php

/**
 * purge.php
 *
 * Connects to database and DELETES everything
 *
 * @package    src/database
 * @author     Simon Muscatello
 */

//remove all data from the database
$c = new PDO("mysql:host=127.0.0.1;dbname=cbi_movements", "root", "");
$c->query("SET NAMES utf8");
$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

printf($c->exec("DELETE FROM movimenti_completi WHERE mc_segno = \"C\"")
    + $c->exec("DELETE FROM movimenti_completi WHERE mc_segno = \"D\"")
    + $c->exec("DELETE FROM cbi WHERE cbi_type =\"RH\"")
    + $c->exec("DELETE FROM cbi WHERE cbi_type =\"EC\"") . " rows deleted\n");
