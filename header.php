<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Enrollment System">
<meta name="author" content="McJim Maata">
<title>WPH Enrollment System</title>
<link rel="shortcut icon" href="img/logo.png" />

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<!-- Custom styles for this template -->
<link href="offcanvas.css" rel="stylesheet">
</head>

<script src="assets/js/head.js"></script>

<body>
<!--<body style="background:url(img/students.png?<?php echo date("h:i:s");?>)no-repeat;background-size:cover">-->

<?php
	error_reporting(0);
	if(!isset($_SESSION['ACCOUNT_USERNAME'])){
		header("location:index.php");
	}	
?>
