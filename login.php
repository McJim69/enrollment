<?php 
	require_once("includes/initialize.php");
	include("header2.php");
	include("menu.php");
?>

<script>setActive("home");</script>

<?php 
	$msg="";
	
	if (isset($_POST['btnlogin'])) {
		
		$ex=$conn->query("SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='".$_POST["uname"]."' and ACCOUNT_PASSWORD='".$_POST["pass"]."'");
				
		if($rs=$ex->fetch_assoc()){			
		
			$exx=$conn->query("select * from validity where validity>'".date("Y-m-d")."'");
			
			if($rs1=$exx->fetch_assoc()){

				$_SESSION['ACCOUNT_ID']=$rs['ACCOUNT_ID'];
				$_SESSION['ACCOUNT_NAME']=$rs['ACCOUNT_NAME'];
				$_SESSION['ACCOUNT_USERNAME']=$rs['ACCOUNT_USERNAME'];
				$_SESSION['ACCOUNT_TYPE']=$rs['ACCOUNT_TYPE'];
				
			redirect('home.php');

		}else
			$val=$conn->query("select * from validity");
			$row=$val->fetch_assoc();
			
			$msg="<small class='text-danger'>SORRY! Your access validity was expired on <b>".$row['validity']."</b>. Please contact your System Administrator.</small></br>";

		}else
			$msg="<small class='text-danger'>ACCESS DENIED! Either email address or password is invalid.</small>";
			$err=1;
			{
		}
	}
?>

<div class="auth-container">
	<div class="auth-header">
		<img src="img/logo.png" class="auth-logo" alt="WPH Logo">
		<h3 class="font-weight-bold brand-title" style="letter-spacing: -0.02em; margin-top: 10px; margin-bottom: 8px;">WEST PRIME HYBRID</h3>
		<p class="text-muted" style="font-size: 14px; margin-bottom: 0;">Online Enrollment & Portal System</p>
	</div>

	<!-- Login Form Card -->
	<div class="enroll-card" style="box-shadow: var(--shadow-lg)">
		<div class="text-center">
			<h4 class="font-weight-bold card-login-title auth-card-title"><i class="fas fa-lock text-primary mr-1"></i> Sign In to Account</h4>
			<small class="text-muted auth-card-subtitle">Enter your account credentials to continue</small>
		</div>

		<?php if (!empty($msg)): ?>
			<div class="alert alert-danger text-center small" style="border-radius: 10px; padding: 14px; margin-bottom: 24px; line-height: 1.5;">
				<?php echo $msg; ?>
			</div>
		<?php endif; ?>

		<form method="POST" action="">
			<div class="enroll-form-group">
				<label for="uname"><i class="fas fa-envelope text-primary"></i> Email Address</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fas fa-at"></i></span>
					<input type="email" id="uname" placeholder="name@westprime.com" class="form-control" name="uname" value="admin@westprime.com" required>
				</div>
			</div>

			<div class="enroll-form-group">
				<label for="pass"><i class="fas fa-key text-primary"></i> Password</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fas fa-lock"></i></span>
					<input type="password" id="pass" placeholder="••••••••" class="form-control" name="pass" required>
				</div>
			</div>

			<div>
				<button type="submit" class="btn btn-primary btn-block" name="btnlogin" style="font-size: 15.5px !important;">
					<i class="fas fa-sign-in-alt mr-1"></i> Sign In
				</button>
			</div><br>

			<div class="text-center">
				<span class="text-muted small">Not registered yet?</span>
				<a href="signup.php" class="font-weight-bold text-primary ml-1" style="font-size: 13.5px;">Create Student Account</a>
			</div>
		</form>
	</div>
</div>

<?php include("footer.php") ?>
