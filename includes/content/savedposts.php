<?php
	
$posts = get_user_saved_posts($session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "col-xs-8 col-sm-offset-2 text-center">');

	echo("<h1>No one posted about you yet?</h1><br><h4>Be sure to save the post when they do!</h4>");
	
	echo('</span>');
	
}
	

foreach ($posts as $currentpost){
	
	display_post($currentpost['id'], 'post', 'site', 'share_post', 'display_time', 'unsave_post');
	
}

?>
