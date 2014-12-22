<?php
	
$posts = get_user_saved_posts($session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "col-xs-8 col-sm-offset-2 text-center">');

	echo("<h1>Dont think anything here is worth saving?</h1><br><h4>Like we care.......</h4>");
	
	echo('</span>');
	
}
	

echo('<span class = "dashcontentposts">');


foreach ($posts as $currentpost){
	
	if($currentpost['service'] == "ICU"){
		
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point', 'unsave_post');
		echo('<br>');
		
	}
	if($currentpost['service'] == "Bone"){
	
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point', 'unsave_post');
		echo('<br>');
	
	}
	
	
	if($currentpost['service'] == "Hole"){
	
		display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image', 'unsave_post');
		
		echo('<br>');
	
	
	}
	
	if($currentpost['service'] == "Events"){
	
		display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'service', 'share_post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner', 'free_food', 'unsave_post', 'save_post', 'duration');
	
	}
		
}

echo('</span>');


?>
