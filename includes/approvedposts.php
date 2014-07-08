<h1>Approved Posts</h1>
<?php
	
$posts = get_user_posts(0, $session_user_id);

foreach ($posts as $currentpost) {
	
	echo($currentpost['post'] . '<br>');
	echo($currentpost['site'] . '<br>');
	echo($currentpost['display_time'] . '<br><br>');

}
	
	
?>