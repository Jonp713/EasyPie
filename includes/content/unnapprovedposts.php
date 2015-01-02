<?php

$posts[0] = [];


if(isset($_GET['service']) == false && isset($_GET['c']) == false){

	$posts = get_user_feed($session_user_id, 0, 0);

	echo('<span id = "unapproved-posts">');

	foreach ($posts[0] as $currentpost) {
		
		/*

		if($currentpost['service'] == "ICU"){
		
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
		}
		if($currentpost['service'] == "Bone"){
	
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
	
		}
	
	
		if($currentpost['service'] == "Hole"){
	
			display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
		
			echo('<br>');
	
	
		}
		*/
		if($currentpost['service'] == "Events"){
	
			display_post($currentpost['id'], 'title', 'site', 'location', 'start_time', 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner', 'free_food', 'duration', 'start_time_full');
	
		}
		if($currentpost['service'] != "Events"){
						
			create_display_set($currentpost['id'], 'unnaproved_feed', 'load');
		}
	

	}

	echo('</span>');
	

}


if(isset($_GET['service']) == false && isset($_GET['c']) == true){

	echo('<span id = "unapproved-posts" class = "icu-feed">');

	$posts = get_posts(0, $community_in, -3, false, 'all');

	foreach ($posts[0] as $currentpost) {
		
		/*
		
		if($currentpost['service'] == "ICU"){
			
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			
		}
		if($currentpost['service'] == "Bone"){
		
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
		}
		
		if($currentpost['service'] == "Hole"){
		
			display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
			
		
		
		}
		
		
		*/

		if($currentpost['service'] == "Events"){
	
			display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner', 'free_food', 'duration', 'start_time_full');
	
		}
		if($currentpost['service'] != "Events"){
			
			create_display_set($currentpost['id'], 'unnaproved_home', 'load');
		}
		
		
	}
	
	
	echo('</span>');
	
	

}

/*

if(isset($_GET['service']) && $_GET['service'] == "ICU"){

	echo('<span id = "unapproved-posts" class = "icu-feed">');

	$posts = get_posts(0, $community_in, -1, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
	}
	
	
	echo('</span>');
	
}


if(isset($_GET['service']) && $_GET['service'] == "Bone"){

	echo('<span id = "unapproved-posts" class = "bone-feed">');

	$posts = get_posts(0, $community_in, -1, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
	}
	
	echo('</span>');
	
}

*/

if(isset($_GET['service']) && $_GET['service'] == "Events"){

	echo('<span id = "unapproved-posts" class = "events-feed">');

	$posts = get_posts(0, $community_in, 9, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner', 'free_food', 'duration', 'start_time_full');
		
	}
	
	echo('</span>');
	
	
	
}



if(isset($_GET['service']) && $_GET['service'] != "Events" && service_needs_approve($_GET['service']) == "whatever_mod"){
	
	
	echo('<span id = "unapproved-posts" class = "'.$_GET['service'].'-feed">');
	

	$posts = get_posts(0, $community_in, -1, false, $service_in);

	foreach ($posts[0] as $currentpost) {

		create_display_set($currentpost['id'], 'unapproved', 'load');
	
	}
	
	echo('</span>');
	
	
	
}

if(count($posts[0]) > 0){
	
	if(isset($_GET['service']) == false){
	
		echo('<span class = "unsorted-posts-button" style = "background-color:rgba(0,0,0,0.6);" onclick = "view_unsorted_posts()">'.count($posts[0]) . " unapproved posts</span>");
	
	}else{
	
		$newcolor = hex2rgb($colortouse);
	
		echo('<span class = "unsorted-posts-button" style = "background-color:rgba('.implode($newcolor,',').', .6);" onclick = "view_unsorted_posts()">'.count($posts[0]) . " unapproved posts</span>");
	
	}
		
}

?>

