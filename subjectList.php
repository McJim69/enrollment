<?php
	require_once("includes/initialize.php");
	include 'header.php';

	include("menu.php");
?>

<script>setActive("entry");</script>

<div class="container">
	<div class="well"><?php check_message(); ?>
		<form action="delete_subject.php" Method="POST">  					
			<table class="table table-hover"><caption><h3 align="left">List of Subject</h3></caption>
				<thead>
					<tr>
						<th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> &nbsp; Code</th>
						<th>Description</th>
						<!--<th>Pre-requisite</th>-->
						<th>Unit</th>
						<th>Semester</th>
						<th>Course</th>
						<th>Level</th>
					</tr>	
				</thead>
				<tbody>
				<?php
					global $mydb;
					$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;									
					$per_page = 10;
					$countEmp = new SubjPagination();
					$total_count = $countEmp->count_allrecords();					
					$pagination = new SubjPagination($current_page, $per_page, $total_count);
					
					@$subjcode =  $_GET['subjcode'];
					@$course 	 =  $_GET['course'];
					@$ay		 =  $_GET['ay'];
					@$semester =  $_GET['semester'];
				  	  
					if($subjcode == '' AND $ay == '' AND $semester == ''){ 
						$mydb->setQuery("SELECT * 
							FROM  `subject` s,  `course` c
							WHERE s.`COURSE_ID` = c.`COURSE_ID` LIMIT {$pagination->per_page} OFFSET {$pagination->offset()} ");
						loadresult();
					}else{
						$mydb->setQuery("SELECT * 
							FROM  `subject` s,  `course` c
							WHERE s.`COURSE_ID` = c.`COURSE_ID` 
							AND SUBJ_CODE='{$subjcode}' 
							OR c.`COURSE_ID`='{$course}' 
							OR AY='{$ay}'
							OR SEMESTER='{$semester}'");
						loadresult();
					}

					function loadresult(){
						global $mydb;
						
						$cur = $mydb->loadResultlist();
						foreach ($cur as $result) {
							
							echo'<tr>';
							echo'<td style="text-transform:uppercase"><input type="checkbox" name="selector[]" id="selector[]" value="'.$result->SUBJ_ID. '"/>';
								echo'<a href="editSubject.php?id='.$result->SUBJ_ID.'"> &nbsp '.$result->SUBJ_CODE.'</a></td>';
						  		echo'<td>'. $result->SUBJ_DESCRIPTION.'</td>';
						  	//	echo'<td>'. $result->PRE_REQUISITE.'</td>';
						  		echo'<td>'. $result->UNIT.'</td>';
						  		echo'<td>'. $result->SEMESTER.'</td>';
						  		echo'<td>'. $result->COURSE_NAME.'</td>';
						  		echo'<td>'. $result->COURSE_LEVEL.'</td>';
							echo'</tr>';
				  		}
				  	} 
				?>
				</tbody>
				<tfoot>
				  	<tr><td colspan="7">
					<?php	
						echo'<ul class="pager" align="center">';
						if ($pagination->total_pages() > 1){
							echo'<li class="pager-info"><span>Page ' .$current_page .' of '. $pagination->total_pages().'</span></li>';
							if ($current_page == 1 ){
								echo' <li class="disabled"><a href="subjectList.php?page='.$pagination->First_page().'">First</a></li>';
							}else{
								echo' <li><a href="subjectList.php?page='.$pagination->First_page().'">First</a></li>';
							}
							if ($current_page > 1 ){							
								echo' <li><a href="subjectList.php?page='.($current_page - 1).'">Previous</a></li>';
							}else{
								echo' <li class="disabled"><a href="#">Previous</a></li>';
							}
							if ($current_page < $pagination->total_pages()){
								echo' <li><a href="subjectList.php?page='.($current_page + 1) .'">Next</a></li>';											
							}else{
								echo' <li class="disabled"><a href="#">Next</a></li>';
							}							
							if ($current_page == $pagination->total_pages() ){										
								echo' <li class="disabled"><a href="subjectList.php?page='.$pagination->total_pages().'">Last</a></li>';
							}else{
								echo' <li><a href="subjectList.php?page='.$pagination->total_pages().'">Last</a></li>';
							}
						}
						echo '</ul>';
					?></td></tr>
				</tfoot>	
			</table>
			<div class="action-btn-group" style="margin-top: 16px; display: flex; gap: 10px;">
				<a href="newsubject.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New</a>
				<button type="submit" class="btn btn-outline-danger" name="delete" onclick="return confirm('Are you sure you want to delete selected subject(s)?');"><i class="fas fa-trash-alt"></i> Delete Selected</button>
			</div>
		</form>
	</div><br>
</div><br>

<?php include("footer.php") ?>



