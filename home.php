<?php
	require_once("includes/initialize.php");
	include("header.php");

	if($_SESSION['ACCOUNT_TYPE']=="Student"){
		include("menu.php");
	} 
	
	else if($_SESSION['ACCOUNT_TYPE']=="Encoder"){
		include("menu.php");
	}
	
	else if($_SESSION['ACCOUNT_TYPE']=="Registrar"){
		include("menu.php");
	} 
	
	else {
		include("menu.php");
	}
  
		include("banner.php");  
	//
?>

<script>setActive("home");</script>

<div class="container" style="margin-top: 20px;">
	<!-- Dashboard Hero Banner -->
	<div class="enroll-hero">
		<div class="row align-items-center">
			<div class="col-md-8">
				<span class="badge badge-pill badge-light text-primary font-weight-bold mb-2 px-3 py-1" style="background: rgba(255,255,255,0.2); color:#fff; border-radius:20px;">
					<i class="fas fa-university"></i> WEST PRIME HYBRID
				</span>
				<h2 style="font-weight:800; font-size:28px; margin-top:8px;">Welcome back, <?php echo htmlspecialchars($_SESSION['ACCOUNT_NAME'] ?? 'User'); ?>!</h2>
				<p class="enroll-hero-subtitle">
					Access your student portal, manage subject advising, inspect rosters, and review enrollment records seamlessly.
				</p>
			</div>
			<div class="col-md-4 text-right hidden-xs hidden-sm">
				<div style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 16px; padding: 18px 22px; display: inline-block; text-align: left;">
					<small style="opacity: 0.8; text-transform: uppercase; letter-spacing: 0.5px; font-weight:700;">Account Profile</small>
					<h5 style="margin: 4px 0 0 0; font-weight:700; color:#fff;"><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['ACCOUNT_NAME'] ?? ''); ?></h5>
					<span class="badge badge-light text-dark mt-2" style="font-size:11px; font-weight:700;"><i class="fas fa-shield-alt"></i> <?php echo htmlspecialchars($_SESSION['ACCOUNT_TYPE'] ?? 'Member'); ?></span>
				</div>
			</div>
		</div>
	</div>

	<!-- Main Grid: Quick Tiles + User Status Panel -->
	<div class="row">
		<div class="col-md-8">
			<div class="enroll-card">
				<div class="enroll-card-header">
					<h4 class="enroll-card-title"><i class="fas fa-rocket text-primary"></i> Quick Management Modules</h4>
				</div>
				<div class="row">
					<div class="col-sm-6 mb-3">
						<a href="Student_advicesubject.php" class="quick-tile">
							<div class="quick-tile-icon"><i class="fas fa-clipboard-list"></i></div>
							<div>
								<h5 class="quick-tile-title">Subject Advising</h5>
								<p class="quick-tile-desc">Select and advise student subjects</p>
							</div>
						</a>
					</div>
					<div class="col-sm-6 mb-3">
						<a href="newenrollment.php" class="quick-tile">
							<div class="quick-tile-icon"><i class="fas fa-calendar-check"></i></div>
							<div>
								<h5 class="quick-tile-title">New Enrollment</h5>
								<p class="quick-tile-desc">Process student reservations & registrations</p>
							</div>
						</a>
					</div>
					<div class="col-sm-6 mb-3">
						<a href="studentList.php" class="quick-tile">
							<div class="quick-tile-icon"><i class="fas fa-user-graduate"></i></div>
							<div>
								<h5 class="quick-tile-title">Student Directory</h5>
								<p class="quick-tile-desc">Browse, search & filter student records</p>
							</div>
						</a>
					</div>
					<div class="col-sm-6 mb-3">
						<a href="listofclass.php" class="quick-tile">
							<div class="quick-tile-icon"><i class="fas fa-chalkboard"></i></div>
							<div>
								<h5 class="quick-tile-title">Class Rosters</h5>
								<p class="quick-tile-desc">Inspect class schedules & subject loads</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Right Column Sidebar Info Card -->
		<div class="col-md-4">
			<div class="enroll-card sidebar-user-card text-center">
				<div style="width: 72px; height: 72px; border-radius: 50%; background: var(--accent-light); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 16px;">
					<i class="fas fa-user-shield"></i>
				</div>
				<h4 class="font-weight-bold" style="margin: 0;"><?php echo htmlspecialchars($_SESSION['ACCOUNT_NAME'] ?? ''); ?></h4>
				<p class="text-muted small mb-3"><?php echo htmlspecialchars($_SESSION['ACCOUNT_USERNAME'] ?? ''); ?></p>
				
				<div class="user-info-box mb-3">
					<div class="d-flex justify-content-between mb-2">
						<span class="text-muted small">Account Role:</span>
						<span class="font-weight-bold text-primary small"><?php echo htmlspecialchars($_SESSION['ACCOUNT_TYPE'] ?? 'Member'); ?></span>
					</div>
					<div class="d-flex justify-content-between">
						<span class="text-muted small">Session Status:</span>
						<span class="badge-status badge-status-active small"><i class="fas fa-circle" style="font-size:7px;"></i> Active</span>
					</div>
				</div>

				<a href="logout.php" class="btn btn-outline-danger btn-block"><i class="fas fa-sign-out-alt"></i> End Session</a>
			</div>
		</div>
	</div>

	<!-- Full Width Mission & Vision Section -->
	<div class="row">
		<div class="col-md-12">
			<div class="enroll-card">
				<?php include("mission.php"); ?>
			</div>
		</div>
	</div>
</div>

<?php include("footer.php") ?>
