<?php	
	require_once("includes/initialize.php");
	include 'header.php';
	include("menu_student.php");
?>
 
<?php

$sID = $_GET['id'];
$SY = $_GET['SY'];

$subjectId = $_POST['selector'];
$subjId = count($subjectId);

if (!$subjectId==''){
echo $selector , $selector;
$mydb->setQuery("SELECT * FROM `schoolyr` WHERE `AY` ='{$SY}' AND `IDNO`='{$sID}'");
$res = $mydb->loadSingleResult();

//echo $res->SYID . '<br/>';
for ($i=0;$i<$subjId; $i++){

//echo $i;

// 	$mydb->setQuery("SELECT * FROM `class` WHERE `SUBJ_ID`='{$subjectId[$i]}'");
// 	$res = $mydb->loadResultlist();
// 	 foreach ($res as $key => $value) {
// 	 	# code...  
// 	 	echo $classId = $value->CLASS_ID;

// 	 	if ($classId==''){
// 	 			$mydb->setQuery("SELECT  * 
// 					FROM  `subject` s ,`course` c 
// 					WHERE  s.`COURSE_ID`=c.`COURSE_ID` AND SUBJ_ID='{$subjectId[$i]}'");
// 				$cur = $mydb->loadResultlist();
// 				foreach ($cur as  $result) {
// 				$grades = New Grades();
// 				$grades->SUBJ_ID			=	$result->SUBJ_ID;
// 				$grades->IDNO				=	$sID;
// 				$grades->INST_ID			=	'NONE';
// 				$grades->SYID				=	$res->SYID;
// 				$grades->PRE				=	'NONE';
// 				$grades->MID				=	'NONE';
// 				$grades->FIN				=	'NONE';
// 				$grades->FIN_AVE			=	'NONE';
// 				$grades->DAY				=	'NONE';
// 				$grades->G_TIME				=	'NONE';
// 				$grades->REMARKS			=	'NONE';
// 				$grades->create();
// 		}	 	
// 	 	}else{

// 	 	$grades = New Grades();
// 		$grades->SUBJ_ID			=	$value->SUBJ_ID;
// 		$grades->IDNO				=	$sID; 
// 		$grades->SYID				=	$res->SYID;		 
// 		$grades->update($classId);
	 	
// 	 	}

 


// 	 }

// }




	$mydb->setQuery("SELECT  * 
					FROM  `subject` s ,`course` c 
					WHERE  s.`COURSE_ID`=c.`COURSE_ID` AND SUBJ_ID='{$subjectId[$i]}'");
	$cur = $mydb->loadResultlist();

	foreach ($cur as  $result) {
  
 		$grades = New Grades();
		$grades->SUBJ_ID			=	$result->SUBJ_ID;
		$grades->IDNO				=	$sID;
		$grades->INST_ID			=	'NONE';
		$grades->SYID				=	$res->SYID;
		$grades->PRE				=	'NONE';
		$grades->MID				=	'NONE';
		$grades->FIN				=	'NONE';
		$grades->FIN_AVE			=	'NONE';
		$grades->DAY				=	'NONE';
		$grades->G_TIME				=	'NONE';
		$grades->REMARKS			=	'NONE';
		$grades->create();
	}
message("Student's subjects already Added!","info");
	redirect('studentAddsubjects.php?id='.$sID.'');
 
}
}else{
	message("Select first the subject(s) you want to Add!","error");
	redirect('studentAssignsubjects.php?id='.$sID.'');
}

?>
