<span class = 'feedtitle'></span>

<?php
	
$posts = get_user_feed($session_user_id, 0, 1);

echo('<div id = "posts">');

foreach ($posts[0] as $currentpost) {

	if($currentpost['service'] == "ICU"){
		
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'save_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		echo('<br>');
		
	}
	if($currentpost['service'] == "Bone"){
	
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		echo('<br>');
	
	}
	
	
	if($currentpost['service'] == "Hole"){
	
		display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
		
		echo('<br>');
	
	
	}
	

}

if($posts[1]){

	echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_feed_posts(30)">More Posts</span>');

}

echo('</div>');
	
?>