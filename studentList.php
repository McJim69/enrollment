<?php
	require_once("includes/initialize.php");
	include "header.php";

	include("menu.php");
	
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
</style>

<script>setActive("entry");</script>

<div class="container" style="margin-top: 20px;">
	<!-- Search & Filter Bar -->
	<form method="post" enctype="multipart/form-data">
		<div class="enroll-card" style="padding: 14px 20px;">
			<div class="filter-bar-container" style="display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;">
				<!-- Left: Search Input -->
				<div style="flex:1; min-width:220px;">
					<div class="input-group">
						<span class="input-group-addon"><i class="fas fa-search text-muted"></i></span>
						<input type="text" class="form-control" placeholder="Search student name, ID, or email..." name="t_search" id="t_search" value="<?php if($_POST["t_search"]!=""){echo $_POST["t_search"];} ?>">
					</div>
				</div>

				<!-- Center: Filter Dropdowns -->
				<div style="display:flex; gap:8px; align-items:center;">
					<select class="form-control" style="width:auto; min-width:120px;" onchange="if(this.value=='Course')jump('studentList.php'); else jump('studentList.php?course='+this.value+'&semester=<?php echo $_GET["semester"];?>')">
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

					<select class="form-control" style="width:auto; min-width:120px;" onchange="jump('?course=<?php echo $_GET["course"];?>&semester='+this.value)">
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

				<!-- Right: Action Buttons -->
				<div style="display:flex; gap:8px; align-items:center;">
					<button type="submit" name="b_search" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
					<button type="button" onclick="jump('studentList.php')" class="btn btn-outline-secondary"><i class="fas fa-sync-alt"></i> Reset</button>
					<a href="newStudent.php" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add Student</a>
				</div>
			</div>
		</div>
	</form>

	<!-- Table / Data Cards -->
	<div class="enroll-card" style="padding: 0; overflow: hidden;">
		<div class="enroll-card-header" style="padding: 18px 24px; margin-bottom: 0;">
			<h4 class="enroll-card-title"><i class="fas fa-user-graduate text-primary"></i> Student Directory</h4>
			<div>
				<?php require("pageNAV.php"); ?>
			</div>
		</div>

		<?php
			$val=ucwords(strtolower($value));
			if($_POST["t_search"]==$value){
				$rep="<b class='search-highlight'>$val</b>";
			}

			if ($ex->num_rows > 0) {
				echo "
				<div class='table-responsive'>
					<table class='table enroll-table enroll-table-responsive'>
						<thead>
							<tr>
								<th class='text-center' style='width: 50px;'>#</th>
								<th>ID Number</th>
								<th>Full Name</th>
								<th>Gender</th>
								<th>Birthdate</th>
								<th>Course</th>
								<th>Semester</th>
								<th>Year</th>
								<th class='text-right'>Actions</th>
							</tr>	
						</thead>
						<tbody>";

				while($rs=mysqli_fetch_array($ex)){
					$contn = $rs[0];
					$sIDNo = sprintf("%04d", $contn);
					
					$qc=$conn->query("SELECT * FROM course WHERE COURSE_ID='".$rs['COURSE']."'");
					$rc=mysqli_fetch_array($qc);

					if($rc["COURSE_LEVEL"]==1) { $level="1st Year"; }
					else if($rc["COURSE_LEVEL"]==2) { $level="2nd Year";}
					else if($rc["COURSE_LEVEL"]==3) { $level="3rd Year"; }
					else if($rc["COURSE_LEVEL"]==4) { $level="4th Year"; }
					else { $level = "N/A"; }
					
					$major = ($rc["COURSE_MAJOR"]=="None" || empty($rc["COURSE_MAJOR"])) ? "" : "(" . $rc["COURSE_MAJOR"] . ")";
					$sex = ($rs["GENDER"]=="M") ? "Male" : "Female";

					echo "<tr id='tr_".$rs[0]."'>";
					echo "<td data-label='#' class='text-center font-weight-bold'>".$i."</td>";
					echo "<td data-label='ID Number' onclick=\"jump('viewStudent.php?id=$rs[0]')\"><span class='badge-student-id font-weight-bold' style='font-size:12px; padding:6px 10px; border-radius:20px;'>".$sIDNo."</span></td>";
					echo "<td data-label='Full Name' onclick=\"jump('viewStudent.php?id=$rs[0]')\" class='font-weight-bold'>".str_replace($val,$rep,$rs["LNAME"]).", ".str_replace($val,$rep,$rs["FNAME"])." ".$rs["MNAME"]."</td>";
					echo "<td data-label='Gender'>".$sex."</td>";
					echo "<td data-label='Birthdate'>".$rs["BDAY"]."</td>";
					echo "<td data-label='Course'><span class='badge-status badge-status-active'>".$rc["COURSE_NAME"]." ".$major."</span></td>";
					echo "<td data-label='Semester'>".$rs["SEMESTER"]."</td>";
					echo "<td data-label='Year'>".$level."</td>";
					echo "<td data-label='Actions' class='text-right'>
						<div class='action-btn-group'>
							<a href='editStudent.php?id=$rs[0]' class='btn btn-xs btn-outline-primary' style='padding:4px 10px; display:inline-flex; align-items:center; gap:4px;' title='Edit Student'><i class='fas fa-edit'></i> Edit</a>
							<button onclick=\"deleteStudent('$rs[0]');\" class='btn btn-xs btn-outline-danger' style='padding:4px 8px; display:inline-flex; align-items:center;' title='Delete Student'><i class='fas fa-trash-alt'></i></button>
						</div>
					</td>";
					echo "</tr>";
					$i++;
				}
				echo "
						</tbody>
					</table>
				</div>";
			} else {
				echo "<div class='text-center py-5 text-muted'><i class='fas fa-folder-open' style='font-size:40px; opacity:0.3; margin-bottom:12px;'></i><h5>No matching student records found!</h5></div>";
			}
		?>
	</div>
</div>

<script>
	function deleteStudent(S_ID){	
		if(confirm("Are you sure you want to remove this Student record?")){
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText=="Success"){
						$("#tr_"+S_ID).animate({ opacity: 0 }, 500, function() { $(this).remove(); });
					} else {
						$("#tr_"+S_ID).animate({ opacity: 0 }, 500, function() { $(this).remove(); });
					}
				}
			}					
			xmlhttp.open("GET","deleteStudent.php?S_ID="+S_ID,true);
			xmlhttp.send();
		}
	}
</script>

<?php include("footer.php") ?>



