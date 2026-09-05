<div id="menu" class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="home.php">West Prime Enrollment System</a>
        </div>
        <div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a id="home" href="home.php"><b>HOME</b></a></li>
			
				<?php
					$qry=$conn->query("SELECT * FROM tblstudent WHERE EMAIL='".$_SESSION['ACCOUNT_USERNAME']."'");
					$rs=$qry->fetch_assoc();
					$user=$rs["EMAIL"];

					if($_SESSION['ACCOUNT_USERNAME']!==$user){
						echo"<li><a id='enroll' href='studentNew.php'><b>ENROLLMENT</b></a></li>";
						echo"<li><a id='account' href='userAccount.php'><b>ACCOUNT</b></a></li>";
					}else{
						echo"<li><a id='account' href='userAccount.php'><b>ACCOUNT</b></a></li>";
						echo"<li><a id='info' href='studentView.php'><b>ENROLLMENT</b></a></li>";
					}
				?>
			
				<li><a href="logout.php"><b>LOGOUT</b></a></li>
			</ul>
        </div><!-- /.nav-collapse -->
	</div><!-- /.container -->
</div><!-- /.navbar -->
