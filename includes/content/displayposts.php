<?php


if(isset($_GET['service']) == false){

	echo('<div id = "posts" class = "all-feed">');

	$posts = get_posts(1, $community_in, -1, false, 'all');

	foreach ($posts[0] as $currentpost) {
	
		
		if($currentpost['service'] == "Events"){
		
			display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'service', 'share_post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner', 'free_food', 'save_post', 'duration', 'start_time_full', 'identity');
		
		}
		
		if($currentpost['service'] != "Events"){
			
			create_display_set($currentpost['id'], 'home',  'load');
		
		}
		

		
	}
	
	echo('</div>');

}


if(isset($_GET['service']) && $_GET['service'] == "Events"){

	echo('<div id = "posts" class = "Events-feed">');

	$posts = get_posts(1, $community_in, 8, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'share_post', 'comment_count', 'comment_on', 'point_count', 'give_point', "image_corner", 'free_food', 'save_post', 'duration', 'start_time_full', 'identity');
		
	}
	
	
	echo('</div>');
	
	
}

if(isset($_GET['service']) && $_GET['service'] != "Events"){
	
	echo('<div id = "posts" class = "'.$_GET['service'].'-feed">');

	$posts = get_posts(1, $community_in, -1, false, $_GET['service']);
	
	foreach ($posts[0] as $currentpost) {
	
		create_display_set($currentpost['id'], 'posts', 'load');
	
	}
	
	echo('</div>');
	
	
}




?>

