<?php for($j=1;$j<=mysqli_num_rows($ex1)/$rec+1;$j++) ?>
	<div id="nav" style="margin:0;">
		<div style='border:0;background:transparent;padding:3px;display:block'></div>
		<div onclick="jump('?course=<?php echo $_GET["course"]; ?>&page=1&value=<?php echo $value."&semester=".$_GET["semester"];?>')">&laquo; first</div>
		<div style='border:0;background:transparent;padding:3px'></div>
		<div onclick="<?php if($_GET["page"]>1){echo "jump('?course=".$_GET["course"]."&page=".($_GET["page"]-1)."&value=$value&semester=".$_GET["semester"]."')";} ?>">&laquo; prev</div>
		<div style='border:0;background:transparent;padding:3px'></div>			
		<div>Showing Page: <?php echo $p." of ".number_format($j-1,0);?> Pages &nbsp;&nbsp;(Total: <b><?php echo number_format(mysqli_num_rows($ex1),0);?></b> Records)</div>
		<div style='border:0;background:transparent;padding:3px'></div>
		<div onclick="<?php if($_GET["page"]<$ex1->num_rows/$rec){echo "jump('?course=".$_GET["course"]."&page=";
		if($_GET["page"]=="")
			echo"2";   
		else
			echo ($_GET["page"]+1);
			echo"&value=$value&semester=".$_GET["semester"]."');";} ?>" >next &raquo;
		</div>
		<div style='border:0;background:transparent;padding:3px'></div>
		
		<div onclick="jump('?course=<?php echo $_GET["course"]; ?>&page=<?php echo (number_format($ex1->num_rows/$rec,0)); echo"&value=$value&semester=".$_GET["semester"]; ?>')">last &raquo;</div>
		<div style='border:0;background:transparent;padding:3px'></div>

		<div id="opt">Goto page #: 
			<select id='s_pn' onchange="jump('?course=<?php echo $_GET["course"]; ?>&page='+getID('s_pn').value+'&value=<?php echo $value."&semester=".$_GET["semester"]; ?>')" >
				<?php
					for($j=1;$j<=$ex1->num_rows/$rec+1;$j++){
					echo "<option ";
					if($_GET["page"]==$j)
					echo "selected";
					ECHO" >$j</option>";
					}
				?>
			</select>
		</div>
	</div>