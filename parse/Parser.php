
<?php


class Parser
{
    private $connection;
    private $dbserver = "localhost";
    private $database = "cbi_movements";
    private $user = "root";
    private $password = "";
    private $txtParser;

    function __construct()
    {
        try {
            $this->connection = (new ConnectDatabase($this->dbserver, $this->database, $this->user, $this->password))->getConnection();
        } catch (Exception $e) {
        }

        $file = \Cbi::fromFile("/home/simon/Desktop/CBI/records/06045_06045E8330_REND-CC_20190527_35109_p2_INFO.T191480305555.MOV.txt");

        $stream = fopen('php://memory','r+');
        fwrite($stream, $file);
        rewind($stream);

        var_dump($file);

        $this->txtParser = new Cbi($stream);

    }

}