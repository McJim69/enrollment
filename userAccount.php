<?php
	require_once("includes/initialize.php");
	include 'header.php';
	include("menu.php");

	$ses = $_SESSION['ACCOUNT_USERNAME'];

	$mydb->setQuery("SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='$ses'");

	$cur = $mydb->loadResultList();
	
	foreach ($cur as $result) {
		$row_usid = $result->ACCOUNT_ID;
		$row_name = $result->ACCOUNT_NAME;
		$row_user = $result->ACCOUNT_USERNAME;
		$row_pass = $result->ACCOUNT_PASSWORD;
		$row_type = $result->ACCOUNT_TYPE;
	} 

	if (isset($_POST['save'])){

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
		header('location:home.php');
	}
?>

<script>setActive("account");</script>

<div class="container">
	<form class="form-horizontal well span4" action="userAccount.php?id=<?php echo $userID;?>" method="POST">
		<fieldset><legend>Edit User Account: <?php echo $row_user;?></legend>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="name">Name:</label>
					<div class="col-md-8">
						<input class="form-control" id="name" name="name" placeholder="Account Name" type="text" value="<?php echo $row_name;?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="username">Email Address:</label>
					<div class="col-md-8">
						<input class="form-control" id="username" name="username" placeholder="Email Address" type="text" value="<?php echo $row_user;?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="pass">Password:</label>
					<div class="col-md-8">
						<input class="form-control" id="pass" name="pass" placeholder="Account Password" type="text" value="<?php echo $row_pass;?>">
					</div>
				</div>
			</div>				  
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="type">Type:</label>
					<div class="col-md-8">
						<input class="form-control" name="type" id="type" value="<?php echo $row_type;?>">
					</div>
				</div>
			</div>		
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="idno"></label>
					<div class="col-md-8">
						<button class="btn btn-primary" name="save" type="submit">Save</button>
					</div>
				</div>
			</div>
		</fieldset>			
	</form>
</div>

<?php include("footer.php") ?>



