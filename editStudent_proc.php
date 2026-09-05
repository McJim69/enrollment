<?php 
	require_once("connect.php");

	$sID = $_GET['id'];

	if (isset($_POST['submit'])){
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

		$update = $conn->query("UPDATE tblstudent set
			S_ID		= '$STIDNO',
			S_TYPE	    = '$STTYPE',
			COURSE	    = '$COURSE',
			SEMESTER	= '$SEMEST',
			YEAR_LEVEL  = '$SLEVEL',
			SCHOOL_YEAR = '$SSYEAR',
			CLASS_BLOCK = '$CBLOCK',
			LNAME		= '$SLNAME',
			FNAME		= '$SFNAME',
			MNAME		= '$SMNAME',
			STATUS	    = '$STATUS',
			BDAY		= '$BDAY',
			BPLACE 	    = '$BPLACE',
			ETHNICITY	= '$ETHNIC',
			EMAIL		= '$EMAIL',
			CONTACT_NO  = '$CONTACT',
			GENDER	    = '$GENDER',
			HEIGHT 	    = '$HEIGHT',
			WEIGHT 	    = '$WEIGHT',
			RES_ADDRESS = '$RADRES',
			PER_ADDRESS = '$PADRES',
			ELS_SCHOOL  = '$ELSCHNA',
			ELS_GRADTD  = '$ELGRADT',
			ELS_HONORS  = '$ELHONOR',
			JUN_SCHOOL  = '$JRSCHNA',
			JUN_GRADTD  = '$JRGRADT',
			JUN_HONORS  = '$JRHONOR',
			SEN_SCHOOL  = '$SRSCHNA',
			SEN_GRADTD  = '$SRGRADT',
			SEN_HONORS  = '$SRHONOR' 
		WHERE S_ID = '$sID'");

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

		$update = $conn->query("UPDATE tblstuddetails set
			STU_ID 	   = '$STIDNO',
			FA_LNAME   = '$FLASTNAME',
			FA_FNAME   = '$FFRSTNAME',
			FA_MNAME   = '$FMDLENAME',
			FA_OCCUP   = '$FOCCUPATN',
			FA_EMPLOYM = '$FEMPLOYER',
			FA_ADDRESS = '$FBADDRESS',
			FA_MSALARY = '$FMOSALARY',
			FA_CONTACT = '$FCONTACTN',
			FA_OINCOME = '$FOTINCOME',
			MO_LNAME   = '$MLASTNAME',
			MO_FNAME   = '$MFRSTNAME',
			MO_MNAME   = '$MMDLENAME',
			MO_OCCUP   = '$MOCCUPATN',
			MO_EMPLOYM = '$MEMPLOYER',
			MO_ADDRESS = '$MBADDRESS',
			MO_MSALARY = '$MMOSALARY',
			MO_CONTACT = '$MCONTACTN',
			MO_OINCOME = '$MOTINCOME',
			GD_LNAME   = '$GLASTNAME',
			GD_FNAME   = '$GFRSTNAME',
			GD_MNAME   = '$GMDLENAME',
			GD_OCCUP   = '$GOCCUPATN',
			GD_EMPLOYM = '$GEMPLOYER',
			GD_ADDRESS = '$GBADDRESS',
			GD_MSALARY = '$GMOSALARY',
			GD_CONTACT = '$GCONTACTN',
			GD_RELATED = '$GRELATION' 
		WHERE STU_ID = '$sID'");

		if($update==TRUE){
			header('location:viewStudent.php?id='.$sID.'');
		}else{
			echo mysqli_error($conn);
		}
	}
?>