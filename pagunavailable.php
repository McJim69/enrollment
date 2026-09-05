<?php 
	require_once("includes/initialize.php");
	include("header.php");

	if($_SESSION['ACCOUNT_TYPE']=="Registrar"){
		include("menu_registrar.php");
	} 	
	else if($_SESSION['ACCOUNT_TYPE']=="Encoder"){
		include("menu_encoder.php");
	} 
	else{
		include("menu.php");
	}
		include("banner2.php");
	//
?>

<script>setActive("settings");</script>

<center>
<div class="container" style='width:500px'>
	<div class="rows">
		<div class="alert alert-danger">TO DO LIST: SUMMARY REPORT<br>
			<img src="img/under-construction.png"/><br>
			<a href="home.php">Back to Homepage</a>
		</div>
	</div>
</div>
</center>
<?php include("footer.php");?>