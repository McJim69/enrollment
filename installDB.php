<?php 
$dbhost = 'localhost';
$dbuser = 'McJim';
$dbpass = 'McJim654123';
	
$mysqli = new mysqli($dbhost, $dbuser, $dbpass);  

$drp = $mysqli->query("DROP DATABASE wpenrolldb");
$crt = $mysqli->query("CREATE DATABASE wpenrolldb");
$use = $mysqli->query("USE wpenrolldb");
	
$mysqli->query("CREATE TABLE IF NOT EXISTS `ay` (
	`AY_ID` int(11) NOT NULL AUTO_INCREMENT,
	`ACADYR` varchar(40) NOT NULL,
	 PRIMARY KEY (`AY_ID`),
	 UNIQUE KEY `acadyr` (`ACADYR`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `class` (
	`CLASS_ID` int(11) NOT NULL AUTO_INCREMENT,
	`CLASS_CODE` varchar(30) NOT NULL,
	`SUBJ_ID` int(11) NOT NULL,
	`INST_ID` int(11) NOT NULL,
	`SYID` int(11) NOT NULL,
	`DAY` varchar(20) NOT NULL,
	`TIME` time NOT NULL,
	`IDNO` int(11) NOT NULL,
	 PRIMARY KEY (`CLASS_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `course` (
	`COURSE_ID` int(11) NOT NULL AUTO_INCREMENT,
	`COURSE_NAME` varchar(30) NOT NULL,
	`COURSE_LEVEL` int(11) NOT NULL DEFAULT '1',
	`COURSE_MAJOR` varchar(30) NOT NULL DEFAULT '',
	`COURSE_DESC` varchar(255) NOT NULL,
	`DEPT_ID` int(11) NOT NULL,
	 PRIMARY KEY (`COURSE_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `department` (
	`DEPT_ID` int(11) NOT NULL AUTO_INCREMENT,
	`DEPARTMENT_NAME` varchar(30) NOT NULL,
	`DEPARTMENT_DESC` varchar(50) NOT NULL,
	 PRIMARY KEY (`DEPT_ID`))");
   
$mysqli->query("INSERT INTO `department` (`DEPT_ID`, `DEPARTMENT_NAME`, `DEPARTMENT_DESC`) VALUES
	(1, 'ITD', 'Information Technology Department'),
	(2, 'TED', 'Teachers Education Department'),
	(3, 'ATD', 'Academic Track Department'),
	(4, 'SHS', 'Senior High School Department'),
	(5, 'VTD', 'Vocational & Technical Department')");

$mysqli->query("CREATE TABLE IF NOT EXISTS `grades` (
	`GRADE_ID` int(11) NOT NULL AUTO_INCREMENT,
	`IDNO` int(11) NOT NULL,
	`SUBJ_ID` int(11) NOT NULL,
	`INST_ID` int(11) NOT NULL,
	`SYID` int(30) NOT NULL,
	`PRE` int(11) NOT NULL,
	`MID` int(11) NOT NULL,
	`FIN` int(11) NOT NULL,
	`FIN_AVE` int(11) NOT NULL,
	`REMARKS` text NOT NULL,
	 PRIMARY KEY (`GRADE_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `instructor` (
	`INST_ID` int(30) NOT NULL AUTO_INCREMENT,
	`INST_FULLNAME` varchar(255) NOT NULL,
	`INST_ADDRESS` varchar(255) NOT NULL,
	`INST_SEX` varchar(20) NOT NULL DEFAULT 'Male',
	`INST_STATUS` varchar(20) NOT NULL DEFAULT 'Single',
	`SPECIALIZATION` text NOT NULL,
	`INST_EMAIL` varchar(255) NOT NULL,
	`EMPLOYMENT_STATUS` varchar(40) NOT NULL DEFAULT 'Probationary',
	 PRIMARY KEY (`INST_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `level` (
	`YR_ID` int(11) NOT NULL AUTO_INCREMENT,
	`LEVEL` varchar(30) NOT NULL,
	`LEVEL_DESCRIPTION` varchar(255) NOT NULL,
	 PRIMARY KEY (`YR_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `major` (
	`MAJOR_ID` int(11) NOT NULL AUTO_INCREMENT,
	`MAJOR` varchar(30) NOT NULL,
	 PRIMARY KEY (`MAJOR_ID`))");

$mysqli->query("INSERT INTO `major` (`MAJOR_ID`, `MAJOR`) VALUES
	(1, 'English'),
	(2, 'General'),
	(3, 'Science'),
	(4, 'Filipino'),
	(5, 'Math'),
	(6, 'Social'),
	(7, 'CHS'),
	(8, 'WAFT')");

$mysqli->query("CREATE TABLE IF NOT EXISTS `photo` (
	`PHOTO_ID` int(11) NOT NULL AUTO_INCREMENT,
	`FILENAME` text NOT NULL,
	`TYPE` varchar(30) NOT NULL,
	`SIZE` int(30) NOT NULL,
	`CAPTION` varchar(255) NOT NULL,
	`IDNO` int(11) NOT NULL,
	`MAIN` varchar(20) NOT NULL DEFAULT 'no',
	 PRIMARY KEY (`PHOTO_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `schoolyr` (
	`SYID` int(11) NOT NULL AUTO_INCREMENT,
	`COURSE_ID` int(11) NOT NULL,
	`SEMESTER` varchar(20) NOT NULL,
	`AY` varchar(30) NOT NULL,
	`IDNO` int(30) NOT NULL,
	`CATEGORY` varchar(30) NOT NULL DEFAULT 'RESERVED',
	`DATE_RESERVED` datetime NOT NULL,
	`DATE_ENROLLED` datetime NOT NULL,
	`STATUS` varchar(30) NOT NULL DEFAULT 'New',
	 PRIMARY KEY (`SYID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `semester` (
	`SEM_ID` int(11) NOT NULL AUTO_INCREMENT,
	`SEM` varchar(15) NOT NULL DEFAULT 'First',
	 PRIMARY KEY (`SEM_ID`))");

$mysqli->query("INSERT INTO `semester` (`SEM_ID`, `SEM`) VALUES
	(1, 'First'),
	(2, 'Second'),
	(3, 'Summer')");

$mysqli->query("CREATE TABLE IF NOT EXISTS `subject` (
	`SUBJ_ID` int(11) NOT NULL AUTO_INCREMENT,
	`SUBJ_CODE` varchar(30) NOT NULL,
	`SUBJ_DESCRIPTION` varchar(255) NOT NULL,
	`UNIT` int(2) NOT NULL,
	`PRE_REQUISITE` varchar(30) NOT NULL DEFAULT 'None',
	`COURSE_ID` int(11) NOT NULL,
	`AY` varchar(30) NOT NULL,
	`SEMESTER` varchar(20) NOT NULL,
	PRIMARY KEY (`SUBJ_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `tblrequirements` (
	`REQ_ID` int(30) NOT NULL AUTO_INCREMENT,
	`NSO` varchar(5) NOT NULL DEFAULT 'no',
	`BAPTISMAL` varchar(5) NOT NULL DEFAULT 'no',
	`ENTRANCE_TEST_RESULT` varchar(5) NOT NULL DEFAULT 'no',
	`MARRIAGE_CONTRACT` varchar(5) NOT NULL DEFAULT 'no',
	`CERTIFICATE_OF_TRANSFER` varchar(5) NOT NULL DEFAULT 'no',
	`IDNO` int(20) NOT NULL,
	 PRIMARY KEY (`REQ_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `tblstuddetails` (
	`DETAIL_ID` int(11) NOT NULL AUTO_INCREMENT,
	`FATHER` varchar(255) NOT NULL,
	`FATHER_OCCU` varchar(255) NOT NULL,
	`MOTHER` varchar(255) NOT NULL,
	`MOTHER_OCCU` varchar(255) NOT NULL,
	`BOARDING` varchar(5) NOT NULL DEFAULT 'no',
	`WITH_FAMILY` varchar(5) NOT NULL DEFAULT 'yes',
	`GUARDIAN` varchar(255) NOT NULL,
	`GUARDIAN_ADDRESS` varchar(255) NOT NULL,
	`OTHER_PERSON_SUPPORT` varchar(255) NOT NULL,
	`ADDRESS` text NOT NULL,
	`IDNO` int(30) NOT NULL,
	PRIMARY KEY (`DETAIL_ID`))");

$mysqli->query("CREATE TABLE IF NOT EXISTS `tblstudent` (
	`S_ID` int(11) NOT NULL AUTO_INCREMENT,
	`IDNO` int(20) NOT NULL,
	`FNAME` varchar(40) NOT NULL,
	`LNAME` varchar(40) NOT NULL,
	`MNAME` varchar(40) NOT NULL,
	`SEX` varchar(10) NOT NULL DEFAULT 'Male',
	`BDAY` date NOT NULL,
	`BPLACE` text NOT NULL,
	`STATUS` varchar(30) NOT NULL,
	`AGE` int(30) NOT NULL,
	`NATIONALITY` varchar(40) NOT NULL,
	`RELIGION` varchar(255) NOT NULL,
	`CONTACT_NO` varchar(40) NOT NULL,
	`HOME_ADD` text NOT NULL,
	`EMAIL` varchar(255) NOT NULL,
	 PRIMARY KEY (`S_ID`),
	 UNIQUE KEY `IDNO` (`IDNO`))");
 
$mysqli->query("CREATE TABLE IF NOT EXISTS `useraccounts` (
	`ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT,
	`ACCOUNT_NAME` varchar(255) NOT NULL,
	`ACCOUNT_USERNAME` varchar(255) NOT NULL,
	`ACCOUNT_PASSWORD` text NOT NULL,
	`ACCOUNT_TYPE` varchar(30) NOT NULL,
	 PRIMARY KEY (`ACCOUNT_ID`),
	 UNIQUE KEY `ACCOUNT_USERNAME` (`ACCOUNT_USERNAME`))");
	 
$mysqli->query("INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`) VALUES
	(1, 'Admin Account', 'admin@westprime.com', 'admin', 'Administrator'),
	(2, 'Regisrar Account', 'registrar@westprime.com', 'registrar', 'Registrar'),
	(3, 'Student Account', 'student@westprime.com', 'student', 'Student'),
	(4, 'Encoder Account', 'encoder@westprime.com', 'encoder', 'Encoder')");

$mysqli->query("CREATE TABLE IF NOT EXISTS `validity` (
	`validity` date DEFAULT NULL)");

$mysqli->query("INSERT INTO `validity` (`validity`) VALUES ('2025-06-20')");
	
	if($mysqli===false){
		echo"<script>alert('OH NO!! Your database failed to INSTALL!');
		window.location.href = 'home.php';</script>";
	}else{		
		echo"<script>alert('CONGRATS! Your database successfuly... REINSTALLED!');
		window.location.href = 'home.php';</script>";		
	}   
?>
