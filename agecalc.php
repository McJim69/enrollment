<?php
	$birth = $cur->BDAY;
	$birthDate = $birth;
	$birthDate = explode("-", $birthDate);
	$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
?>