<h1>My Feed</h1>


<?php
	
$posts = get_user_feed($session_user_id);

foreach ($posts as $currentpost) {
	
	echo($currentpost['post'] . '<br>');
	echo($currentpost['site'] . '<br>');
	echo($currentpost['display_time'] . '<br>');
	echo('<span class = "save_post" onclick="save_post('.$currentpost['id'].')"">Save Post</span><br><br>');
	

}

	
	
?>