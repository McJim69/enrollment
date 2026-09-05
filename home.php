<?php
	require_once("includes/initialize.php");
	include("header.php");

	if($_SESSION['ACCOUNT_TYPE']=="Student"){
		include("menu_student.php");
	} 
	
	else if($_SESSION['ACCOUNT_TYPE']=="Encoder"){
		include("menu_encoder.php");
	}
	
	else if($_SESSION['ACCOUNT_TYPE']=="Registrar"){
		include("menu_registrar.php");
	} 
	
	else {
		include("menu.php");
	}
  
		include("banner.php");  
	//
?>

<script>setActive("home");</script>

<body>

<!-- <body style="background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);"> -->

<div class="container">

<?php include("mission.php");?>
<!--/span--> 
	<div class="row row-offcanvas row-offcanvas-left">
		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
			<div class="sidebar-nav">
				<div class="panel" style="background:#eee;border:1px solid #bbb;box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);text-align:center">	
			  		<div class="panel-heading" style="background:#bbb;font-weight:bold">Login Information</div>
					   <div class="panel-body">	
							<div class="col-xs-12 col-sm-12">
								<p style="color:darkgreen">Welcome! you logged in as :</p>
							</div>					            					            		
							<div class="col-xs-12 col-sm-12">
							<span class="glyphicon glyphicon-user"> </span> <label><?php echo $_SESSION['ACCOUNT_NAME'];?></label><br/>
								<i><small>Account Type:</small></i></br>
							<span class="glyphicon glyphicon-cog"> </span> <label><?php echo $_SESSION['ACCOUNT_TYPE'];?></label></span>
							<div>
								<a href="logout.php" class="btn btn-primary">Logout <span class="glyphicon glyphicon-log-out"></a>
							</div>

							</div>					            					            		
						</div>
				</div>
			</div>
		</div>
	</div>
<!--/.well --> 
</div><!--container-->

<?php include("footer.php") ?>
