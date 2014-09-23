	</div>
	<footer>
 
 
	</footer>
    <script src = 'js/jquery.js' type = 'text/javascript'></script>
    <script src = 'js/posts.js' type = 'text/javascript'></script>
    <script src = 'js/ads.js' type = 'text/javascript'></script>
    <script src = 'js/communities.js' type = 'text/javascript'></script>
    <script src = 'js/messages.js' type = 'text/javascript'></script>
    <script src = "js/bootstrap.js" type = 'text/javascript'></script>
	
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
	
	<?php }?>
	

</body>
</html>