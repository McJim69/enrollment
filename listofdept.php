<?php
	require_once("includes/initialize.php");
	include 'header.php';
	
	include("menu.php");
?>

<script>setActive("entry");</script>

<div class="container">
	<?php
		check_message();
			
		?>
		<div class="well">

			    <form action="delete_dept.php" Method="POST">  					
				<table class="table table-hover">
					<caption><h3 align="left">List of Department</h3></caption>
				  <thead>
				  	<tr>
				  		<th> <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Department Name</th>
				  		<th>Department Description</th>
				 
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  		$dept = new Dept();
						$cur = $dept->listOfDept();
						foreach ($cur as $Department) {
				  		echo '<tr>';

				  		echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$Department->DEPT_ID. '"/>
				  				<a href="editDept.php?id='.$Department->DEPT_ID.'">' . $Department->DEPARTMENT_NAME.'</a></td>';
				  		echo '<td colspan="3">'. $Department->DEPARTMENT_DESC.'</td>';
				  		echo '</tr>';
						} 
				  	?>
				  </tbody>
				  <tfoot>
				  	<tr><td></td><td></td></tr>
				  </tfoot>	
				</table>
				<div class="action-btn-group" style="margin-top: 16px; display: flex; gap: 10px;">
				  <a href="newDept.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New Department</a>
				  <button type="submit" class="btn btn-outline-danger" name="delete" onclick="return confirm('Are you sure you want to delete selected department(s)?');"><i class="fas fa-trash-alt"></i> Delete Selected</button>
				</div>
				</form>
	  	</div><!--End of well-->

</div><!--End of container-->

<?php include("footer.php") ?>



