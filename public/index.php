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
use Exception;

$server = '127.0.0.1';
$database = 'cbi_movements';
$user = 'root';
$password = '';
$file = "/home/simon/Desktop/CBI/records/06045_06045E8330_REND-CC_20190527_35109_p2_INFO.T191480305555.MOV.txt";
$file2 = "/home/simon/Desktop/CBI/records/06045_06045E8330_REND-CC_20190524_35105_p2_INFO.T191450335574.MOV.txt";
$fileEC = "/home/simon/Desktop/CBI/records/06045_06045E8330_REND-EC_20190401_3714_p2_INFO.T190920238325.MOV.txt";
$testfile = "/home/simon/Desktop/test.txt";

try {
    new Parser($server, $database, $user, $password, $testfile);
} catch (Exception $e) {

}
