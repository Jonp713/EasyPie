<?php
if(isset($_GET['service']) && $_GET['service'] == "Hole"){

	header("Location: index.php");

}


include 'core/init.php';
active_protect($_GET['c']);

include 'includes/overall/header.php';

if(isset($_GET['service']) && is_event($_GET['service'])){
	
	time_check($community_in);
	
}

if(isset($_GET['service'])){
	
	if(!service_available($_GET['c'], $_GET['service'])){
		
		header("Location: index.php");
	}
}else{
	
	if(!community_available($_GET['c'])){
		
		header("Location: index.php");
		
	}
}


sort_coolness($_GET['c']);

if($_SESSION['seen_ad'] == 0){
	
	if($_GET['c'] == "Hampy"){
	
		include 'includes/content/fullpagead.php';
	
		$_SESSION['seen_ad'] = 1;
	
	}
}

echo('<span class = "communitymoderator hidden-xs">');

echo('<span class = "lowerandscroll">');

include 'includes/content/servicedescription.php';

include 'includes/widgets/submitpost.php';

if(isset($session_user_id)){

	$home = get_home_from_user_id($session_user_id);

	if(!empty($home) && $home == $_GET['c'] && !isset($_GET['service'])){


		$link = 'createservice.php';

	 	echo('<a href="'.$link.'" style = "background-color:#aaa" class="btn btn-custom2 btn-lg btn-block">CREATE A BOARD</a>');
 

	}

}

include 'includes/content/displaymoderator.php';

include 'includes/widgets/subscribe.php';


if($_GET['c'] == "TrapCity"){
	
	//$adid = get_random_ad(2);

	//display_side_ad($adid);

	//increment_display_count($adid);	
		
}

echo('</span></span>');

//$rgb = hex2rgb($colortouse);

//echo('<span class = "communitynav col-xs-12" style = "background-color:rgba('.implode($rgb,',').',0.5)">');

echo('<span class = "communitynav col-xs-12">');

echo('<span class = "lowerandscroll">');

include 'includes/content/servicelist.php';

echo('</span></span>');


echo('<span class = "postfeed">');


include 'includes/content/unnapprovedposts.php';

include 'includes/content/displayposts.php';

echo('</span>');

include 'includes/content/sharedpost.php';

?>




<?php include 'includes/overall/footer.php'; ?>