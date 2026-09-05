<br>
<div id="footer" style="position:fixed; bottom:0;right:0;left:0;width:100%;background:#313131;padding:10px; 0 10px 0">
	<footer style="color:#bbb">
        <div align="center">
			<!--&copy; <b>2020-<span id="year"> </span></b>-->
			West Prime Horizon Institute, Inc |
			<a href="https://www.facebook.com/WestPrimeOfficial" target="_blank"> Facebook </a> | Powered by 
			<a href="https://www.mcjim-server.net" target="_blank">McJim Cyberworks</a>
			<a style="color: #fff;" href="#!" role="button"><i class="fab fa-facebook-f fa-lg"></i></a> Project by Team <a href="https://www.facebook.com/janeth.pepito.5" target="_blank">Janeth Pepito</a> 
		</div>
         <script type="text/javascript" src="assets/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
         <script src="assets/js/tooltip.js"></script>
		 <script src="assets/js/jquery.js"></script>
	     <script src="assets/js/bootstrap.min.js"></script>
		 <script src="assets/js/popover.js"></script>
		 <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		 <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
    
	<script>
		document.getElementById("year").innerHTML = new Date().getFullYear();
	</script>

    <script type="text/javascript">

	$('.form_curdate').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_bdatess').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>
<script>
  function checkall(selector)
  {
    if(document.getElementById('chkall').checked==true)
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=true;
      }
    }
    else
    {
      var chkelement=document.getElementsByName(selector);
      for(var i=0;i<chkelement.length;i++)
      {
        chkelement.item(i).checked=false;
      }
    }
  }
  </script>			
	
	</footer>
</div>

      </div>
<!--/.container-->
</body>
</html>