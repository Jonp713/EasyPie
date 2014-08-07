<h1>My Feed</h1>


<?php
	
$posts = get_user_feed($session_user_id);

foreach ($posts as $currentpost) {

	display_post($currentpost['id'], 'post', 'site', 'display_time', 'save_post', 'flag', 'reply');

	echo('<br>');

}

	
?>