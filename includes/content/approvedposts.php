<h1>Submitted Posts</h1>
<?php
	
$posts = get_user_posts(1, $session_user_id);

foreach ($posts as $currentpost) {
	
	display_post($currentpost['id'], 'post', 'site', 'display_time', 'points_awarded', 'reply_toggle', 'delete_post-user');	
	
	echo('<br>');

}
	
	
?>