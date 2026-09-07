<?php
	require_once("includes/initialize.php");
	include 'header.php';

	include("menu.php");
?>

<script>setActive("entry");</script>

<?php
	if (isset($_POST['savecourse'])){

		if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['unit'] == "") {
			message("All field is required!","error");
			check_message();
		}else{
		

		$subj = new Subject();
		$subjcode   	= $_POST['subjcode'];
		$subjdesc	 	= $_POST['subjdesc'];
		$unit 			= $_POST['unit'];
		$pre 			= $_POST['pre'];
		$course 		= $_POST['course'];
		$ay 			= $_POST['ay'];
		$Semester 		= $_POST['Semester'];
	
		$subj->SUBJ_CODE		 = $subjcode;
		$subj->SUBJ_DESCRIPTION  = $subjdesc;
		$subj->UNIT 			 = $unit;
		$subj->PRE_REQUISITE 	 = $pre;
		$subj->COURSE_ID 		 = $course;
		$subj->AY 				 = $ay;
		$subj->SEMESTER 		 = $Semester;

		$istrue = $subj->create(); 
			if ($istrue == 1){	
				message("New Subject created successfully!","success");
				redirect('subjectList.php');
			}
		}		 	
	}elseif (isset($_POST['saveandnewcourse'])) {
		if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['unit'] == "") {
			message("All field is required!","error");
			check_message();
		}else{
		

		$subj = new Subject();
		$subjcode   	= $_POST['subjcode'];
		$subjdesc	 	= $_POST['subjdesc'];
		$unit 			= $_POST['unit'];
		$pre 			= $_POST['pre'];
		$course 		= $_POST['course'];
		$ay 			= $_POST['ay'];
		$Semester 		= $_POST['Semester'];
	
			$subj->SUBJ_CODE		 = $subjcode;
			$subj->SUBJ_DESCRIPTION  = $subjdesc;
			$subj->UNIT 			 = $unit;
			$subj->PRE_REQUISITE 	 = $pre;
			$subj->COURSE_ID 		 = $course;
			$subj->AY 				 = $ay;
			$subj->SEMESTER 		 = $Semester;

			$istrue = $subj->create(); 
			if ($istrue == 1){
				message("New Subject created successfully!","success");
			}
		}
	}
?>		

<div class="container">
	<form class="form-horizontal well span4" action="#.php" method="POST">
		<fieldset><legend>New Subject</legend>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="subjcode">Subject Code</label>
					<div class="col-md-8">
						<input class="form-control input-sm" id="subjcode" name="subjcode" placeholder="Subject Code" type="text" value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="subjdesc">Subject Description</label>
					<div class="col-md-8">
						<input class="form-control input-sm" id="subjdesc" name="subjdesc" placeholder="Subject Description" type="text" value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="unit">No of Units</label>
					<div class="col-md-8">
						<input class="form-control input-sm" id="unit" name="unit" placeholder="No of Units" type="number" value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="pre">Prerequisite</label>
					<div class="col-md-8">
						<input class="form-control input-sm" id="pre" name="pre" placeholder="Prerequisite" type="text" value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="course">Course</label>
					<div class="col-md-8">
						<select class="form-control input-sm" name="course" id="course">
							<option value="">Select Course</option>
							<?php
								$course = new Course();
								$cur = $course->listOfcourse();	
								foreach ($cur as $course) {
									echo '<option value="'. $course->COURSE_ID.'">'.$course->COURSE_NAME.' '.$course->COURSE_LEVEL .'- Major : '.$course->COURSE_MAJOR .'</option>';
								}
							?>
						</select>	
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="ay">Academic Year</label>
					<div class="col-md-8">
						<select class="form-control input-sm" name="ay" id="ay">
							<option value="">School Year</option>
							<option value="2024-2025">2024-2025</option>
							<option value="2025-2026">2025-2026</option>
							<option value="2026-2027">2026-2027</option>
							<option value="2027-2028">2027-2028</option>
							<option value="2028-2029">2028-2029</option>
							<option value="2029-2030">2029-2030</option>
						</select>	
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="Semester">Semester</label>
					<div class="col-md-8">
						<select class="form-control input-sm" name="Semester" id="Semester">
							<option value="">Semester</option>
							<option value="First">First</option>
							<option value="Second">Second</option>
							<option value="Summer">Summer</option>
						</select>
					</div>
				</div>
			</div>		
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="idno"></label>
					<div class="col-md-8">
						<button class="btn btn-default" name="savecourse" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
						<button class="btn btn-default" name="saveandnewcourse" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save and Add New</button>
					</div>
				</div>
			</div>		
		</fieldset>				
	</form>
</div>

<?php include("footer.php") ?>



