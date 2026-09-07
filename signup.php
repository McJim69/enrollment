<?php
	require_once("includes/initialize.php");
	include 'header2.php';
	include("menu.php");
?>

<script>setActive("signup");</script>

<div class="container">

<?php

if (isset($_POST['save'])){

	if ($_POST['name'] == "" OR $_POST['username'] == "" OR $_POST['pass'] == "") {
		$messageStats = false;
		message("All field is required!","error");
		check_message();
	}else{

		$user = new User();
		$acc_name		= $_POST['name'];
		$acc_username   = $_POST['username'];
		$acc_password 	= $_POST['pass'];
		$acc_type 		= $_POST['type'];

		$res = $user->find_all_user($acc_name);
		
		if ($res >=1) {
			message("Account name already exist!", "error");
			check_message();
		}else{
			
			$user->ACCOUNT_NAME = $acc_name;
			$user->ACCOUNT_USERNAME = $acc_username;
			$user->ACCOUNT_PASSWORD = $acc_password;
			$user->ACCOUNT_TYPE = $acc_type;
			
			 $istrue = $user->create(); 
			 if ($istrue == 1){
				echo"<script>alert('CONGRATULATIONS! Your account created successfuly!');
					window.location.href = 'login.php';</script>";					 	
			 }
		}	 
	}
}
?>			
<div class="auth-container" style="max-width: 540px;">
	<div class="auth-header">
		<img src="img/logo.png" class="auth-logo" alt="WPH Logo">
		<h3 class="font-weight-bold brand-title" style="letter-spacing: -0.02em; margin-top: 10px; margin-bottom: 8px;">Register Account</h3>
		<p class="text-muted" style="font-size: 14px; margin-bottom: 0;">Join West Prime Hybrid Online Enrollment System</p>
	</div>

	<div class="enroll-card" style="box-shadow: var(--shadow-lg); padding: 40px 36px;">
		<form action="signup.php" method="POST">
			<div class="enroll-form-group">
				<label for="name"><i class="fas fa-user text-primary"></i> Full Name</label>
				<input class="form-control" id="name" name="name" placeholder="John Doe" type="text" required>
			</div>

			<div class="enroll-form-group">
				<label for="username"><i class="fas fa-envelope text-primary"></i> Email Address</label>
				<input class="form-control" id="username" name="username" placeholder="john.doe@example.com" type="email" required>
			</div>

			<div class="enroll-form-group">
				<label for="pass"><i class="fas fa-lock text-primary"></i> Password</label>
				<input class="form-control" id="pass" name="pass" placeholder="Account Password" type="password" required>
			</div>

			<div class="enroll-form-group">
				<label for="type"><i class="fas fa-user-tag text-primary"></i> Account Type</label>
				<select class="form-control" name="type" id="type">
					<option value="Student">Student Account</option>
				</select>
			</div>

			<div style="margin-top: 32px; margin-bottom: 12px;">
				<button class="btn btn-primary btn-block" name="save" type="submit" style="font-size: 15.5px !important;">
					<i class="fas fa-user-check mr-1"></i> Register Account
				</button>
			</div>

			<div class="text-center form-divider">
				<span class="text-muted small">Already have an account?</span>
				<a href="login.php" class="font-weight-bold text-primary ml-1" style="font-size: 13.5px;">Sign In Here</a>
			</div>
		</form>
	</div>
</div>

<?php include("footer.php") ?>



