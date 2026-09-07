<?php
/**
* Description:	The main class for Database (PHP 8 & MySQLi Compatible).
* Author:		McJim Maata
*/

require_once(LIB_PATH.DS."config.php");

class Database {
	var $sql_string = '';
	var $error_no = 0;
	var $error_msg = '';
	public $conn;
	public $last_query;
	
	function __construct() {
		$this->open_connection();
	}
	
	public function open_connection() {
		global $conn;
		if (isset($conn) && $conn instanceof mysqli) {
			$this->conn = $conn;
		} else {
			$this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if (!$this->conn) {
				die("Problem in database connection: " . mysqli_connect_error());
			}
		}
	}
	
	function setQuery($sql='') {
		$this->sql_string = $sql;
	}
	
	function executeQuery() {
		$this->last_query = $this->sql_string;
		$result = mysqli_query($this->conn, $this->sql_string);
		$this->confirm_query($result);
		return $result;
	}	
	
	private function confirm_query($result) {
		if(!$result){
			$this->error_no = mysqli_errno($this->conn);
			$this->error_msg = mysqli_error($this->conn);
			return false;				
		}
		return $result;
	} 
	
	function loadResultList($key='') {
		$cur = $this->executeQuery();
		$array = array();
		if ($cur && $cur instanceof mysqli_result) {
			while ($row = mysqli_fetch_object($cur)) {
				if ($key && isset($row->$key)) {
					$array[$row->$key] = $row;
				} else {
					$array[] = $row;
				}
			}
			mysqli_free_result($cur);
		}
		return $array;
	}
	
	function loadSingleResult() {
		$cur = $this->executeQuery();
		$data = null;
		if ($cur && $cur instanceof mysqli_result) {
			if ($row = mysqli_fetch_object($cur)) {
				$data = $row;
			}
			mysqli_free_result($cur);
		}
		return $data;
	}
	
	function getFieldsOnOneTable($tbl_name) {
		$this->setQuery("DESC ".$tbl_name);
		$rows = $this->loadResultList();
		$f = array();
		for ($x = 0; $x < count($rows); $x++) {
			$f[] = $rows[$x]->Field;
		}
		return $f;
	}	

	public function fetch_array($result) {
		if ($result && $result instanceof mysqli_result) {
			return mysqli_fetch_array($result, MYSQLI_BOTH);
		}
		return false;
	}

	public function num_rows($result_set) {
		if ($result_set && $result_set instanceof mysqli_result) {
			return mysqli_num_rows($result_set);
		}
		return 0;
	}
  
	public function insert_id() {
		return mysqli_insert_id($this->conn);
	}
  
	public function affected_rows() {
		return mysqli_affected_rows($this->conn);
	}
	
	public function escape_value($value) {
		if (!isset($this->conn) || !$this->conn) {
			$this->open_connection();
		}
		return mysqli_real_escape_string($this->conn, (string)$value);
	}
	
	public function close_connection() {
		if (isset($this->conn) && $this->conn instanceof mysqli) {
			mysqli_close($this->conn);
			unset($this->conn);
		}
	}
} 

$mydb = new Database();
?>
