<h1>My Feed</h1>

<?php
	
$posts = get_user_feed($session_user_id, 0);

echo('<div id = "posts">');

foreach ($posts[0] as $currentpost) {

	display_post($currentpost['id'], 'post', 'site', 'display_time', 'save_post', 'flag', 'reply');

	echo('<br>');

}

if($posts[1]){

	echo('<span id = "clickmore" onclick = "get_more_feed_posts(30)">More Posts</span>');

}

echo('</div>');
	
?>