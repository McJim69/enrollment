<?php
	require_once("includes/initialize.php");
	include 'header.php';

	include("menu.php");
?>

<script>setActive("entry");</script>

<div class="container"><?php check_message();?>
	<div class="well">
	    <form action="delete_course.php" Method="POST">  					
			<table class="table table-hover"><caption><h3 align="left">List of Course</h3></caption>
				<thead>
				  	<tr>
						<th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">Course Name</th>
						<th>Level</th>
						<th>Major</th>
				  		<th>Course Description</th>
				  		<th align="center">Department</th>
				  	</tr>	
				</thead>
				<tbody>
				<?php
					@$coursename =  $_GET['idno'];
					@$Major 	 =  $_GET['Major'];

					if ($coursename == '' AND $Major == ''){ 
						$mydb->setQuery("SELECT * FROM `course` c, `department` d
							WHERE c.`DEPT_ID` = d.`DEPT_ID` ORDER BY COURSE_NAME, COURSE_MAJOR");
						loadresult();
					}else{
						$mydb->setQuery("SELECT * FROM  `course` c,  `department` d
							WHERE c.`DEPT_ID` = d.`DEPT_ID` AND c.`COURSE_NAME`='{$coursename}'
							OR c.`COURSE_MAJOR`='{$Major}' ORDER BY COURSE_NAME, COURSE_MAJOR");
						loadresult();
					}
					
					function loadresult(){
						global $mydb; 
						$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
						echo '<tr>';
						echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$result->COURSE_ID. '"/>
							  <a href="editCourse.php?id='.$result->COURSE_ID.'">' . $result->COURSE_NAME.'</a></td>';
						echo '<td>'. $result->COURSE_LEVEL.'</td>';
						echo '<td>'. $result->COURSE_MAJOR.'</td>';
						echo '<td>'. $result->COURSE_DESC.'</td>';
						echo '<td>'. $result->DEPARTMENT_DESC.'</td>';
						echo '</tr>';
						} 
					}	
				?>
				</tbody>
				<tfoot>
					<tr><td></td><td></td><td></td></tr>
				</tfoot>	
			</table>
			<div class="action-btn-group" style="margin-top: 16px; display: flex; gap: 10px;">
				<a href="newCourse.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New Course</a>
				<button type="submit" class="btn btn-outline-danger" name="delete" onclick="return confirm('Are you sure you want to delete selected course(s)?');"><i class="fas fa-trash-alt"></i> Delete Selected</button>
			</div>
		</form>
	</div>
</div>

<?php include("footer.php") ?>



