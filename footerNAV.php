<style>
.footnav{
	width:100%;
	padding:5px;
	position:fixed;
	left:0;
	bottom:0;
	background:#1e71ba;
	z-index:999;
}
.arrows{
	height:35px;
	width:35px;
	border-radius:35px;
	margin-top:5px;
	background:#1e67a8;		
}
.arrows:hover{
	background:#f6b024;
}
</style>

<!--FooterNAV-->
	<div class="footnav">
		<div style="padding:1px;text-align:center;" >
			<table style="margin:0 auto;">
				<tr style="background:transparent" >
					<td>
						<input class="arrows" type="image" value="Previous" src="assets/img/prev1.png" onclick="jump('?page=<?php echo ($_GET["page"]-1)."&municipality=".$_GET["municipality"];?>&course=<?php echo $_GET["course"];?>&semester=<?php echo $_GET["semester"];?>')">
					</td>
					<td>
						<select style='height:35px;padding:5px;margin:5px;text-align:center' id='s_pn' onchange="jump('?page='+this.value+'<?php echo "&municipality=".$_GET["municipality"];?>&course=<?php echo $_GET["course"];?>&semester=<?php echo $_GET["semester"];?>')">
						<option>Page</option>
						<?php
							for($j=1;$j<=mysqli_num_rows($ex1)/$rec+1;$j++){
								echo "<option ";
							if($_GET["page"]==$j)
								echo "selected";
								echo" >$j</option>";
							}
						?>
						</select>
					</td>
					<td>
						<input class="arrows" type="image" value="Next" src="assets/img/next1.png" onclick="jump('?page=<?php echo ($_GET["page"]+1)."&municipality=".$_GET["municipality"];?>&course=<?php echo $_GET["course"];?>&semester=<?php echo $_GET["semester"];?>')">
					</td>
				</tr>
			</table>
		</div>
	</div>
<!--EO FooterNAV-->