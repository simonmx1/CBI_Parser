<?php

namespace cbi\pub;

require_once __DIR__ . "/../vendor/autoload.php";

use \cbi\parse\Parser;
use Exception;

//include '../src/parse/Parser.php';

$server = 'localhost:3306';
$database = 'cbi_movements';
$user = 'root';
$password = '';
$file = "/home/simon/Desktop/CBI/records/06045_06045E8330_REND-CC_20190527_35109_p2_INFO.T191480305555.MOV.txt";

try {
    $p = new Parser($server, $database, $user, $password, $file);
} catch (Exception $e) {

}
var_dump($p);