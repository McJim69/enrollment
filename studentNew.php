<?php
	require_once("includes/initialize.php");
	include 'header.php';  
	include("menu.php");

    function fill_type($pdo){
	$output= '';
	$select = $pdo->prepare("SELECT * FROM stype ORDER BY STYPE");
	$select->execute();
	$result = $select->fetchAll();
	foreach($result as $row){
	$output.='<option value="'.$row['STYPE'].'">'.$row["STYPE"].'</option>';
	}
	return $output;
	}

    function fill_course($pdo){
	$output= '';
	$select = $pdo->prepare("SELECT * FROM course ORDER BY COURSE_ID");
	$select->execute();
	$result = $select->fetchAll();
	foreach($result as $row){
	if($row['COURSE_MAJOR']=='None'){$major='';}else{$major='Major: '.$row['COURSE_MAJOR'].'';}
	$output.='<option value="'.$row['COURSE_ID'].'">'.$row["COURSE_NAME"].' '.$row["COURSE_LEVEL"].' '.$major.'</option>';
	}
	return $output;
	}
	
    function fill_semester($pdo){
	$output= '';
	$select = $pdo->prepare("SELECT * FROM semester ORDER BY SEMESTER");
	$select->execute();
	$result = $select->fetchAll();
	foreach($result as $row){
	$output.='<option value="'.$row['SEMESTER'].'">'.$row["SEMESTER"].'</option>';
	}
	return $output;
	}

    function fill_level($pdo){
	$output= '';
	$select = $pdo->prepare("SELECT * FROM year_level ORDER BY YID");
	$select->execute();
	$result = $select->fetchAll();
	foreach($result as $row){
	$output.='<option value="'.$row['LEVEL'].'">'.$row["LNAME"].'</option>';
	}
	return $output;
	}

    function fill_syear($pdo){
	$output= '';
	$select = $pdo->prepare("SELECT * FROM sy ORDER BY SY");
	$select->execute();
	$result = $select->fetchAll();
	foreach($result as $row){
	$output.='<option value="'.$row['SY'].'">'.$row["SY"].'</option>';
	}
	return $output;
	}
	
	$ses = $_SESSION['ACCOUNT_USERNAME'];
	
	$querys = $conn->query("SELECT MAX(S_ID) FROM tblstudent");
	$result = $querys->fetch_array();
	$studID = $result[0]+1;
?>

<script>setActive("enroll");</script>

<?php check_message(); ?>

