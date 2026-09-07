<?php
	require_once("includes/initialize.php");	
	include 'header.php';

	include("menu.php");
?>

<script>setActive("enroll");</script>

<div class="rows">

  <div class="col-12 col-sm-12 col-lg-12">
	<?php
		  	 if (isset($_POST['search'])){
				if ($_POST['txtsearch']==""){
					message("ID Number is required!","error");
					check_message();

				}else{
					$student = new Student();
					$cur = $student->single_student($_POST['txtsearch']);
				}
			}
			if (isset($_POST['savestep1'])){

 				$created =  strftime("%Y-%m-%d %H:%M:%S", time()); 
				$idno  =  $_POST['idno'];
				$Status = $_POST['Status'];
				$course = $_POST['course'];
				$ay 	 = $_POST['ay'];
				$Semester = $_POST['Semester'];
				
				$sy = new Schoolyr();
				$sy->AY = $ay;
				$sy->SEMESTER = $Semester;
				$sy->COURSE_ID = $course;
				$sy->IDNO = $idno;
				$sy->DATE_RESERVED = $created;
				
				$istrue = $sy->create();
			 if ($istrue == 1){
			 	
			 	message("Reservation save successfully!","success");
			 	check_message();
			}
		}
	?>
	
	<?php include("manager.php"); ?>

		  <form class="form-horizontal span4" action="#.php" method="POST">

					<div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Enrollment Reservation</h3>
					  </div>
					  <div class="panel-body">

					   <div class="row">
			            <div class="col-md-10 col-md-offset-1">

			             <div class="form-group" id="idno">
				            <label class="col-md-3 control-label" for="idno">ID Number:</label>
				            <div class="col-md-9">
				                <input class="form-control input-sm" id="idno" name="idno" readonly placeholder="ID Number" type="text" value="<?php echo (isset($cur)) ? $cur->IDNO : 'ID' ;?>">
							</div>
				          </div>

				          <div class="form-group">
				            <label class="col-md-3 control-label" for="Name">Name:</label>
				            <div class="col-md-9">
				                <input class="form-control input-sm" readonly placeholder="Fullname" type="text" value="<?php echo (isset($cur)) ? $cur->LNAME.', '.$cur->FNAME : 'Fullname' ;?>">
							</div>
				          </div>

			              <div class="form-group">
				            <label class="col-md-3 control-label" for="Status">Status:</label>
				            <div class="col-md-9">
				                 <select class="form-control input-sm" name="Status" id="Status">
									<option value="New">New Student</option>
									<option value="Continuing">Continuing</option>	
									<option value="Trasferee">Trasferee</option>	
								</select>
				            </div>
				          </div>

			             <div class="form-group">
				            <label class="col-md-3 control-label" for="course">Course and Year:</label>
				            <div class="col-md-9">
				               <select class="form-control input-sm" name="course" id="course">
				                  	<?php
				                  	$course = new Course();
				                  	$cur = $course->listOfcourse();	
				                  	foreach ($cur as $course) {
				                  		echo '<option value="'. $course->COURSE_ID.'">'.$course->COURSE_NAME.' '.$course->COURSE_LEVEL .' '.$course->COURSE_MAJOR .'</option>';
				                  	}
				                  	?>
								</select>	
				            </div>
				          </div>

			             <div class="form-group">
				            <label class="col-md-3 control-label" for="ay">Academic Year:</label>
				            <div class="col-md-9">
				                <select class="form-control input-sm" name="ay" id="ay">
									<?php 
										$year1 = date("Y");
										$year2 = date("Y")+5;
										for($i=$year1;$i<=$year2;$i++){   
										$say=$i+1;
											echo"<option value='$i-$say'>$i-$say</option>";
										}
									?>
								</select>	
				            </div>
				          </div>

				          <div class="form-group">
				            <label class="col-md-3 control-label" for="Semester">Semester:</label>
				            <div class="col-md-9">
				                 <select class="form-control input-sm" name="Semester" id="Semester">
									<option value="First">First</option>
									<option value="Second">Second</option>	
									<option value="Summer">Summer</option>	
								</select>
				            </div>
				          </div>

				          <div class="form-group">
				            <div class="col-md-9 col-md-offset-3">
							         <div class="filter-query-actions" style="display: flex; gap: 10px; max-width: 360px;">
									    <button type="submit" name="savestep1" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
									    <a href="newstudent.php" name="add" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i> New Student</a>
									</div>
				            </div>
				          </div>
				       
			            </div><!--/span-->
			        </div><!--End of row-->

					  </div>
					</div>
									
				</form>
				  
		  </div>

		</div>

<?php include("footer.php") ?>



