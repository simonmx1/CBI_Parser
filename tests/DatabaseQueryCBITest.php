<?php

namespace cbitest;

use cbi\database\Database;
use cbi\parse\Parser;
use PHPUnit\Framework\TestCase;

class DatabaseQueryCBITest extends TestCase {

    private $server = '127.0.0.1';
    private $database = 'cbi_movements';
    private $user = 'root';
    private $password = '';

    public function testQueryCBI() {

        new Parser($this->server, $this->database, $this->user, $this->password,
            array("/home/simon/Desktop/CBI/records/TXT/06045_06045E8330_REND-CC_20190228_34703_p2_INFO.T190600406516.MOV.txt"));

        $db = new Database($this->server, $this->database, $this->user, $this->password);

        $res = $db->getConnection()->exec("SELECT cbi_doc FROM cbi");

        var_dump($res);
    }

}
