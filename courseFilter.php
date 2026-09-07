<?php
	require_once("includes/initialize.php");
	include 'header.php';
	
	include("menu.php");
?>

<div class="container">

<script>setActive("entry");</script>

<?php
if (isset($_POST['search'])){

	redirect('listofcourse.php?idno='. $_POST['coursename'].'&Major='.$_POST['Major']);
			
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

					 
				          <div class="form-group" id="idno">
				            <div class="col-md-12">
				             <label class="col-md-4 control-label" for="coursename">Course Name:</label>
				                <div class="col-md-8">
				                  <input class="form-control input-sm" id="coursename" name="coursename" type="text" placeholder="Course Code">
				                </div>
				            </div>
				          </div>

				          <div class="form-group" id="idno">
				            <div class="col-md-12">
				               <label class="col-md-4 control-label" for="Major">Major:</label>
				                <div class="col-md-8">
				                  <input class="form-control input-sm" id="Major" name="Major" type="text" placeholder="Major">
				                </div>
				            </div>
				          </div>

						<div class="form-group">
				            <div class="col-md-12">
				                <div class="col-md-8 col-md-offset-4">
							         <div class="filter-query-actions">
									    <button type="submit" name="search" class="btn btn-primary"><i class="fas fa-search"></i> View</button>
									    <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-undo"></i> Reset</button>
									    <a href="newcourse.php" name="add" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Add</a>
									</div>
				                </div>
				            </div>
				          </div>
				          



					  </div>
					</div>
									
				</form>
		  </div>
		    <div class="col-md-3">
		  
		  </div>

		</div>		
			
</div><!--End of container-->
			

<?php include("footer.php") ?>



