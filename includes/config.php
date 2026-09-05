<?php
error_reporting(0);
/**
* Description  : The main class for Database.
* Author	   : McJim Maata
* Date Created : October 27, 2013
* Revised By   :		
*/

	//Database Constants
	require("connect1.php");
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
