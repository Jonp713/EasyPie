<?php
include 'core/init.php';
active_protect($_GET['c']);

include 'includes/overall/header.php';

?>

<?php 


if($_SESSION['seen_ad'] == 0){

	include 'includes/content/fullpagead.php';
	
	$_SESSION['seen_ad'] = 1;
}


echo('<span class = "communityother pull-left col-xs-12 col-sm-3">');

include 'includes/content/communityinfo.php';

include 'includes/widgets/submitpost.php';

include 'includes/widgets/subscribe.php';

if(hole_is_active($_GET['c'])){

	echo('<span class ="hidden-xs"><a href="hole.php?c='.$_GET['c'].'" class="btn btn-custom btn-lg btn-block">ENTER THE HOLE</a></span>');

}

echo('</span>');

echo('<span class = "communityother pull-right col-xs-12 col-sm-3">');

include 'includes/content/displaymoderator.php';

echo("<br>");


echo('<span class = "adminposts">');

include 'includes/content/adminposts.php';

echo('</span>');

if($_GET['c'] == "Hampy"){

	//$adid = get_random_ad(2);

	//display_side_ad($adid);

	//increment_display_count($adid);	
		
}


echo('</span>');

echo('<span class = "postfeed pull-left col-xs-12 col-sm-6">');

echo('<span class = "hidden-sm hidden-md hidden-lg">');

echo('</span>');

include 'includes/content/displayposts.php';

echo('</span>');

include 'includes/content/sharedpost.php';

?>




	</div></div></div>
	<footer>
 <center>
<span style = "padding-bottom:6px" class = "col-xs-12"> &copy; 2014 ICU-5 Connections LLC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = "mailto:contact@icu.university">Contact</a></span>
</center>
 
	</footer>
  
    <script src = 'js/jquery.js' type = 'text/javascript'></script>
	
	<script>
	
		$('[data-toggle="tooltip"]').tooltip({
		    'placement': 'bottom'
		});
		$('[data-toggle="popover"]').popover({
		    trigger: 'hover',
		        'placement': 'right'
		});

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
	
	<?php }?>
	

</body>
</html>