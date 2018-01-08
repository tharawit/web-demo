<?php
class Condb {
	private $db = null;

	function __construct(){
		// $servername = "localhost";
		$servername = "172.17.0.2"; /*******CHANGE******/
		$username = "root";
		$password = "1234";
		$database = "db";
		$this->db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	}

	public function db_get_status(){
		return $this->db;
	}

	public function db_close(){
		$this->db = null;
	}

	public function db_fillter($str){
		$result = 'pass';
		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
		if(preg_match($pattern, $str)){
			$result = 'err';
		}
		return $result;
	}

	public function db_query($sql){
		$this->db->query($sql);
	}

	public function db_fetch($sql){
		$query = $this->db->query($sql);
		return $query->fetchAll();
	}
}

