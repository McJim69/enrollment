<?php
require_once("includes/initialize.php");
//include 'header.php';
	$session = $_SESSION['ACCOUNT_USERNAME'];
			
	$ex0=$conn->query("SELECT * FROM tblstudent s WHERE s.EMAIL='".$session."'");
	$str=$ex0->fetch_assoc();	
	
	$sID = $str['IDNO']; 

	  @$id=$_POST['selector'];
	  $key = count($id);


if (!$id==''){
//multi delete using checkbox as a selector
	
	for($i=0;$i<$key;$i++){

		 //echo $id[$i];
 
		$studSubjects = NEW Grades();
		$studSubjects->delete($id[$i]);
	}
			message("Student subject(s) already Deleted!","info");
			redirect('studentAddsubjects.php?id='.$sID.'');
}else{
	message("Select your subject(s) first, if you want to delete it!","error");
	redirect('studentAddsubjects.php?id='.$sID.'');
}
	
?>