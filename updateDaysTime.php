<?php
	require_once("includes/initialize.php");
	include 'header.php';

	if($_SESSION['ACCOUNT_TYPE']=="Registrar"){
		include("menu_registrar.php");
	} 	
	else if($_SESSION['ACCOUNT_TYPE']=="Encoder"){
		include("menu_encoder.php");
	} 
	else{
		include("menu.php");
	}
?>
<div class="container">
<?php
	// $subjid = $_GET['id'];
	// $singlesubject = new Subject();
	// $object = $singlesubject->single_subject($subjid);

			if (isset($_GET['classId'])){			
			$mydb->setQuery("SELECT * 
					FROM  `subject` s,  `course` c  ,class cl
					WHERE s.`COURSE_ID` = c.`COURSE_ID` 
					AND s.`SUBJ_ID`=cl.`SUBJ_ID` 
					AND  `CLASS_ID` = ".$_GET['classId']."");
			$cur = $mydb->loadSingleResult();	
			
			$INST_ID =   (isset($cur)) ? $cur->INST_ID : 'INST_ID' ; 

if (isset($_POST['savecourse'])){
	
	if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['unit'] == "") {
		message("All field is required!","error");
		check_message();
	}else{

		$instClass = new InstructorClasses();
		$Subjectid		= $_GET['id'];
		$subjcode   	= $_POST['subjcode'];
		$day 			= $_POST['day'];
		$time 			= $_POST['time'];
		$ay 			= $_POST['sy'];

			// $instClass->SUBJ_ID		= $Subjectid;
			// $instClass->CLASS_CODE	= $subjcode;
			// $instClass->INST_ID 		= $INST_ID;		
			// $instClass->SYID 		= 'NONE';
			$instClass->DAY 		 	= $day;
			$instClass->C_TIME 		 	= $time;
			$instClass->update($_GET['classId']);
			message($subjcode. " has updated successfully!", "info");
			redirect('listofclass.php');
			}
		}	 	
	}
?>		
	<form class="form-horizontal well span4" action="?classId=<?php echo $_GET['classId'];?>" method="POST">
		<fieldset><legend>Update Time</legend>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label">Subject Code</label>
					<div class="col-md-8">
						<input class="form-control input-sm" id="subjcode" name="subjcode" readonly type="text" value="<?php echo (isset($cur)) ? $cur->SUBJ_CODE : 'Code' ;?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label">Subject Description</label>
					<div class="col-md-8">
						<input class="form-control input-sm" id="subjdesc" name="subjdesc" readonly type="text" value="<?php echo (isset($cur)) ? $cur->SUBJ_DESCRIPTION  : 'Description' ;?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label">No of Units</label>
					<div class="col-md-8">
						<input class="form-control input-sm" id="unit" name="unit" readonly type="number" value="<?php echo (isset($cur)) ? $cur->UNIT  : 'UNIT';?>">
					</div>
				</div>
			</div>
			   <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for=
				  "pre">Prerequisite</label>

				  <div class="col-md-8">
					 <input class="form-control input-sm" id="pre" name="pre" readonly placeholder=
										  "Prerequisite" type="text" value="<?php (isset($cur)) ? $cur->PRE_REQUISITE  : 'PRE_REQUISITE';?>">
				  </div>
				</div>
			  </div>
			   <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for=
				  "course">Course</label>

				  <div class="col-md-8">
				  <input class="form-control input-sm" id="course_name" name="course_name" readonly type="text" value="<?php echo (isset($cur)) ? $cur->COURSE_NAME : 'Course' ;?>">
					   
							
					 
				  </div>
				</div>
			  </div>
			   <div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="ay">Academic Year</label>
				  <div class="col-md-8">
					<input class="form-control input-sm" id="sy" name="sy" readonly type="text" value="<?php echo (isset($cur)) ? $cur->AY : 'Course';?>">
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for=
				  "Semester">Semester</label>

				  <div class="col-md-8">
					  <input class="form-control input-sm" id="semester" name="semester" readonly type="text" value="<?php echo (isset($cur)) ? $cur->SEMESTER : 'Semester' ;?>">
				  </div>
				</div>
			  </div>
				<div class="form-group">
				<div class="col-md-8">
				  <label class="col-md-4 control-label" for="ay">Day</label>

				  <div class="col-md-8">
						<input class="form-control input-sm"   name="day" id="day">
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="ay">Time</label>
				  <div class="col-md-8">
					<input class="form-control input-sm"  name="time" id="time">
				  </div>
				</div>
			  </div>
			 <div class="form-group">
				<div class="col-md-8"><label class="col-md-4 control-label" for="idno"></label>
					<div class="col-md-8">
						<button class="btn btn-primary" name="savecourse" type="submit" >Save</button>
					</div>
				</div>
			</div>							
		</fieldset>	
	</form>
</div>

<?php include("footer.php"); ?>