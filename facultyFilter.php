<?php
	require_once("includes/initialize.php");
	include 'header.php';

	if($_SESSION['ACCOUNT_TYPE']=="Registrar"){
		include("menu_registrar.php");
	} else if($_SESSION['ACCOUNT_TYPE']=="Encoder"){
		include("menu_encoder.php");
	} else {
		include("menu.php");
	}
?>

<script>setActive("entry");</script>

<div class="container">

<?php
if (isset($_POST['search'])){

	redirect('listofinstructor.php?instuctorId='. $_POST['instuctorId'].'&FullName='.$_POST['FullName'].'');
			
}

?>		
		<div class="rows">
		  <div class="col-md-3">
		  
		  </div>

		  <div class="col-md-6">
		  <form class="form-horizontal span4" action="#.php" method="POST">

					<div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3 class="panel-title"><span class="glyphicon glyphicon-filter"></span> Query Options</h3>
					  </div>
					  <div class="panel-body">
				          <div class="form-group" id="instuctorId">
				            <div class="col-md-10">
				             <label class="col-md-4 control-label" for="Name">Name:</label>

				                <div class="col-md-8">
				                  <input class="form-control input-sm" id="FullName" name="FullName" type="text" placeholder="Name">
				                </div>

				            </div>

				          </div>
				           
						<div class="form-group" id="instuctorId">
				            <div class="col-md-10">
				               <label class="col-md-4 control-label"></label>

				                <div class="col-md-8">
							         <div class="btn-group">
									    <button type="submit" name="search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> View</button>
									    <button type="Reset" name="search" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
									    <a href="newfaculty.php" name="add" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span> Add</a>
									  
									  
									</div>
				                </div>

				            </div>

				          </div>
				          



					  </div>
					</div>
									
				</form>
		  </div>
		    <div class="col-md-8">
		  
		  </div>

		</div>		
			
</div><!--End of container-->
			

<?php include("footer.php") ?>



