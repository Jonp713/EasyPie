<?php
include 'core/init.php';
active_protect($_GET['c']);

include 'includes/overall/header.php';

?>

<?php 


if($_SESSION['seen_ad'] == 0){
	
	if($_GET['c'] == "Hampy"){
	
		include 'includes/content/fullpagead.php';
	
		$_SESSION['seen_ad'] = 1;
	
	}
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

if($_GET['c'] == "TrapCity"){
	

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




<?php include 'includes/overall/footer.php'; ?>