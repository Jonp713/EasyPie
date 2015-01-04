<?php


if(isset($_GET['service']) == false){

	echo('<div id = "posts" class = "all-feed">');

	$posts = get_posts(1, $community_in, -1, false, 'all');

	foreach ($posts[0] as $currentpost) {
			
		create_display_set($currentpost['id'], 'home',  'load');
	
		
	}
	
	echo('</div>');

}


if(isset($_GET['service'])){
	
	echo('<div id = "posts" class = "'.$_GET['service'].'-feed">');
	
	if(is_event($_GET['service'])){
		
		$posts = get_posts(1, $community_in, "time-oriented", false, $_GET['service']);
		
		
	}else{
		
		$posts = get_posts(1, $community_in, -1, false, $_GET['service']);
		
	}

	
	foreach ($posts[0] as $currentpost) {
	
		create_display_set($currentpost['id'], 'posts', 'load');
	
	}
	
	echo('</div>');
	
	
}




?>

