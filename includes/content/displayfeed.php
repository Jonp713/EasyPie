<span class = 'feedtitle'></span>

<?php
	
$posts = get_user_feed($session_user_id, 0);

echo('<div id = "posts">');

foreach ($posts[0] as $currentpost) {

	display_post($currentpost['id'], 'post', 'site', 'display_time', 'share_post', 'save_post', 'flag', 'reply');

	echo('<br>');

}

if($posts[1]){

	echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_feed_posts(30)">More Posts</span>');

}

echo('</div>');
	
?>