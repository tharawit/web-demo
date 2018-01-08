<?php
class condb {
    private $db = null;
    private function __construct(){
        /* Connect database */
        $IP = "localhost";                                      /*******CHANGE******/
        $server_location_path = "http://".$IP."/imgs/";
        // Database info
        //$servername = "localhost";
        $servername = "172.17.0.2";                             /*******CHANGE******/
        $username = "root";
        $password = "1234";
        $database = "db";
        $this->db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    }
    public function query($str){
        $this->db->query($str);
        $this->db->close();
    }
}
?>
