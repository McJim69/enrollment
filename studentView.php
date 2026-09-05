<?php
	session_start();
	require_once("connect.php");
	include 'header.php';
	include("menu_student.php");
	require_once("language.php");
	
	$ses = $_SESSION['ACCOUNT_USERNAME'];
	$exs = $conn->query("SELECT * FROM tblstudent s WHERE s.EMAIL='".$ses."'");
?>

<style>
	.std{
		padding:3px;
		border:1px solid #bbb;
	}
	.mar-top{
		margin-top:5px;
	}
</style>

<script>setActive("info");</script>

<div class="container" width="100%">
	<div class="well">
		<div class="row text-center" align="center">
			<div class="col col-md-2">
				<img src="img/logo.png" style="width:150px;height:150px">
			</div>
			<div class="col col-md-8">
				<h3><?php echo TITLE;?></h3>
				<b><?php echo BUILDING;?></b><br>
				<?php echo STREET;?><br>
				<?php echo ADDRESS;?><br>
				<?php echo CONTACT;?><br>
				<?php echo EMAIL;?>
			</div>
			<div class="col col-md-2">	
				<img src="img/blank.jpg" style="width:150px;height:150px">
			</div>
		</div>
		<div class="text-center"><h3>ENROLLMENT FOR COLLEGE</h3></div>

		<?php 
			while($rss = mysqli_fetch_array($exs)){	
				$contn = $rss['S_ID'];
				$sIDNo = sprintf("%04d", $contn);
				
				$esx=$conn->query("SELECT * FROM course WHERE COURSE_ID='".$rss['COURSE']."'");
				$rsc=mysqli_fetch_array($esx);

				if($rsc["COURSE_LEVEL"]==1) { $level="First Year"; }
				if($rsc["COURSE_LEVEL"]==2) { $level="Second Year";}
				if($rsc["COURSE_LEVEL"]==3) { $level="Third Year"; }
				if($rsc["COURSE_LEVEL"]==4) { $level="Fouth Year"; }

				if($rsc["COURSE_MAJOR"]=="None"){$major="";}else{$major="Major in: ".$rsc['COURSE_MAJOR']." ";}

				$esd=$conn->query("SELECT * FROM tblstuddetails WHERE STU_ID='".$rss['S_ID']."'");
				$det=mysqli_fetch_array($esd);

				$birth = $rss['BDAY'];
				$birthDate = $birth;
				$birthDate = explode("-", $birthDate);
				$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));

				echo"
				<div class='row'>
					<div class='col col-md-3'>";	
						if($rss['S_TYPE']=="New Student"){
						echo"
						<input class='form-check-input' type='checkbox' checked> &nbsp; <b>".$rss['S_TYPE']."</b><br>
						<input class='form-check-input' type='checkbox'> &nbsp; Old Student<br>
						<input class='form-check-input' type='checkbox'> &nbsp; Returning<br>
						<input class='form-check-input' type='checkbox'> &nbsp; Transferee";
						}
						if($rss['S_TYPE']=="Old Student"){
						echo"
						<input class='form-check-input' type='checkbox'> &nbsp; New Student<br>
						<input class='form-check-input' type='checkbox' checked> &nbsp; <b>".$rss['S_TYPE']."</b><br>
						<input class='form-check-input' type='checkbox'> &nbsp; Returning<br>
						<input class='form-check-input' type='checkbox'> &nbsp; Transferee";
						}
						if($rss['S_TYPE']=="Returning"){
						echo"
						<input class='form-check-input' type='checkbox'> &nbsp; New Student<br>
						<input class='form-check-input' type='checkbox'> &nbsp; Old Student<br>
						<input class='form-check-input' type='checkbox' checked> &nbsp; <b>".$rss['S_TYPE']."</b><br>
						<input class='form-check-input' type='checkbox'> &nbsp; Transferee";
						}
						if($rss['S_TYPE']=="Transferee"){
						echo"
						<input class='form-check-input' type='checkbox'> &nbsp; New Student<br>
						<input class='form-check-input' type='checkbox'> &nbsp; Old Student<br>
						<input class='form-check-input' type='checkbox'> &nbsp; Returning<br>
						<input class='form-check-input' type='checkbox' checked> &nbsp; <b>".$rss['S_TYPE']."</b>";
						}
					echo"
					</div>
					<div class='col col-md-6'>	
						<div class='form-control mar-top'>Course: <b>".$rsc['COURSE_NAME']." ".$rsc['COURSE_LEVEL']." ".$major."</b></div>
						<div class='form-control mar-top'>Semester: <b>".$rss['SEMESTER']."</b></div>
						<div class='form-control mar-top'>Year Level: <b>".$level."</b></div>
					</div>
					<div class='col col-md-3'>	
						<div class='form-control mar-top'>School Year: <b>".$rss['SCHOOL_YEAR']."</b></div>					
						<div class='form-control mar-top'>Class Block: <b>";
							if($rss['CLASS_BLOCK']==""){echo"Not Yet Scheduled";} else {echo"".$rss['CLASS_BLOCK']."";}echo"</b>
						</div>							
						<div class='form-control mar-top'>Current Date: <b>".date("F d, Y")."</b></div>					
					</div>
				</div>
				<div class='mar-top'><h4>Personal Information</h4></div>
				<div class='row'>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Sure Name: <b>".$rss['LNAME']."</b></div>			
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>First Name: <b>".$rss['FNAME']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Middle Name: <b>".$rss['MNAME']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Date of Birth: <b>".$rss['BDAY']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Place of Birth: <b>".$rss['BPLACE']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Gender: <b>";
							if($rss['GENDER']=="M") echo"Male";else echo"Female";echo"</b>
							&nbsp; &nbsp; &nbsp; Age: <b>$age</b>
						</div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Civil Status: <b>".$rss['STATUS']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Height: <b>".$rss['HEIGHT']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Weight: <b>".$rss['WEIGHT']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Contact Number: <b>".$rss['CONTACT_NO']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Email Address: <b>".$rss['EMAIL']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'>
						<div class='form-control'>Ethnicity: <b>".$rss['ETHNICITY']."</b></div>
					</div>
					<div class='col col-md-6 mar-top'>
						<div class='form-control'>Residential Address: <b>".$rss['RES_ADDRESS']."</b></div>
					</div>
					<div class='col col-md-6 mar-top'>
						<div class='form-control'>Permanent Address: <b>".$rss['PER_ADDRESS']."</b></div>
					</div>
				</div>
				<div class='row' style='padding:15px;text-align:center'>
					<table class='table'>
						<thead class='std' style='background:#bbb'>
							<tr class='std text-center'>
								<th class='std text-center'>Level</th>
								<th class='std text-center'>Name of School</th>
								<th class='std text-center'>Year Graduated</th>
								<th class='std text-center'>Honors Received</th>
							</tr>
						</thead>
						<tbody style='background:#fff'>
							<tr>
								<td class='std'>Elementary</td>
								<td class='std'>".$rss['ELS_SCHOOL']."</td>
								<td class='std'>".$rss['ELS_GRADTD']."</td>
								<td class='std'>".$rss['ELS_HONORS']."</td>
							</tr>
							<tr>
								<td class='std'>Junior High</td>
								<td class='std'>".$rss['JUN_SCHOOL']."</td>
								<td class='std'>".$rss['JUN_GRADTD']."</td>
								<td class='std'>".$rss['JUN_HONORS']."</td>
							</tr>
							<tr>
								<td class='std'>Senior High</td>
								<td class='std'>".$rss['SEN_SCHOOL']."</td>
								<td class='std'>".$rss['SEN_GRADTD']."</td>
								<td class='std'>".$rss['SEN_HONORS']."</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div style='margin-top:-20px'><h4>Secondary Information</h4></div>
				<div class='row'>
					<div class='col col-md-4 mar-top'><b> &nbsp;Father's Information</b></label>
						<div class='form-control mar-top'>Sure Name: <b>".$det['FA_LNAME']."</b></div>
						<div class='form-control mar-top'>First Name: <b>".$det['FA_FNAME']."</b></div>
						<div class='form-control mar-top'>Middle Name: <b>".$det['FA_MNAME']."</b></div>
						<div class='form-control mar-top'>Occupation: <b>".$det['FA_OCCUP']."</b></div>
						<div class='form-control mar-top'>Employer/Business Name: <b>".$det['FA_EMPLOYM']."</b></div>
						<div class='form-control mar-top'>Business Address: <b>".$det['FA_ADDRESS']."</b></div>
						<div class='form-control mar-top'>Monthly Salary: <b>".$det['FA_MSALARY']."</b></div>
						<div class='form-control mar-top'>Cellphone Number: <b>".$det['FA_CONTACT']."</b></div>
						<div class='form-control mar-top'>Other Source of Income: <b>".$det['FA_OINCOME']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'><b> &nbsp;Mother's Information</b>
						<div class='form-control mar-top'>Sure Name: <b>".$det['FA_LNAME']."</b></div>
						<div class='form-control mar-top'>First Name: <b>".$det['MO_FNAME']."</b></div>
						<div class='form-control mar-top'>Middle Name: <b>".$det['MO_MNAME']."</b></div>
						<div class='form-control mar-top'>Occupation: <b>".$det['MO_OCCUP']."</b></div>
						<div class='form-control mar-top'>Employer/Business Name: <b>".$det['MO_EMPLOYM']."</b></div>
						<div class='form-control mar-top'>Business Address: <b>".$det['MO_ADDRESS']."</b></div>
						<div class='form-control mar-top'>Monthly Salary: <b>".$det['MO_MSALARY']."</b></div>
						<div class='form-control mar-top'>Cellphone Number: <b>".$det['MO_CONTACT']."</b></div>
						<div class='form-control mar-top'>Other Source of Income: <b>".$det['MO_OINCOME']."</b></div>
					</div>
					<div class='col col-md-4 mar-top'><b> &nbsp;Guardians's Information</b>
						<div class='form-control mar-top'>Sure Name: <b>".$det['GD_LNAME']."</b></div>
						<div class='form-control mar-top'>First Name: <b>".$det['GD_FNAME']."</b></div>
						<div class='form-control mar-top'>Middle Name: <b>".$det['GD_MNAME']."</b></div>
						<div class='form-control mar-top'>Occupation: <b>".$det['GD_OCCUP']."</b></div>
						<div class='form-control mar-top'>Employer/Business Name: <b>".$det['GD_EMPLOYM']."</b></div>
						<div class='form-control mar-top'>Business Address: <b>".$det['GD_ADDRESS']."</b></div>
						<div class='form-control mar-top'>Monthly Salary: <b>".$det['GD_MSALARY']."</b></div>
						<div class='form-control mar-top'>Cellphone Number: <b>".$det['GD_CONTACT']."</b></div>
						<div class='form-control mar-top'>Relationship to the Student: <b>".$det['GD_RELATED']."</b></div>
					</div>
				</div>
				<div class='row text-center'>
					<div id='buttons1' class='col col-md-4'>
						<div>&nbsp;</div>
						<div class='row text-center'>
							<button class='btn btn-primary' onclick=\"jump('studentLoad.php?id=$rss[0]')\" style='width:100px'>Class Load</button> &nbsp; &nbsp; 
							<button class='btn btn-primary' onclick=\"jump('studentEval.php?id=$rss[0]')\" style='width:100px'>Evaluation</button>
						</div>
					</div>
					<div class='col col-md-4' style='background:#fff;border:1px solid #bbb;border-radius:5px;padding:10px;margin:20px 0 0 0'>
						<div><b>".PTITLE."</b></div>
						<div><small>".PLEDGE."</small></div>
						<div style='margin:20px 20px 0 20px;border-bottom:1px solid #bbb;text-transform:uppercase'>
							<b>".$rss['FNAME']." ".$rss['MNAME']." ".$rss['LNAME']."</b>
						</div>
						<div><small><i>".SIGOPN."</i></small></div>
					</div>
					<div id='buttons2' class='col col-md-4'>
						<div>&nbsp;</div>
						<div class='row text-center'>
							<button class='btn btn-primary' onclick='printF()' style='width:100px'>Print</button> &nbsp; &nbsp; 
							<button class='btn btn-primary' onclick=\"jump('studentEdit.php?id=$rss[0]')\"  style='width:100px'>Edit</button>
						</div>
					</div>
				</div>
			  ";
			}
		?>
	</div>
</div><br>

<script>
	function printF(){		
		getID('menu').style.display='none';
		getID('footer').style.display='none';
		getID('buttons1').style.display='none';
		getID('buttons2').style.display='none';

	window.print();
		getID('menu').style.display='block';
		getID('footer').style.display='block';
		getID('buttons1').style.display='block';
		getID('buttons2').style.display='block';
	}
</script>

<?php include("footer.php") ?>
