	
<?php
include 'core/init.php';
active_protect($_GET['c']);


?>

<html>
<head>
<title><?php if(!empty($service_in)){echo($service_in);}else{echo('ICU');} ?> <?php if(!empty($community_in)){echo($community_in);}else{echo('Hampy');}  ?></title>

	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/screen2.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="shortcut icon" type="image/png" href="https://www.icu.university/images/blackhole.png"/>
	<meta name="description" content="Never come here again">
	<meta name="keywords" content="<?php if(!empty($community_in)){echo($community_in.',');} ?> <?php if(!empty($service_in)){echo($service_in.',');} ?>, college, community, events, in the area, life, tickling, personals, compliments, icuhampy">	
	<meta name="author" content="The Devil">
	<meta name="viewport" content="width=device-width" />
	
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300italic,400italic,600,200,200italic,300,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
			<script src="js/moments.js"></script>

			<script>
			    moment().format();
			
			
			</script>
	
	
</head>
<body>
	
	<?php include 'includes/widgets/modals.php'; ?>
	
	<div id = "topalert" class="topalert"><?php include('includes/widgets/postrecieve.php'); ?>
</div>
	
<header>
</header>
</body>

<div id = "holeoverlay-left">
	
	<a href = "posts.php?c=<?php echo($_GET['c']); ?>" class = " btn btn-md btn-default"><span class = "glyphicon glyphicon-arrow-left"></span>&nbsp;EXIT</a>
	
</div>

<div id = "holeoverlay-right">
	
	<?php
	

	if(logged_in() == true){	
	
		if(user_subscribed($user_data['user_id'], $community_in, $service_in) == false){

			echo('<button class="btn btn-warning btn-md subscribe_community_button" onclick="subscribe_community(\''.$community_in.'\',\''.$service_in.'\',this,2)">ADD TO FEED</button>');
		
		}else{
		
			echo('<button class="btn btn-danger btn-md delete_subscription_button" onclick="delete_subscription(\''.$community_in.'\',\''.$service_in.'\',this,2, 2)">REMOVE FROM FEED</button>');
		}
	
	}else{
	
	
		//echo('Log In to subscribe to this community');
	
	}
	
	?>
	
	<button class="btn btn-info btn-md inline" data-toggle="modal" data-target="#myModal">SUBMIT POST</button>
	
	
	<!-- Button trigger modal -->
	<button class="btn btn-default btn-md inline" data-toggle="modal" data-target="#holeModal">
		What the Hell Is This?
	</button>
	
</div>

	<!-- Modal -->
	<div class="modal fade" id="holeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title text-center" id="myModalLabel"><span class = "holename">THE HOLE</span></h4>
	      </div>
	      <div class="modal-body">
	        So, what you are viewing is all the posts that the <?php echo($_GET['c']); ?> Moderator has denied. Therefore, this content was never intended to be seen, and in many cases, should never be shared publicly. This page is designed in a way that helps prevent sharing of the content beyond this setting. <br><br> More importantly, some of this content can be triggering, rascist, just plain gross, or just not what you are into right now. The design is meant to allow you to avoid content you no don't want to see.
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

<class id="ploatje" class="ploatjeClass">
	
	<span class = "hole-feed col-xs-12 col-sm-5 col-sm-offset-1 col-xs-offset-0 low-padding">
	
		<?php include 'includes/content/displayholeposts.php'; ?>
	
	</span>
	
		<span class = "hole-moderator hidden-xs col-sm-4 low-padding">
	<br><br><br>
			<?php include 'includes/content/displaymoderator.php'; ?>
		

		</span>
	
</class>
	
	
	<span id = "hole-comments-section" class = "col-sm-4 col-xs-12">
	
	
		<?php include 'includes/content/displayholecomments.php'; ?>
	
	
	</span>
	
	
<div id="log"></div>  
<div id="logDetails"></div>  

	<?php if (logged_in() === true) {
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

<script src = 'js/jquery.js' type = 'text/javascript'></script>

<script src = 'js/posts.js' type = 'text/javascript'></script>
<script src = 'js/comments.js' type = 'text/javascript'></script>
<script src = 'js/points.js' type = 'text/javascript'></script>
	<?php include 'js/servicesjs.php' ?>		

<script src = 'js/hole.js' type = 'text/javascript'></script>

<?php include 'includes/widgets/getcomments.php'; ?>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42122616-2', 'auto');
  ga('send', 'pageview');

</script>
 
<script src = 'js/bootstrap.js' type = 'text/javascript'></script>
<script src = 'js/communities.js' type = 'text/javascript'></script>





</body>
</html>