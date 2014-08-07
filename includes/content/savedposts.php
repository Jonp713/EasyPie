<h1>Saved Posts</h1>


<?php
	
$posts = get_user_saved_posts($session_user_id);

foreach ($posts as $currentpost){
	
	display_post($currentpost['id'], 'post', 'site', 'display_time', 'unsave_post');
	
	echo('<br>');

}

?>