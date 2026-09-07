<?php
	require_once("includes/initialize.php");
	include 'header.php';
	
	include("menu.php");
?>

<div class="container">

<script>setActive("entry");</script>

	<?php
		check_message();
	?>
		<div class="well">
			    <form action="delete_student.php" Method="POST">  					
				<table class="table table-hover">
					<caption><h3 align="left">List of Student</h3></caption>
				  <thead>
				  	<tr>
				  		<th> <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> ID#.</th>
				  		<th>Fullname</th>
				  		<th>Gender</th>
				  		<th>Age</th>
				  		<th>Birth Date</th>
				  		<th>Status</th>
				  		<th>Email Address</th>
				  		<th></th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 

				  	global $mydb;
				
					//this is the current page per number ($current_page)	
					$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
									
					//record per Page($per_page)	
					$per_page = 10;
										
					//total count record ($total_count)
					$countEmp = new StudPagination();
					$total_count = $countEmp->count_allrecords();
					
					$pagination = new StudPagination($current_page, $per_page, $total_count);

					@$idno =  $_GET['idno'];
					@$lname =  $_GET['lname'];
					@$fname =  $_GET['fname'];

					if ($idno == '' AND $lname=='' AND $fname == ''){
						$mydb->setQuery("SELECT `IDNO`, `LNAME`, `FNAME`, `MNAME`, `SEX`, `AGE`, `BDAY`, `STATUS`, `EMAIL`
				  						 FROM `tblstudent` LIMIT {$pagination->per_page} OFFSET {$pagination->offset()}");
				  	  	loadresult();

						}else{
							$mydb->setQuery("SELECT `IDNO`, `LNAME`, `FNAME`, `MNAME`, `SEX`, `AGE`, `BDAY`, `STATUS`, `EMAIL`
											 FROM  `tblstudent` 
											 WHERE  `IDNO` ='". $idno."' OR  `LNAME` = '". $lname ."'	OR  `FNAME` =  '". $fname ."' 
											 LIMIT {$pagination->per_page} OFFSET {$pagination->offset()}");	
							loadresult();	
						}

				  		function loadresult(){
				  			global $mydb;
					  		$cur = $mydb->loadResultList();
							foreach ($cur as $student) {
					  		echo '<tr>';

					  		echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$student->IDNO. '"/>
									<a href="viewStudent.php?id='.$student->IDNO.'">' . $student->IDNO.'</a>
								  </td>';
					  		echo '<td>'. $student->LNAME.', '. $student->FNAME.' '. $student->MNAME.'</td>';
					  		echo '<td>'. $student->SEX.'</td>';
					  		echo '<td>'. $student->AGE.'</td>';
					  		echo '<td>'. $student->BDAY.'</td>';
					  		echo '<td>'. $student->STATUS.'</td>';
					  		echo '<td>'. $student->EMAIL.'</td>';
					  		echo '<td><a href = "studentsubjects.php?studentId='.$student->IDNO.'" >Enrolled Subjects</a></td>';
					  		echo '</tr>';
					  		}

				  		} 
				  	
				  	?>


				  </tbody>
				  <tfoot>
				  	<tr><td colspan="8">
				  		<?php	echo '<ul class="pagination" align="center">';
									
					if ($pagination->total_pages() > 1){
						//this is for previous record
						if ($pagination->has_previous_page()){
						echo ' <li><a href="listofstudent.php?page='.$pagination->previous_page().'">&laquo;</a></li>';
						}
						 //it loops to all pages
					 	 for($i = 1; $i <= $pagination->total_pages(); $i++){
							//check if the value of i is set to current page	
							if ($i == $pagination->current_page){
							//then it sset the i to be active or focused
								echo '<li class="active"><span>'. $i.' <span class="sr-only">(current)</span></span></li>';
							 }else {
							 //display the page number
								echo ' <li><a href="listofstudent.php?page='.$i.'"> '. $i .' </a></li>';
							 } 
						 }
						//this is for next record		
						if ($pagination->has_next_page()){
						echo ' <li><a href="listofstudent.php?page='.$pagination->next_page().'">&raquo;</a></li>';
						}
						
					}
					echo '</ul>';
					?>
				</td>
			</tr>
				  </tfoot>	
				</table>
				<div class="action-btn-group" style="margin-top: 16px; display: flex; gap: 10px;">
				  <a href="newstudent.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New</a>
				   <button type="submit" class="btn btn-outline-danger" name="delete" onclick="return confirm('Are you sure you want to delete selected student(s)?');"><i class="fas fa-trash-alt"></i> Delete Selected</button>
				</div>
				</form>
	  	</div><!--End of well-->

</div><!--End of container-->

<?php include("footer.php") ?>



