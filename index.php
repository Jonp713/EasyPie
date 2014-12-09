<?php

include 'core/init.php';
include 'includes/overall/header.php';


?>


<?php
	
if(logged_in() == true){


	$communities = get_subscriptions(0, $session_user_id, '');

	if(count($communities) > 0){

	echo('<span class = "pull-right otherfeedinfo col-xs-12 col-sm-4">');
	
	?>
		
	<?php

	include 'includes/widgets/submitpost.php';

	echo("<span class = 'hidden-xs'>");

	include 'includes/content/currentsubscriptions.php';

	echo('</span></span>');


	echo('<span class = "pull-left feed col-xs-12 col-sm-8">');

	echo('<span class = "feedtitle hidden-sm hidden-md hidden-lg">');

	echo('<br>MY FEED<br>');

	echo('</span>');


	include 'includes/content/displayfeed.php';

	echo('</span>');

	echo('</span>');

	}else{
		echo('<span class = "text-center">');
	
		echo("<h1>You need to <a class = 'exploreonfeed' href ='explore.php'>explore</a></h1><br><h4>and subscribe to some communities before you get your own personal feed.</h4>");
	
		echo('</span>');
	
	
	}


	
}else{
	
	$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
	$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
	
	if($Android || $iPod || $iPhone || $iPad) {

	
		header('Location: app.php');
	
		
	}else{
		
	
		header('Location: landing.php');
	
	}
	
}
	
?>

<?php include 'includes/overall/footer.php'; ?>