<?php

/**
 * index.php
 *
 * Main php-file of my CBI-Standard parser
 *
 * @package    public
 * @author     Simon Muscatello
 */

namespace cbi\pub;

require_once __DIR__ . "/../vendor/autoload.php";

use \cbi\parse\Parser;

//database
$server = '127.0.0.1';
$database = 'cbi_movements';
$user = 'root';
$password = '';

//$files = array("/home/simon/Desktop/test.txt");

$files = glob("/home/simon/Desktop/CBI/records/TXT/*.txt");

//start program
new Parser($server, $database, $user, $password, $files);
