<?php
include 'core/init.php';

active_protect($_GET['c']);
has_hole($_GET['c']);
clear_old_posts($_GET['c']);

$hole = array();
$hole['posts'] = array();


?>
<html>
<head>
	<title>The Hole - <?php echo($_GET['c']);?></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/screen.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="shortcut icon" type="image/png" href="https://www.icu.university/images/blackhole.png"/>
	<meta name="description" content="Posts that should never be seen">
	<meta name="keywords" content="<?php echo($_GET['c'].',');?> ICU, I see you, compliments, crushes, confessions, missed connections, college, school, hookups, dating, Ucrush, Tinder, FML, MLIA">
	<meta name="author" content="Hege Refsnes">
	
</head>
<body>
<header>
</header>
</body>

<div class = "text-center" style = "position:absolute; top:40%;">
	
	
</div>

<div id = "holeoverlay-left">
	
	<a href = "posts.php?c=<?php echo($_GET['c']); ?>" class = "btn btn-md btn-default"><span class = "glyphicon glyphicon-arrow-left"></span>&nbsp;EXIT</a>
	
</div>

<div id = "holeoverlay-right">
	
	<!-- Button trigger modal -->
	<button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal">
		What the Hell Is This?
	</button>


	
</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title text-center" id="myModalLabel"><span class = "holename">THE HOLE</span></h4>
	      </div>
	      <div class="modal-body">
	        So, what you are viewing is all the posts that the <?php echo($_GET['c']); ?> Moderator has denied. Therefore, this content was never intended to be seen, and in many cases, should never be shared publicly. This page is designed in a way that prevents sharing of the content beyond this setting. Every post that appears here is only available for a window of time.
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

<div id = 'hole'>
	
<script src = 'js/jquery.js' type = 'text/javascript'></script>
<script src = 'js/posts.js' type = 'text/javascript'></script>
<script src = 'js/bootstrap.js' type = 'text/javascript'></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42122616-2', 'auto');
  ga('send', 'pageview');

</script>


<?php 
include 'js/theholejs.php';
 ?>

</div>
</body>
</html>
