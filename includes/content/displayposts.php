<h1>Posts</h1>

<?php

	$posts = get_posts(1, $community_in, 0, false);

	foreach ($posts as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'save_post', 'flag', 'reply');
		
		echo('<br>');
	}

?>