<div class="container">
	<form class="form-horizontal well span9" action="student_p.php" method="POST">
	<!--Primary Details-->
		<fieldset><legend>COLLEGE ENROLLMENT FORM</legend></fieldset>				
			<div class="row" style="margin:-10px 0 0 0">
				<div class="col-md-2"><b>Student</b>
					<input class="form-control input-sm" type="hidden" value="<?php echo $studID;?>" name="sIDN">
					<select class="form-control input-sm" name="sType" required>
						<option value="">Student Type</option>
						<?php echo fill_type($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>Course</b>
					<select class="form-control input-sm" name="sCourse" required>
						<option value="">Course</option>
						<?php echo fill_course($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>Semester</b>
					<select class="form-control input-sm" name="sSemes" required>
						<option value="">Semester</option>
						<?php echo fill_semester($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>Level</b>
					<input class="form-control input-sm" name="sLevel" placeholder="Not Required" readonly style="background:#fff">
				</div>
				<div class="col-md-2"><b>School Year</b>
					<select class="form-control input-sm" name="sYear" required>
						<option value="">School Year</option>
						<?php echo fill_syear($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>Class Block</b>
					<input class="form-control input-sm" name="block" vaue="" placeholder="To be filled by Registrar" readonly style="background:#fff">
				</div>
			</div><br>
		</fieldset>	
		<fieldset><legend>Personal Information</legend>	
			<div class="form-group" style="margin-top:-10px">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">LastName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="lName" type="text" placeholder="Last Name" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Firstname</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fName" type="text" placeholder="First Name" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Middlename</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mName" type="text" placeholder="Middle Name">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Civil Status </label>
						<div class="col-md-8">
							<select class="form-control input-sm" name="cStatus" required>
								<option value="">Civil Status</option>
								<option value="Single">Single</option>
								<option value="Married">Married</option>
								<option value="Widower">Widower</option>
								<option value="Separated">Separated</option>
							</select>	
						</div>
					</div>

					<div class="col-md-4"><label class="col-md-4 control-label">Birth Date</label>
						<div class="col-md-8">
							<input class="form-control" onfocus="(this.type='date')" name="bDay" placeholder="Date of Birth" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Birth place</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="bPlace" type="text" placeholder="Birth Place" required>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label class="col-md-4 control-label">Ethnicity</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="sEthnic" type="text" placeholder="Ethnicity" required>
					</div>
				</div>			  
				<div class="col-md-4"><label class="col-md-4 control-label">Email</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="sEmail" placeholder="Email address" value="<?php echo $ses;?>" readonly style="background:#fff">
					</div>
				</div>
				<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="sContact" type="text" placeholder="Contact Number" required>
					</div>
				</div>			  
			</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Gender </label>
						<div class="col-md-8">
							<select class="form-control input-sm" name="sGender" required>
								<option value="">Sex</option>
								<option value="M">Male</option>
								<option value="F">Female</option>	
							</select>	
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Height</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="sHeight" type="text" placeholder="Height" required>
						</div>
					</div>			  					
					<div class="col-md-4"><label class="col-md-4 control-label">Weight</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="sWeight" type="text" placeholder="Weight" required>
						</div>
					</div>			  					
				</div>
			</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-6"><label class="col-md-2 control-label">Residencial</label>
						<div class="col-md-10">
							<input class="form-control input-sm" name="rAddress" type="text" placeholder="Residential Address" required>
						</div>
					</div>			  					
					<div class="col-md-6"><label class="col-md-2 control-label">Permanent</label>
						<div class="col-md-10">
							<input class="form-control input-sm" name="pAddress" type="text" placeholder="Permanent Address" required>
						</div>
					</div>			  					
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label class="col-md-4 control-label">Elementary</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="elSchool" type="text" placeholder="Name of School"  required>
						<input class="form-control input-sm" name="elGradtd" type="text" placeholder="Year Graduated"  required>
						<input class="form-control input-sm" name="elHonors" type="text" placeholder="Honors Received" required>
					</div>
				</div>			  		  
				<div class="col-md-4"><label class="col-md-4 control-label" for="ethnicity">Junior High</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="jrSchool" type="text" placeholder="Name of School"  required>
						<input class="form-control input-sm" name="jrGradtd" type="text" placeholder="Year Graduated"  required>
						<input class="form-control input-sm" name="jrHonors" type="text" placeholder="Honors Received" required>
					</div>
				</div>			  		  
				<div class="col-md-4"><label class="col-md-4 control-label" for="ethnicity">Senior High</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="srSchool" type="text" placeholder="Name of School"  required>
						<input class="form-control input-sm" name="srGradtd" type="text" placeholder="Year Graduated"  required>
						<input class="form-control input-sm" name="srHonors" type="text" placeholder="Honors Received" required>
					</div>
				</div>			  		  

			</div>
		</fieldset>
	<!--Secondary Details-->
		<fieldset><legend>Secondary Details</legend>
			<div style="margin-top:-10px;margin-bottom:5px"> &nbsp; &nbsp; <b>FATHER'S PROFILE</b></div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">LastName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="flName" type="text" placeholder="Father's Last Name" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">FirstName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="ffName" type="text" placeholder="Father's First Name" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">MiddleName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fmName" type="text" placeholder="Father's Middle Name" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Occupation</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fOccup" type="text" placeholder="Father's Occupation" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Employer</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fEmploym" type="text" placeholder="Employer or Business Nme" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Address</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fAddress" type="text" placeholder="Father's Business Address" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Salary</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fmSalary" type="text" placeholder="Father's Monthly Salary" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fContact" type="text" placeholder="Father's Contact Number" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Other</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fOtherIn" type="text" placeholder="Father's Other Source of Income" required>
						</div>
					</div>
				</div>
			</div>
			<div style="margin-bottom:5px;margin-top:20px"> &nbsp; &nbsp; <b>MOTHER'S PROFILE</b></div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">LastName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mlName" type="text" placeholder="Mother's Last Name" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">FirstName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mfName" type="text" placeholder="Mother's First Name" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">MiddleName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mmName" type="text" placeholder="Mother's Middle Name" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Occupation</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mOccup" type="text" placeholder="Mother's Occupation" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Employer</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mEmploym" type="text" placeholder="Employer or Business Name" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Address</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mAddress" type="text" placeholder="Mother's Business Address" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Salary</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mmSalary" type="text" placeholder="Mother's Monthly Salary" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mContact" type="text" placeholder="Mother's Contact Number" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Other</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mOtherIn" type="text" placeholder="Mother's Other Source of Income" required>
						</div>
					</div>
				</div>
			</div>			
			<div style="margin-bottom:5px;margin-top:20px"> &nbsp; &nbsp; <b>GUARDIAN'S PROFILE</b> (Optional: Fill this Form if Applicable)</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">LastName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="glName" type="text" placeholder="Guardian's Last Name">
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">FirstName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gfName" type="text" placeholder="Guardian's First Name">
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">MiddleName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gmName" type="text" placeholder="Guardian's Middle Name">
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Occupation</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gOccup" type="text" placeholder="Guardian's Occupation">
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Employer</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gEmploym" type="text" placeholder="Employer or Business Name">
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Address</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gAddress" type="text" placeholder="Guardian's Business Address">
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Salary</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gmSalary" type="text" placeholder="Guardian's Monthly Salary">
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gContact" type="text" placeholder="Guardian's Contact Number">
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Relationship</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gRelated" type="text" placeholder="Relationship to the Student">
						</div>
					</div>
				</div>
			</div>
		</fieldset>	
	<!--Requirements-->	
		<fieldset><legend>Requirements</legend>
			<div class="form-group" style="margin-top:-20px">
				<div class="rows">
					<ul>
						<li>2"x2" ID Picture</li>
						<li>Certificate of Indigency</li>
						<li>Indorsement Letter from the  Governor</li>
					</ul>
				</div>
			</div>
		</fieldset>
	<!--Submit Button-->
		<fieldset>		
			<div class="form-group" style="text-align:center;margin-bottom:0">
				<div class="rows">
					<div class="col" align="center">
						<button class="btn btn-primary" name="submit" type="submit" >
							<span class="glyphicon glyphicon-floppy-save"></span> Submit
						</button>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div><br><br>

<?php include("footer.php") ?>
