<?php
header('Content-type: text/javascript');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Call function condb
require("action/condb.php");
$con = new Condb();
$result = $con->db_fetch_assoc("SELECT name, type, time FROM images");
$con->db_close();
$result = json_encode($result, JSON_PRETTY_PRINT);

// Make json file
$fp = fopen('rawdata.json', 'w');
fwrite($fp, json_encode($result));
fclose($fp);

echo $result;
// header("location: rawdata.json");
?>
