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
	
	$qrs = $conn->query("SELECT * FROM tblstudent s WHERE s.EMAIL='".$ses."'");
	$res = $qrs->fetch_array();
	$sID = $res[0];

	$qrd = $conn->query("SELECT * FROM tblstuddetails d WHERE d.STU_ID='".$sID."'");
	$red = $qrd->fetch_array();

	$esc=$conn->query("SELECT * FROM course WHERE COURSE_ID='".$res['COURSE']."'");
	$rsc=mysqli_fetch_array($esc);
	
	if($rsc["COURSE_LEVEL"]==1){ $level="First Year"; }
	if($rsc["COURSE_LEVEL"]==2){ $level="Second Year";}
	if($rsc["COURSE_LEVEL"]==3){ $level="Third Year"; }
	if($rsc["COURSE_LEVEL"]==4){ $level="Fouth Year"; }
?>

<script>setActive("enroll");</script>

<div class="container">
	<form class="form-horizontal well span9" action="studentEdit_proc.php?id=<?php echo $sID;?>" method="POST">
	<!--Primary Details-->
		<fieldset><legend>COLLEGE ENROLLMENT FORM  <?php echo $res['LNAME'];?>, <?php echo $res['FNAME'];?> <?php echo $res['MNAME'];?></legend></fieldset>				
			<div class="row" style="margin:-10px 0 0 0">
				<div class="col-md-2"><b>&nbsp;Student</b>
					<input class="form-control input-sm" type="hidden" value="<?php echo $sID;?>" name="sIDN">
					<select class="form-control input-sm" name="sType" required>
						<option value="<?php echo $res['S_TYPE'];?>"><?php echo $res['S_TYPE'];?></option>
						<?php echo fill_type($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>&nbsp;Course</b>
					<select class="form-control input-sm" name="sCourse" required>
						<option value="<?php echo $rsc['COURSE_ID'];?>"><?php echo"".$rsc['COURSE_NAME']." ".$rsc['COURSE_LEVEL']."-".$rsc['COURSE_MAJOR']."";?></option>
						<?php echo fill_course($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>&nbsp;Semester</b>
					<select class="form-control input-sm" name="sSemes" required>
						<option value="<?php echo $res['SEMESTER'];?>"><?php echo $res['SEMESTER'];?></option>
						<?php echo fill_semester($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>&nbsp;Year Level</b>
					<input class="form-control input-sm" name="sLevel" readonly style="background:#fff" value="<?php echo $level?>">
				</div>
				<div class="col-md-2"><b>School Year</b>
					<select class="form-control input-sm" name="sYear" required>
						<option value="<?php echo $res['SCHOOL_YEAR'];?>"><?php echo $res['SCHOOL_YEAR'];?></option>
						<?php echo fill_syear($pdo);?>
					</select>
				</div>
				<div class="col-md-2"><b>&nbsp;Class Block</b>
					<input type="text" class="form-control input-sm" name="block" placeholder="To be filled by Registrar" value="<?php echo $res['CLASS_BLOCK'];?>" readonly style="background:#fff">
				</div>
			</div><br>
		</fieldset>	
		<fieldset><legend>Personal Information</legend>	
			<div class="form-group" style="margin-top:-10px">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">LastName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="lName" type="text" placeholder="Last Name" value="<?php echo $res['LNAME'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Firstname</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fName" type="text" placeholder="First Name" value="<?php echo $res['FNAME'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Middlename</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mName" type="text" placeholder="Middle Name" value="<?php echo $res['MNAME'];?>">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Civil Status </label>
						<div class="col-md-8">
							<select class="form-control input-sm" name="cStatus" required>
								<option value="<?php echo $res['STATUS'];?>"><?php echo $res['STATUS'];?></option>
								<option value="Single">Single</option>
								<option value="Married">Married</option>
								<option value="Widower">Widower</option>
								<option value="Separated">Separated</option>
							</select>	
						</div>
					</div>

					<div class="col-md-4"><label class="col-md-4 control-label">Birth Date</label>
						<div class="col-md-8">
							<input class="form-control" onfocus="(this.type='date')" name="bDay" placeholder="Date of Birth" value="<?php echo $res['BDAY'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Birth place</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="bPlace" type="text" placeholder="Birth Place" value="<?php echo $res['BPLACE'];?>" required>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4"><label class="col-md-4 control-label">Ethnicity</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="sEthnic" type="text" placeholder="Ethnicity" value="<?php echo $res['ETHNICITY'];?>" required>
					</div>
				</div>			  
				<div class="col-md-4"><label class="col-md-4 control-label">Email</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="sEmail" placeholder="Email address" value="<?php echo $ses;?>" readonly style="background:#fff">
					</div>
				</div>
				<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="sContact" type="text" placeholder="Contact Number" value="<?php echo $res['CONTACT_NO'];?>" required>
					</div>
				</div>			  
			</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Gender </label>
						<div class="col-md-8">
							<select class="form-control input-sm" name="sGender" required>
								<option value="<?php echo $res['GENDER'];?>"><?php if($res['GENDER']=="M") echo"Male"; else echo"Female";?></option>
								<option value="M">Male</option>
								<option value="F">Female</option>	
							</select>	
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Height</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="sHeight" type="text" placeholder="Height" value="<?php echo $res['HEIGHT'];?>" required>
						</div>
					</div>			  					
					<div class="col-md-4"><label class="col-md-4 control-label">Weight</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="sWeight" type="text" placeholder="Weight" value="<?php echo $res['WEIGHT'];?>" required>
						</div>
					</div>			  					
				</div>
			</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-6"><label class="col-md-2 control-label">Residencial</label>
						<div class="col-md-10">
							<input class="form-control input-sm" name="rAddress" type="text" placeholder="Residential Address" value="<?php echo $res['RES_ADDRESS'];?>" required>
						</div>
					</div>			  					
					<div class="col-md-6"><label class="col-md-2 control-label">Permanent</label>
						<div class="col-md-10">
							<input class="form-control input-sm" name="pAddress" type="text" placeholder="Permanent Address" value="<?php echo $res['PER_ADDRESS'];?>" required>
						</div>
					</div>			  					
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4"><label class="col-md-4 control-label">Elementary</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="elSchool" type="text" placeholder="Name of School"  value="<?php echo $res['ELS_SCHOOL'];?>" required>
						<input class="form-control input-sm" name="elGradtd" type="text" placeholder="Year Graduated"  value="<?php echo $res['ELS_GRADTD'];?>" required>
						<input class="form-control input-sm" name="elHonors" type="text" placeholder="Honors Received" value="<?php echo $res['ELS_HONORS'];?>" required>
					</div>
				</div>			  		  
				<div class="col-md-4"><label class="col-md-4 control-label" for="ethnicity">Junior High</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="jrSchool" type="text" placeholder="Name of School"  value="<?php echo $res['JUN_SCHOOL'];?>" required>
						<input class="form-control input-sm" name="jrGradtd" type="text" placeholder="Year Graduated"  value="<?php echo $res['JUN_GRADTD'];?>" required>
						<input class="form-control input-sm" name="jrHonors" type="text" placeholder="Honors Received" value="<?php echo $res['JUN_HONORS'];?>" required>
					</div>
				</div>			  		  
				<div class="col-md-4"><label class="col-md-4 control-label" for="ethnicity">Senior High</label>
					<div class="col-md-8">
						<input class="form-control input-sm" name="srSchool" type="text" placeholder="Name of School"  value="<?php echo $res['SEN_SCHOOL'];?>" required>
						<input class="form-control input-sm" name="srGradtd" type="text" placeholder="Year Graduated"  value="<?php echo $res['SEN_GRADTD'];?>" required>
						<input class="form-control input-sm" name="srHonors" type="text" placeholder="Honors Received" value="<?php echo $res['SEN_HONORS'];?>" required>
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
							<input class="form-control input-sm" name="flName" type="text" placeholder="Father's Last Name" value="<?php echo $red['FA_LNAME'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">FirstName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="ffName" type="text" placeholder="Father's First Name" value="<?php echo $red['FA_FNAME'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">MiddleName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fmName" type="text" placeholder="Father's Middle Name" value="<?php echo $red['FA_MNAME'];?>" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Occupation</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fOccup" type="text" placeholder="Father's Occupation" value="<?php echo $red['FA_OCCUP'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Employer</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fEmploym" type="text" placeholder="Employer or Business Nme" value="<?php echo $red['FA_EMPLOYM'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Address</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fAddress" type="text" placeholder="Father's Business Address" value="<?php echo $red['FA_ADDRESS'];?>" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Salary</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fmSalary" type="text" placeholder="Father's Monthly Salary" value="<?php echo $red['FA_MSALARY'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fContact" type="text" placeholder="Father's Contact Number" value="<?php echo $red['FA_CONTACT'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Other</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="fOtherIn" type="text" placeholder="Father's Other Source of Income" value="<?php echo $red['FA_OINCOME'];?>" required>
						</div>
					</div>
				</div>
			</div>
			<div style="margin-bottom:5px;margin-top:20px"> &nbsp; &nbsp; <b>MOTHER'S PROFILE</b></div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">LastName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mlName" type="text" placeholder="Mother's Last Name" value="<?php echo $red['MO_LNAME'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">FirstName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mfName" type="text" placeholder="Mother's First Name" value="<?php echo $red['MO_FNAME'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">MiddleName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mmName" type="text" placeholder="Mother's Middle Name" value="<?php echo $red['MO_MNAME'];?>" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Occupation</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mOccup" type="text" placeholder="Mother's Occupation" value="<?php echo $red['MO_OCCUP'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Employer</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mEmploym" type="text" placeholder="Employer or Business Name" value="<?php echo $red['MO_EMPLOYM'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Address</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mAddress" type="text" placeholder="Mother's Business Address" value="<?php echo $red['MO_ADDRESS'];?>" required>
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Salary</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mmSalary" type="text" placeholder="Mother's Monthly Salary" value="<?php echo $red['MO_MSALARY'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mContact" type="text" placeholder="Mother's Contact Number" value="<?php echo $red['MO_CONTACT'];?>" required>
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Other</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="mOtherIn" type="text" placeholder="Mother's Other Source of Income" value="<?php echo $red['MO_OINCOME'];?>" required>
						</div>
					</div>
				</div>
			</div>			
			<div style="margin-bottom:5px;margin-top:20px"> &nbsp; &nbsp; <b>GUARDIAN'S PROFILE</b> (Optional: Fill this Form if Applicable)</div>
			<div class="form-group">
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">LastName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="glName" type="text" placeholder="Guardian's Last Name" value="<?php echo $red['GD_LNAME'];?>" >
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">FirstName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gfName" type="text" placeholder="Guardian's First Name" value="<?php echo $red['GD_FNAME'];?>" >
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">MiddleName</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gmName" type="text" placeholder="Guardian's Middle Name" value="<?php echo $red['GD_MNAME'];?>" >
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Occupation</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gOccup" type="text" placeholder="Guardian's Occupation" value="<?php echo $red['GD_OCCUP'];?>" >
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Employer</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gEmploym" type="text" placeholder="Employer or Business Name" value="<?php echo $red['GD_EMPLOYM'];?>" >
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Address</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gAddress" type="text" placeholder="Guardian's Business Address" value="<?php echo $red['GD_ADDRESS'];?>" >
						</div>
					</div>
				</div>
				<div class="rows">
					<div class="col-md-4"><label class="col-md-4 control-label">Salary</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gmSalary" type="text" placeholder="Guardian's Monthly Salary" value="<?php echo $red['GD_MSALARY'];?>" >
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Contact</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gContact" type="text" placeholder="Guardian's Contact Number" value="<?php echo $red['GD_CONTACT'];?>" >
						</div>
					</div>
					<div class="col-md-4"><label class="col-md-4 control-label">Relationship</label>
						<div class="col-md-8">
							<input class="form-control input-sm" name="gRelated" type="text" placeholder="Relationship to the Student" value="<?php echo $red['GD_RELATED'];?>" >
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
							<span class="glyphicon glyphicon-floppy-save"></span> Update
						</button> &nbsp; &nbsp;
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div><br><br>

<?php include("footer.php") ?>
