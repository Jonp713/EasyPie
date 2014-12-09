<?php

include 'core/init.php';
?>

<!doctype html>
<html>
<head>

	<title>ICU <?php if(!empty($community_in)){echo($community_in);} ?></title>
	
		<meta name="description" content="Find your secret admirer">
	
	<meta charset="UTF-8">
	 
	<meta name="keywords" content="<?php if(!empty($community_in)){echo($community_in.',');} ?> ICU, I see you, compliments, crushes, confessions, missed connections, college, university, icu.university, icu.com, school, hookups, dating, Ucrush, Tinder, FML, MLIA">	
	
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/screen3.1.css" rel="stylesheet">
	
	<link rel="shortcut icon" type="image/png" href="https://icu.university/images/logonotext.png"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
</head>
<body>
<header>
	
		
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300italic,400italic,600,200,200italic,300,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
		<script src="js/moments.js"></script>

		<script>
		    moment().format();
			
			
		</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=530304877091308&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="clear"></div>
		
		<div id = "topalert" class="topalert col-md-4 col-md-offset-4"></div>
		
</header>


<div id = "wrapper no-padding">

	<?php include 'includes/overall/sidebar.php'; ?>	
	

<div id = "page-content-wrapper no-padding">
	
	
<div class="container-fluid landingdiv no-padding">

<?php

include 'includes/content/landingpage.php';

?>

</div></div></div>
<footer>
 
	</footer>
    <script src = 'js/jquery.js' type = 'text/javascript'></script>
    <script src = 'js/posts.js' type = 'text/javascript'></script>
    <script src = 'js/bla.js' type = 'text/javascript'></script>
    <script src = 'js/communities.js' type = 'text/javascript'></script>
    <script src = 'js/messages.js' type = 'text/javascript'></script>
    <script src = "js/bootstrap.js" type = 'text/javascript'></script>
    <script src = "js/sidebar.js" type = 'text/javascript'></script>
	
	
	<script>
	
	var height = $(window).height();
	
	$('.landingdiv').height(height);
	
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