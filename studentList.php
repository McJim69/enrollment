<?php
	require_once("includes/initialize.php");
	include "header.php";

	if($_SESSION["ACCOUNT_TYPE"]=="Registrar"){
		include("menu_registrar.php");
	} 	
	else if($_SESSION["ACCOUNT_TYPE"]=="Encoder"){
		include("menu_encoder.php");
	} 
	else{
		include("menu.php");
	}
	
	$value=$_GET["value"];
				
	$cors="";
		if($_GET["course"]!="Course" && $_GET["course"]!="")
			$cors=" and COURSE='".$_GET["course"]."'";
		
	$seme="";
		if($_GET["semester"]!="Semester" && $_GET["semester"]!="")
			$seme=" and SEMESTER='".$_GET["semester"]."'";

	if(isset($_POST["b_search"])){
		$value=$_POST["t_search"];
	}

	$rec=20;
	$p=$_GET["page"];
	if($p>1){
		$to=$rec;
		$from=($p*$rec)-$rec;
		$i=(($p-1)*$rec)+1;
	}else{
		$to=$rec;
		$from=0;
		$i=1;
		$p=1;
	}
		
	$ex=$conn->query("SELECT * FROM tblstudent s WHERE 
		(s.S_ID   like'%".$value."%' or 
		 s.LNAME  like'%".$value."%' or
		 s.FNAME  like'%".$value."%' or 
		 s.MNAME  like'%".$value."%' or 
		 s.GENDER like'%".$value."%' or 
		 s.BDAY   like'%".$value."%' or
		 s.STATUS like'%".$value."%' or 
		 s.EMAIL  like'%".$value."%') $cors $seme order by lname LIMIT $from,$to ");	

	$ex1=$conn->query("SELECT * FROM tblstudent s WHERE 
		(s.S_ID   like'%".$value."%' or 
		 s.LNAME  like'%".$value."%' or
		 s.FNAME  like'%".$value."%' or 
		 s.MNAME  like'%".$value."%' or 
		 s.GENDER like'%".$value."%' or 
		 s.BDAY   like'%".$value."%' or
		 s.STATUS like'%".$value."%' or 
		 s.EMAIL  like'%".$value."%') $cors $seme order by lname");
	//
?>

<style>
	tr:hover{
		cursor:pointer;
	}

	.odd{
		background:#ffffff;
		color: #535353;
	}

	.even{
		background:#e2e2e2;
		color: #535353;
	}

	.even:hover, .odd:hover{
		background:#fff79d; 
		color:#9f0000;
	}
</style>

<script>setActive("entry");</script>

<form method="post" enctype="multipart/form-data">

<div class="container">
	<div class="row">
		<div class="col col-md-12">
			<div class="bg-primary" style="background:#428bca;padding:10px;border-radius:5px">
				<input type="text" class="btn btn-default" placeholder="Type a keyword" name="t_search" id="t_search" value="<?php if($_POST["t_search"]!=""){echo $_POST["t_search"];} ?>">
				<button type="submit" name="b_search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
				<button type="Reset" onclick="jump('studentList.php')" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
				<a href="newStudent.php" name="add" class="btn btn-default"> <span class="glyphicon glyphicon-plus"></span> Add</a>

				<select style="text-align:left" class="btn btn-light" onchange="if(this.value=='Course')jump('studentList.php'); else jump('studentList.php?course='+this.value+'&semester=<?php echo $_GET["semester"];?>')">
					<option>Course</option>
					<?php
						$ex2=$conn->query("select COURSE from tblstudent where SEMESTER='".$_GET["semester"]."' group by COURSE order by COURSE")or die(mysqli_error($conn));		
						if($_GET["semester"]=="" || $_GET["semester"]=="Semester")							
						$ex2=$conn->query("select COURSE from tblstudent group by COURSE order by COURSE")or die(mysqli_error($conn));																	
						while($rs=mysqli_fetch_array($ex2)){
							echo "<option ";
						if($_GET["course"]===$rs[0])
							echo "selected";
							echo">$rs[0]</option>";
						}
					?>
				</select>
				<select style="text-align:left" class="btn btn-light" onchange="jump('?course=<?php echo $_GET["course"];?>&semester='+this.value)">
					<option>Semester</option>
					<?php
						$ex2=$conn->query("select SEMESTER from tblstudent where COURSE='".$_GET["course"]."' group by SEMESTER order by SEMESTER")or die(mysqli_error($conn));
						if($_GET["course"]=="" || $_GET["course"]=="Course")
						$ex2=$conn->query("select SEMESTER from tblstudent group by SEMESTER order by SEMESTER")or die(mysqli_error($conn));										
						while($rs=mysqli_fetch_array($ex2)){
							echo "<option ";
						if($_GET["semester"]===$rs[0])
							echo "selected";
							echo">$rs[0]</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="col col-md-12">
			<div style="margin-top:-10px;background:#428bca;padding:10px;border-radius:5px">
				<?php require("pageNAV.php");?>
			</div>
		</div>
	</div>	
</div>

</form>

<div class="container">	
	<div class="well" style="margin-top:15px">
		<?php
			$val=ucwords(strtolower($value));

			if($_POST["t_search"]==$value){
				$rep="<b style='color:#0014d0;background:#ffa0a0'>$val</b>";
			}

			if ($ex->num_rows > 0) {

			echo"
			<table class='table' style='margin-bottom:0;margin-top:-15px'><caption><h4 align='left'>LIST OF STUDENTS</h4></caption>
				<thead style='background:#428bca;color:#fff'>
					<tr>
						<th style='text-align:center'>#</th>
						<th>IDNo.</th>
						<th>Fullname</th>
						<th>Gender</th>
						<th>Birth</th>
						<th>Course</th>
						<th>Semester</th>
						<th>Year</th>
						<th>Action</th>
					</tr>	
				</thead>
				<tbody>";

				while($rs=mysqli_fetch_array($ex)){
					$contn = $rs[0];
					$sIDNo = sprintf("%04d", $contn);
					
					$qc=$conn->query("SELECT * FROM course WHERE COURSE_ID='".$rs['COURSE']."'");
					$rc=mysqli_fetch_array($qc);

					if($rc["COURSE_LEVEL"]==1) { $level="1st"; }
					if($rc["COURSE_LEVEL"]==2) { $level="2nd";}
					if($rc["COURSE_LEVEL"]==3) { $level="3rd"; }
					if($rc["COURSE_LEVEL"]==4) { $level="4th"; }
					
					if($rc["COURSE_MAJOR"]=="None"){ $major=""; } else { $major=$rc["COURSE_MAJOR"];}

					if($rs["GENDER"]=="M")$sex="Male"; else $sex="Female";

					$cls = "style='height:20px;padding:3px' onclick=\"jump('viewStudent.php?id=$rs[0]')\"";
					
					if($i%2==0) echo"<tr class='odd' id='tr_".$rs[0]."' >"; else echo"<tr class='even' id='tr_".$rs[0]."'>";
					
					echo"<td style='height:20px;padding:3px;text-align:center'><b>".$i."</b></td>";
					echo"<td $cls>".$sIDNo."</td>";
					echo"<td $cls>".str_replace($val,$rep,$rs["LNAME"])." ".str_replace($val,$rep,$rs["FNAME"])." ".$rs["MNAME"]."</td>";
					echo"<td $cls>".$sex."</td>";
					echo"<td $cls>".$rs["BDAY"]."</td>";
					echo"<td $cls>".$rc["COURSE_NAME"]."-".$rc["COURSE_LEVEL"]." ".$major."</td>";
					echo"<td $cls>".$rs["SEMESTER"]."</td>";
					echo"<td $cls>".$level."</td>";
					echo"
						<td style='height:20px;padding:3px'><a href='editStudent.php?id=$rs[0]'>
							<input type=image src='img/_edit.png' style='height:20px;padding:0' title='Edit'/></a> &nbsp; 
							<input onclick=\"deleteStudent('$rs[0]');\" type=image src='img/_delete.png' style='margin-bottom:-3px;height:25px;padding:0' title='Delete'/>
						</td>";
					$i++;
				} 
				
				}else{
					echo"<h4 class='text-danger'>No records found!</h4>";
				}
			echo"
			</tbody>
		</table>";
		?>
	</div>
</div>

<script>
	function deleteStudent(S_ID){	
		if(confirm("Are you sure you want to Remove this Student?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#tr_"+S_ID).animate({
					opacity:0
					},500);
				}else{
					alert(xmlhttp.responseText);
					}
					$("#tr_"+S_ID).animate({
					opacity:0
					},500);
				}
			}					
			xmlhttp.open("GET","deleteStudent.php?S_ID="+S_ID,true);
			xmlhttp.send();
		}
	}
</script>

<?php include("footer.php") ?>



