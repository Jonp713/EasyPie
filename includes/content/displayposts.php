<?php


if(isset($_GET['service']) == false){

	echo('<div id = "posts" class = "all-feed">');

	$posts = get_posts(1, $community_in, -1, false, 'all');

	foreach ($posts[0] as $currentpost) {
		
		/*
		
		if($currentpost['service'] == "ICU"){
			
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'save_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			
		}
		if($currentpost['service'] == "Bone"){
		
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
		}
		
		*/
		
		if($currentpost['service'] == "Events"){
		
			display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'service', 'share_post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner', 'free_food', 'save_post', 'duration', 'start_time_full');
		
		}
		
		if($currentpost['service'] != "Events"){
			
			create_display_set($currentpost['id'], 'home',  'load');
		
		}
		
		
		/*
		
		if($currentpost['service'] == "Hole"){
		
			display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
			
			echo('<br>');
		
		
		}
		
		*/

		
	}
	
	if($posts[1]){
	
	
		echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_approved_posts(10,\''.$community_in.'\',\'all\')">More Posts</span>');
	
	}
	
	echo('</div>');

}

/*

if(isset($_GET['service']) && $_GET['service'] == "ICU"){

	echo('<div id = "posts" class = "ICU-feed">');

	$posts = get_posts(1, $community_in, -1, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'share_post', 'save_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
	}
	
	if($posts[1]){
		
		echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_approved_posts(30,\''.$community_in.'\',\''.$service_in.'\')">More Posts</span>');
	
	}
	
	echo('</div>');
	
	
}


if(isset($_GET['service']) && $_GET['service'] == "Bone"){

	echo('<div id = "posts" class = "Bone-feed">');

	$posts = get_posts(1, $community_in, -1, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
	}
	
	if($posts[1]){
		
		echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_approved_posts(30,\''.$community_in.'\',\''.$service_in.'\')">More Posts</span>');
	
	
	}
	
	echo('</div>');
	
	
}

*/

if(isset($_GET['service']) && $_GET['service'] == "Events"){

	echo('<div id = "posts" class = "Events-feed">');

	$posts = get_posts(1, $community_in, 8, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'share_post', 'comment_count', 'comment_on', 'point_count', 'give_point', "image_corner", 'free_food', 'save_post', 'duration', 'start_time_full');
		
	}
	
	if($posts[1]){
		
		echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_approved_posts(10,\''.$community_in.'\',\''.$service_in.'\')">More Posts</span>');
	
	
	}
	
	echo('</div>');
	
	
}

if(isset($_GET['service']) && $_GET['service'] != "Events"){
	
	echo('<div id = "posts" class = "'.$_GET['service'].'-feed">');

	$posts = get_posts(1, $community_in, -1, false, $_GET['service']);
	
	foreach ($posts[0] as $currentpost) {
	
		create_display_set($currentpost['id'], 'posts', 'load');
	
	}
	
	
	echo('</span>');
	
	
}




?>

