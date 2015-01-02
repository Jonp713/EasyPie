

<?php
		
$posts = get_user_posts(1, $session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "text-center">');

	echo("<h1>Haven't submitted anything?</h1><br><h4>Get on it or ill delete ur account you lil fucker</h4>");
	
	echo('</span>');
	
}
	
foreach ($posts as $currentpost) {
	/*
	
	if($currentpost['service'] == "ICU"){
		
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'save_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point', 'delete_post-user', 'reply_toggle', 'comment_toggle');
		echo('<br>');
		
	}
	if($currentpost['service'] == "Bone"){
	
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point', 'reply_toggle', 'delete_post-user', 'comment_toggle');
		echo('<br>');
	
	}
	
	
	if($currentpost['service'] == "Hole"){
	
		display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image', 'delete_post-user');
		
		echo('<br>');
	
	
	}
	*/
	
	if($currentpost['service'] == "Events"){
	
		display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'service', 'share_post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner','save_post', 'free_food',  'delete_post-user', 'duration', 'comment_toggle', 'start_time_full');
	
	}
	
	if($currentpost['service'] != "Events"){
		
		create_display_set($currentpost['id'], 'submissions', 'load');
	}
	
	
}


	
	
?>
