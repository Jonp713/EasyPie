<h1>Posts</h1>

<?php

	echo('<div id = "posts">');

	$posts = get_posts(1, $community_in, -1, false);

	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'display_time', 'save_post', 'flag', 'reply');
		
		echo('<br>');
	}
	
	if($posts[1]){
	
		echo('<span id = "clickmore" onclick = "get_more_approved_posts(30,\''.$community_in.'\')">More Posts</span>');
	
	}
	
	echo('</div>');

?>