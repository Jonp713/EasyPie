<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
?>

<?php


$communities = get_subscriptions(0, $session_user_id, '');

if(count($communities) > 0){

echo('<span class = "pull-right otherfeedinfo hidden-xs col-sm-4">');

include 'includes/widgets/submitpost.php';

include 'includes/content/currentsubscriptions.php';

echo('</span>');

echo('<span class = "pull-left feed col-xs-12 col-sm-8">');

include 'includes/content/unnapprovedposts.php';

include 'includes/content/displayfeed.php';

echo('</span>');

echo('</span>');

}else{
	echo('<span class = "text-center col-xs-12 col-sm-6 col-sm-offset-3">');
	
	echo("<br><br><br><h1>This page will fill up with posts when you add services to your feed</h1><br><h4>Check out your communities <a class = 'exploreonfeed' href ='posts.php?c=Hampy'>home</a> page to get started</h4>");
	
	echo('</span>');
	
	
}



?>

<?php include 'includes/overall/footer.php'; ?>