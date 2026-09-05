<?php
	require("connect.php");
	$sID=$_GET['S_ID'];
	$conn->query("delete from tblstudent where S_ID='".$sID."'");
	$conn->query("delete from tblstuddetails where STU_ID='".$sID."'");
	echo "Success";
?>