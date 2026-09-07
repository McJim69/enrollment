<?php
	require_once("includes/initialize.php");
	include 'header.php';
	
	include("menu.php");
?>
<div class="container">

<?php

$userID = $_GET['id'];

$mydb->setQuery("SELECT * FROM useraccounts WHERE ACCOUNT_ID=$userID");

$cur = $mydb->loadResultList();
	foreach ($cur as $result) {
		$row_usid = $result->ACCOUNT_ID;
		$row_name = $result->ACCOUNT_NAME;
		$row_user = $result->ACCOUNT_USERNAME;
		$row_pass = $result->ACCOUNT_PASSWORD;
		$row_type = $result->ACCOUNT_TYPE;
	} 

if (isset($_POST['save'])){

	if ($_POST['name'] == "" OR $_POST['username'] == "" OR $_POST['pass'] == "") {
		$messageStats = false;
		message("All field is required!","error");
		check_message();
	}else{

		$userprof = new User();
		$accountID= $_GET['id'];
		$acc_name = $_POST['name'];
		$acc_user = $_POST['username'];
		$acc_pass = $_POST['pass'];
		$acc_type = $_POST['type'];

		$userprof->ACCOUNT_ID 		= $userID;
		$userprof->ACCOUNT_NAME		= $acc_name;
		$userprof->ACCOUNT_USERNAME = $acc_user;
		$userprof->ACCOUNT_PASSWORD = $acc_pass;
		$userprof->ACCOUNT_TYPE     = $acc_type;
		$userprof->update($accountID);
			message($acc_name. " profile has updated successfully!", "info");
			redirect('listofuser.php');

	}
}

?>			
  <form class="form-horizontal well span4" action="editUser.php?id=<?php echo $userID;?>" method="POST">

		<fieldset>
			<legend>Edit User Account</legend>
			  
			  <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for="name">Name:</label>

				  <div class="col-md-8">
					<input name="deptid" type="hidden" value="">
					 <input class="form-control input-sm" id="name" name="name" placeholder="Account Name" type="text" value="<?php echo $row_name;?>">
				  </div>
				</div>
			  </div>

			  <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for="username">Email Address:</label>

				  <div class="col-md-8">
					<input name="deptid" type="hidden" value="">
					 <input class="form-control input-sm" id="username" name="username" placeholder="Email Address" type="text" value="<?php echo $row_user;?>">
				  </div>
				</div>
			  </div>

			  <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for="pass">Password:</label>

				  <div class="col-md-8">
					<input name="deptid" type="hidden" value="">
					 <input class="form-control input-sm" id="pass" name="pass" placeholder="Account Password" type="text" value="<?php echo $row_pass;?>">
				  </div>
				</div>
			  </div>
			  
			  <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for="type">Type:</label>
				  <div class="col-md-8">
				   <select class="form-control input-sm" name="type" id="type">
						<option value="Administrator">Administrator</option>
						<option value="Registrar">Registrar</option>
						<option value="Encoder">Encoder</option>
						<option value="Student">Student</option>
					</select>	
				  </div>
				</div>
			  </div>
			
			 <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for="idno"></label>
				  <div class="col-md-8">
					<button class="btn btn-primary" name="save" type="submit">Save</button>
				  </div>
				</div>
			  </div>

				
		</fieldset>	

	<div class="form-group">
		<div class="rows">
		  <div class="col-md-6">
			<label class="col-md-6 control-label" for="otherperson"></label>
			<div class="col-md-6">		             
			</div>
		  </div>
		  <div class="col-md-6" align="right">
		   </div>
	  </div>
	  </div>
		
	</form>


	</div><!--End of container-->
			

<?php include("footer.php") ?>



