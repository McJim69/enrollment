<?php
	require_once("includes/initialize.php");
	include 'header.php';

	include("menu.php");
?>

<script>setActive("settings");</script>

<div class="container"><?php check_message();?>
	<div class="well">
	    <form action="delete_user.php" Method="POST">  					
			<table class="table table-hover"><caption><h3 align="left">List of User</h3></caption>
				<thead>
				  	<tr>
				  		<th><input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">Account Name</th>
				  		<th>Username</th>
				  		<th>Type</th>
				  	</tr>	
				</thead>
				<tbody>
				  	<?php 
				  		$mydb->setQuery("SELECT * FROM  `useraccounts`");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$result->ACCOUNT_ID. '"/>
								<a href="editUser.php?id='.$result->ACCOUNT_ID.'">' . $result->ACCOUNT_NAME.'</a></td>';
				  		echo '<td>'. $result->ACCOUNT_USERNAME.'</td>';
				  		echo '<td>'. $result->ACCOUNT_TYPE.'</td>';
				  		echo '</tr>';
				  	} 
				  	?>
				</tbody>
				<tfoot>
				  	<tr><td></td><td></td><td></td></tr>
				</tfoot>	
				</table>
				<div class="action-btn-group" style="margin-top: 16px; display: flex; gap: 10px;">
				  <a href="newuser.php" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create New User</a>
					<?php if($_SESSION['ACCOUNT_TYPE']=="Administrator"){
					echo"
						<button type='submit' class='btn btn-outline-danger' name='delete' onclick=\"return confirm('Are you sure you want to delete selected user(s)?');\"><i class='fas fa-trash-alt'></i> Delete Selected</button>
						";
						}
					?>
				</div>
				</form>
	  	</div><!--End of well-->

</div><!--End of container-->

<?php include("footer.php") ?>



