<?php
	require_once("includes/initialize.php");
	include 'header.php';

	include("menu.php");
?>

<script>setActive("enroll");</script>

<style type="text/css">
body { 
background-image: url(); 
background-repeat: no-repeat; 
height: 100%; 
width: 100%; 
background-position: bottom; 
} 
.top {
    border-top:thin solid;
    border-color:black;
}

.bottom {
    border-bottom:thin solid;
    border-color:black;
}

.left {
    border-left:thin solid;
    border-color:black;
}

.right {
    border-right:thin solid;
    border-color:black;
}
.header-row { position:fixed; top:0; left:0; }
.table {padding-top:5px; }
</style>

<script>setActive("enroll");</script>

<div class="container" style="margin-top: 20px;">
	<?php
		if (isset($_POST['search'])){
			if ($_POST['txtsearch']==""){
				message("Student ID Number is required!","error");
				check_message();
			} else {
				$Schoolyr = new Schoolyr();
				$NumberofResult = $Schoolyr->findsy($_POST['txtsearch']);
				if ($NumberofResult == 0){
					message("This student needs to go back to step 1!","error");
					check_message();
				} else {
					$sy = $Schoolyr->single_sy($_POST['txtsearch']);
					$course = new Course();
					$studcourse = $course->single_course($sy->COURSE_ID);
				}
				$student = new Student();
				$cur = $student->single_student($_POST['txtsearch']);
			}
		}
	?>

	<!-- Search Student Card -->
	<div class="enroll-card mb-4" style="padding: 20px 24px;">
		<form action="Student_advicesubject.php" method="POST">
			<div class="row align-items-center">
				<div class="col-md-7 col-sm-12 mb-2 mb-md-0">
					<h4 class="font-weight-bold" style="margin:0;"><i class="fas fa-clipboard-check text-primary"></i> Subject Advising & Unit Assessment</h4>
					<small class="text-muted">Enter Student ID Number to pull academic history & advise subjects</small>
				</div>
				<div class="col-md-5 col-sm-12">
					<div class="input-group">
						<input type="text" name="txtsearch" class="form-control" placeholder="Enter Student ID (e.g. 0001)" value="<?php echo $_POST['txtsearch'] ?? ''; ?>" required>
						<span class="input-group-btn">
							<button type="submit" name="search" class="btn btn-primary"><i class="fas fa-search"></i> Search ID</button>
						</span>
					</div>
				</div>
			</div>
		</form>
	</div>

	<?php if (isset($cur)): ?>
		<!-- Student Profile Overview Card -->
		<div class="enroll-card mb-4">
			<div class="enroll-card-header">
				<h4 class="enroll-card-title"><i class="fas fa-id-card text-primary"></i> Student Information</h4>
				<span class="badge-status badge-status-active"><i class="fas fa-check-circle"></i> <?php echo (isset($sy)) ? $sy->STATUS : 'ACTIVE' ;?></span>
			</div>
			
			<div class="row">
				<div class="col-md-2 col-sm-4 mb-3">
					<small class="text-muted d-block uppercase font-weight-bold" style="font-size:11px;">Student ID</small>
					<span class="font-weight-bold text-primary" style="font-size:16px;"><?php echo $cur->IDNO; ?></span>
				</div>
				<div class="col-md-3 col-sm-8 mb-3">
					<small class="text-muted d-block uppercase font-weight-bold" style="font-size:11px;">Full Name</small>
					<span class="font-weight-bold" style="font-size:16px;"><?php echo $cur->LNAME.', '.$cur->FNAME.' '.$cur->MNAME; ?></span>
				</div>
				<div class="col-md-2 col-sm-4 mb-3">
					<small class="text-muted d-block uppercase font-weight-bold" style="font-size:11px;">Academic Year</small>
					<span class="font-weight-bold"><?php echo (isset($sy)) ? $sy->AY : 'N/A' ;?></span>
				</div>
				<div class="col-md-2 col-sm-4 mb-3">
					<small class="text-muted d-block uppercase font-weight-bold" style="font-size:11px;">Semester</small>
					<span class="font-weight-bold"><?php echo (isset($sy)) ? $sy->SEMESTER : 'N/A' ;?></span>
				</div>
				<div class="col-md-3 col-sm-12 mb-3">
					<small class="text-muted d-block uppercase font-weight-bold" style="font-size:11px;">Course & Major</small>
					<span class="font-weight-bold"><?php echo (isset($studcourse)) ? $studcourse->COURSE_NAME .' - '.$studcourse->COURSE_LEVEL.' '.$studcourse->COURSE_MAJOR : 'N/A' ;?></span>
				</div>
			</div>
		</div>

		<!-- Advised Subjects Table Card -->
		<div class="enroll-card" style="padding: 0; overflow: hidden;">
			<div class="enroll-card-header" style="padding: 18px 24px; margin-bottom: 0;">
				<h4 class="enroll-card-title"><i class="fas fa-book-open text-primary"></i> Advised Subjects Catalog</h4>
				<?php if (isset($_POST['txtsearch'])): ?>
					<a href="preview_adviceslip.php?txtsearch=<?php echo $_POST['txtsearch']; ?>" target="_blank" class="btn btn-outline-primary"><i class="fas fa-print"></i> Preview & Print Advice Slip</a>
				<?php endif; ?>
			</div>

			<div class="table-responsive">
				<table class="table enroll-table enroll-table-responsive">
					<thead>
						<tr>
							<th>Subject Code</th>
							<th>Description</th>
							<th>Semester</th>
							<th>Course</th>
							<th>Level</th>
							<th>Pre-requisite</th>
							<th class="text-center">Units</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$cid = (isset($studcourse)) ? $studcourse->COURSE_ID : 0;
							$mydb->setQuery("SELECT * 
											FROM  `subject` s,  `course` c
											WHERE s.`COURSE_ID` = c.`COURSE_ID`
											AND s.`COURSE_ID` =".$cid . " AND SEMESTER='First'");
							$curRes = $mydb->loadResultlist();
							foreach ($curRes as $result) {
								echo '<tr>';
								echo '<td data-label="Subject Code" class="font-weight-bold text-primary">'.$result->SUBJ_CODE.'</td>';
								echo '<td data-label="Description">'.$result->SUBJ_DESCRIPTION.'</td>';
								echo '<td data-label="Semester">'.$result->SEMESTER.'</td>';
								echo '<td data-label="Course">'.$result->COURSE_NAME.'</td>';
								echo '<td data-label="Level">'.$result->COURSE_LEVEL.'</td>';
								echo '<td data-label="Pre-requisite">'.($result->PRE_REQUISITE ?: 'None').'</td>';
								echo '<td data-label="Units" class="text-center font-weight-bold"><span class="badge-status badge-status-info" style="padding:5px 12px; border-radius:20px;">'.$result->UNIT.'</span></td>';
								echo '</tr>';
							}
						?>
					</tbody>
					<tfoot>
						<?php
							$cid = (isset($studcourse)) ? $studcourse->COURSE_ID : 0;
							$mydb->setQuery("SELECT SUM(UNIT) as UN
											FROM  `subject` s,  `course` c
											WHERE s.`COURSE_ID` = c.`COURSE_ID`
											AND s.`COURSE_ID` =".$cid . " AND SEMESTER='First'");
							$totalRes = $mydb->loadSingleResult();
						?>
						<tr class="even">
							<td colspan="6" class="text-right font-weight-bold" style="font-size:15px;">Total Assessed Units:</td>
							<td class="text-center font-weight-bold text-primary" style="font-size:16px;"><?php echo $totalRes->UN ?? 0; ?> Units</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php include("footer.php") ?>



