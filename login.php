<?php 
	require_once("includes/initialize.php");
	include("menu2.php");
	include("header2.php");
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
			
			$msg="<small style='color:red'>SORRY! Your access validity was expired on <b>".$row['validity']."</b>. Please contact your System Administrator.</small></br>";

		}else
			$msg="<small style='color:red'>ACCESS DENIED! Either email address or password is invalid.</small>";
			$err=1;
			{
		}
	}
?>

<center>
	<div>
		<img class="media-object" src="img/logo.png" width="120px"  style="filter: drop-shadow(5px 5px 5px #bbb);">
	</div>
	<div class="text-primary"><h3 style="text-shadow: 0 3px 10px rgb(0 0 0 / 0.1)"><strong>ENROLLMENT SYSTEM</strong></h3></div>

<!-- Login Form -->
<div class="panel panel-primary" style="border-radius:5px;padding:0;width:320px;margin-top:20px;box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">					
	<div class="panel-heading" style="border:1px solid #3b71ca;box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);"><span class="glyphicon glyphicon-user"></span> &nbsp; User Login</div>
		<div class="panel-body" style="margin-bottom:-20px">	
			<form  method="POST" action="">
				<div class="col-xs-12 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<?php echo $msg; ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-xs-12 col-sm-12">
								<input type="email" placeholder="Email" class="form-control" name="uname" value="admin@westprime.com" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<input type="password" placeholder="Password" class="form-control" name="pass" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<input type="submit" class="form-control btn btn-primary" name="btnlogin" value="Sign In" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2)">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<div>Not Registered? &nbsp; <a href="signup.php">Signup for Westprime</a></div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	<!--End Login Form-->
<?php include("footer.php") ?>
