<?php

if(isset($_GET['service']) == false && isset($_GET['c']) == false){

	$posts = get_user_feed($session_user_id, 0, 0);

	echo('<div id = "unapproved-posts">');

	foreach ($posts[0] as $currentpost) {

		if($currentpost['service'] == "ICU"){
		
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			echo('<br>');
		
		}
		if($currentpost['service'] == "Bone"){
	
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			echo('<br>');
	
		}
	
	
		if($currentpost['service'] == "Hole"){
	
			display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
		
			echo('<br>');
	
	
		}
	

	}

	echo('</div>');
	
	if(count($posts[0]) > 0){
		
		$newcolor = hex2rgb($colortouse);
		
		echo('<span class = "unsorted-posts-button" style = "background-color:rgba('.implode($newcolor,',').', .6);" onclick = "view_unsorted_posts()">'.count($posts[0]) . " unsorted posts</span>");
			
	}

}


if(isset($_GET['service']) == false && isset($_GET['c']) == true){

	echo('<div id = "unapproved-posts" class = "icu-feed">');

	$posts = get_posts(0, $community_in, -1, false, 'all');

	foreach ($posts[0] as $currentpost) {
		
		if($currentpost['service'] == "ICU"){
			
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			echo('<br>');
			
		}
		if($currentpost['service'] == "Bone"){
		
			display_post($currentpost['id'], 'post', 'service', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			echo('<br>');
		
		}
		
		if($currentpost['service'] == "Hole"){
		
			display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
			
			echo('<br>');
		
		
		}
		
		
		
	}
	
	
	echo('</div>');
	
	if(count($posts[0]) > 0){
		
		$newcolor = hex2rgb($colortouse);
		
		echo('<span class = "unsorted-posts-button" style = "background-color:rgba('.implode($newcolor,',').', .6);" onclick = "view_unsorted_posts()">'.count($posts[0]) . " unsorted posts</span>");
			
	}
	

}

if(isset($_GET['service']) && $_GET['service'] == "ICU"){

	echo('<div id = "unapproved-posts" class = "icu-feed">');

	$posts = get_posts(0, $community_in, -1, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
		echo('<br>');
	}
	
	
	echo('</div>');
	
	if(count($posts[0]) > 0){
		
		$newcolor = hex2rgb($colortouse);
		
		echo('<span class = "unsorted-posts-button" style = "background-color:rgba('.implode($newcolor,',').', .6);" onclick = "view_unsorted_posts()">'.count($posts[0]) . " unsorted posts</span>");
			
	}
}


if(isset($_GET['service']) && $_GET['service'] == "Bone"){

	echo('<div id = "unapproved-posts" class = "bone-feed">');

	$posts = get_posts(0, $community_in, -1, false, $service_in);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
		echo('<br>');
	}
	
	echo('</div>');
	
	if(count($posts[0]) > 0){
		
		$newcolor = hex2rgb($colortouse);
		
		echo('<span class = "unsorted-posts-button" style = "background-color:rgba('.implode($newcolor,',').', .6);" onclick = "view_unsorted_posts()">'.count($posts[0]) . " unsorted posts</span>");
			
	}
	
	
}

?>

