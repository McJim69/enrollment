<?php
	require("connect1.php");
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 
	if($conn === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	try{
		$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	
	}catch(PDOException $error){
		echo $error->getmessage();
	}		
?>