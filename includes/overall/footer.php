	</div></div></div>
	<footer>
		
 <center>
<!--<span style = "padding-bottom:6px" class = "col-xs-12"> &copy; 2014 ICU-5 Connections LLC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = "mailto:contact@icu.university">Contact</a></span>-->
</center>
 
	</footer>
  
    <script src = 'js/jquery.js' type = 'text/javascript'></script>
    <script src = 'js/posts.js' type = 'text/javascript'></script>
    <script src = 'js/bla.js' type = 'text/javascript'></script>
    <script src = 'js/communities.js' type = 'text/javascript'></script>
    <script src = 'js/messages.js' type = 'text/javascript'></script>
    <script src = "js/bootstrap.js" type = 'text/javascript'></script>
    <script src = "js/sidebar.js" type = 'text/javascript'></script>
	<?php include 'js/servicesjs.php' ?>		
    <script src = "js/comments.js" type = 'text/javascript'></script>	
    <script src = "js/points.js" type = 'text/javascript'></script>	
    <script src = "js/users.js" type = 'text/javascript'></script>		
    <script src = "js/mods.js" type = 'text/javascript'></script>	
	
	
	<script>
	
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();
		$('[data-toggle="tooltip"]').tooltip({ container: 'body' });

	</script>
	
	<?php if(empty($_GET['share']) == false){?>
	
	<script type = "text/javascript">

		$('#sharepostmodal').modal('show');
		
	</script>
	
	<?php }?>
	
	
	<?php if(!$session_local){?>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-42122616-2', 'auto');
	  ga('send', 'pageview');

	</script>
	
	<?php }?>
	
	<?php if(isset($_GET['s'])){ ?>
	
		<script type = "text/javascript">
		
				$("#topalert").html('<span class="alert alert-success" role="alert"><span class = ""></span> &nbsp;&nbsp;Your Post Has Been Submitted For Approval</span>');
   
				$("#topalert").fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow");
				 });
			
		</script>
	
	<?php }
	
	
	if (logged_in() === true) {
		?>
	
		<script>
	
			var logged_in = true;
	
		</script>
	
		<?php
	
	}else{
	
	
		?>
	
		<script>
	
			var logged_in = false;
	
		</script>
	
		<?php
	}?>
	

</body>
</html>