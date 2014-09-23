<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
?>

<?php


$communities = get_subscriptions(0, $session_user_id, '');

if(count($communities) > 0){

echo('<span class = "pull-right otherfeedinfo col-xs-12 col-sm-4">');

include 'includes/widgets/submitpost.php';

include 'includes/content/currentsubscriptions.php';

echo('</span>');


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



?>

<?php include 'includes/overall/footer.php'; ?>