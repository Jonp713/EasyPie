<h1>Saved Posts</h1>


<?php
	
$posts = get_user_saved_posts($session_user_id);

foreach ($posts as $currentpost) {
	
	echo($currentpost['post'] . '<br>');
	echo($currentpost['site'] . '<br>');
	echo($currentpost['display_time'] . '<br><br>');

}

	
	
?>