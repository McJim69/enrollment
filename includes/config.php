<?php
error_reporting(0);

// Load DB configuration from includes/connect1.php using absolute path
require_once(__DIR__ . "/connect1.php");

// Fallback in case root connect1.php defined variables instead of constants
if (!defined('DB_HOST')) {
	if (isset($dbhost)) {
		define('DB_HOST', $dbhost);
		define('DB_USER', $dbuser);
		define('DB_PASS', $dbpass);
		define('DB_NAME', $dbname);
	} else {
		define('DB_HOST', 'localhost');
		define('DB_USER', 'McJim');
		define('DB_PASS', 'Restricted654123');
		define('DB_NAME', 'wpenrolldb');
	}
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conn === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

try{
	$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}catch(PDOException $error){
	echo $error->getmessage();
}		
?>
