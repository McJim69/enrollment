<?php

require_once("includes/initialize.php");	
require_once("header.php");	

// GET Post Primary Details
$STIDNO  = $_POST['sIDN'];
$STTYPE  = $_POST['sType'];
$COURSE  = $_POST['sCourse'];
$SEMEST  = $_POST['sSemes'];
$SLEVEL  = $_POST['sLevel'];
$SSYEAR  = $_POST['sYear'];
$CBLOCK  = $_POST['block'];
$SFNAME  = $_POST['fName'];
$SLNAME  = $_POST['lName'];
$SMNAME  = $_POST['mName'];
$STATUS  = $_POST['cStatus'];
$BDAY    = $_POST['bDay'];
$BPLACE  = $_POST['bPlace'];
$ETHNIC  = $_POST['sEthnic'];
$EMAIL   = $_POST['sEmail'];
$CONTACT = $_POST['sContact'];
$GENDER  = $_POST['sGender'];
$HEIGHT  = $_POST['sHeight'];
$WEIGHT  = $_POST['sWeight'];
$RADRES  = $_POST['rAddress'];
$PADRES  = $_POST['pAddress'];
$ELSCHNA = $_POST['elSchool'];
$ELGRADT = $_POST['elGradtd'];
$ELHONOR = $_POST['elHonors'];
$JRSCHNA = $_POST['jrSchool'];
$JRGRADT = $_POST['jrGradtd'];
$JRHONOR = $_POST['jrHonors'];
$SRSCHNA = $_POST['srSchool'];
$SRGRADT = $_POST['srGradtd'];
$SRHONOR = $_POST['srHonors'];

// INSERT DBTable Primary Details   
$student = new Student();
$student->S_IDD		  = $STIDNO;
$student->S_TYPE	  =	$STTYPE;
$student->COURSE	  =	$COURSE;
$student->SEMESTER	  =	$SEMEST;
$student->YEAR_LEVEL  =	$SLEVEL;
$student->SCHOOL_YEAR =	$SSYEAR;
$student->CLASS_BLOCK =	$CBLOCK;
$student->LNAME		  =	$SLNAME;
$student->FNAME		  =	$SFNAME;
$student->MNAME		  =	$SMNAME;
$student->STATUS	  =	$STATUS;
$student->BDAY		  =	$BDAY;
$student->BPLACE 	  = $BPLACE;
$student->ETHNICITY	  =	$ETHNIC;
$student->EMAIL		  =	$EMAIL;
$student->CONTACT_NO  =	$CONTACT;
$student->GENDER	  =	$GENDER;
$student->HEIGHT 	  =	$HEIGHT;
$student->WEIGHT 	  =	$WEIGHT;
$student->RES_ADDRESS =	$RADRES;
$student->PER_ADDRESS =	$PADRES;
$student->ELS_SCHOOL  =	$ELSCHNA;
$student->ELS_GRADTD  =	$ELGRADT;
$student->ELS_HONORS  =	$ELHONOR;
$student->JUN_SCHOOL  =	$JRSCHNA;
$student->JUN_GRADTD  =	$JRGRADT;
$student->JUN_HONORS  =	$JRHONOR;
$student->SEN_SCHOOL  =	$SRSCHNA;
$student->SEN_GRADTD  =	$SRGRADT;
$student->SEN_HONORS  =	$SRHONOR;

// GET POST Secondary Details
$FLASTNAME = $_POST['flName'];
$FFRSTNAME = $_POST['ffName'];
$FMDLENAME = $_POST['fmName'];
$FOCCUPATN = $_POST['fOccup'];
$FEMPLOYER = $_POST['fEmploym'];
$FBADDRESS = $_POST['fAddress'];
$FMOSALARY = $_POST['fmSalary'];
$FCONTACTN = $_POST['fContact'];
$FOTINCOME = $_POST['fOtherIn'];
$MLASTNAME = $_POST['mlName'];
$MFRSTNAME = $_POST['mfName'];
$MMDLENAME = $_POST['mmName'];
$MOCCUPATN = $_POST['mOccup'];
$MEMPLOYER = $_POST['mEmploym'];
$MBADDRESS = $_POST['mAddress'];
$MMOSALARY = $_POST['mmSalary'];
$MCONTACTN = $_POST['mContact'];
$MOTINCOME = $_POST['mOtherIn'];
$GLASTNAME = $_POST['glName'];
$GFRSTNAME = $_POST['gfName'];
$GMDLENAME = $_POST['gmName'];
$GOCCUPATN = $_POST['gOccup'];
$GEMPLOYER = $_POST['gEmploym'];
$GBADDRESS = $_POST['gAddress'];
$GMOSALARY = $_POST['gmSalary'];
$GCONTACTN = $_POST['gContact'];
$GRELATION = $_POST['gRelated'];

//INSERT DBTable Secondary Details
$studdetails = new Student_details();
$studdetails->STU_ID 	 = $STIDNO;
$studdetails->FA_LNAME	 = $FLASTNAME;
$studdetails->FA_FNAME	 = $FFRSTNAME;
$studdetails->FA_MNAME	 = $FMDLENAME;
$studdetails->FA_OCCUP	 = $FOCCUPATN;
$studdetails->FA_EMPLOYM = $FEMPLOYER;
$studdetails->FA_ADDRESS = $FBADDRESS;
$studdetails->FA_MSALARY = $FMOSALARY;
$studdetails->FA_CONTACT = $FCONTACTN;
$studdetails->FA_OINCOME = $FOTINCOME;
$studdetails->MO_LNAME	 = $MLASTNAME;
$studdetails->MO_FNAME	 = $MFRSTNAME;
$studdetails->MO_MNAME	 = $MMDLENAME;
$studdetails->MO_OCCUP	 = $MOCCUPATN;
$studdetails->MO_EMPLOYM = $MEMPLOYER;
$studdetails->MO_ADDRESS = $MBADDRESS;
$studdetails->MO_MSALARY = $MMOSALARY;
$studdetails->MO_CONTACT = $MCONTACTN;
$studdetails->MO_OINCOME = $MOTINCOME;
$studdetails->GD_LNAME	 = $GLASTNAME;
$studdetails->GD_FNAME	 = $GFRSTNAME;
$studdetails->GD_MNAME	 = $GMDLENAME;
$studdetails->GD_OCCUP	 = $GOCCUPATN;
$studdetails->GD_EMPLOYM = $GEMPLOYER;
$studdetails->GD_ADDRESS = $GBADDRESS;
$studdetails->GD_MSALARY = $GMOSALARY;
$studdetails->GD_CONTACT = $GCONTACTN;
$studdetails->GD_RELATED = $GRELATION;

$insert=$student->create(); 
$insert=$studdetails->create();

	if($insert==TRUE){
		echo"<script>alert('New student added successfully!'); 
		window.location='studentView.php'</script>";
	}else{
		$error = check_message();
	}
?>

<div class="container" data-aos="fade-up" style="text-align:center">
	<img src="assets/img/error.png" height="250"><br><br>
	<h3 class='text-primary'>Something went wrong :</h3>
	<h4 class='text-danger text-center'>

	<?php echo $error; ?>

	</h4>
	<h4>PLEASE TRY AGAIN</h4>

	<h7 class="text-uppercase">Need help? Check us on Facebook</h7>
	<h6 class="text-primary">
		<i class="icofont-facebook"></i><a href="https://www.facebook.com/jcmcyberworks">www.facebook.com/jcmcyberworks</a>
	</h6><br>
	<h1 class="text-primary"><button style="font-size:20px" class="btn btn-success" onclick="history.back()">Retry</button></h1>
</div>

<?php require("footer.php")?>