<?php
	require_once("includes/initialize.php");
	include 'header.php';

	include("menu.php");
?>

<script>setActive("class");</script>

<div class="container"><?php check_message(); ?>
	<div class="well">
		<form action="#.php" Method="POST">  					
			<table class="table table-hover"><caption><h3 align="left">List of Class</h3></caption>
				<thead>
					<tr class="table">
						<th>Class Code</th>
				  		<th>Instructor</th> 
				  		<th>Days / Time</th> 
				  		<th>Students</th>
					</tr>	
				</thead>
				<tbody>
					<?php
						global $mydb;
						$mydb->setQuery("SELECT * FROM `instructor` i, `class` c WHERE i.`INST_ID` = c.`INST_ID` ");
						loadresult();

						function loadresult(){
							global $mydb;
							$cur = $mydb->loadResultlist();
							foreach ($cur as $result) {
								echo'<tr>';
								echo'<td style="text-transform:uppercase"> '.$result->CLASS_CODE.' </td>';
								echo'<td>';if($result->INST_SEX == 'M') echo'Mr. '.$result->INST_FULLNAME.''; else echo'Ms. '.$result->INST_FULLNAME.'';echo'</td>';
								echo'<td><a href="updateDaysTime.php?classId='.$result->CLASS_ID.'">'.$result->DAY.' / '.$result->C_TIME.'</a></td>';  
								echo'<td><a href="instructorClasses.php?classId='.$result->CLASS_ID.'">View List</a></td>';
								echo'</tr>';
							}
						} 
					?>
				</tbody>
			</table>
		</form>
	</div>
</div>

<?php include("footer.php") ?>



