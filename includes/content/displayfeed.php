<span class = 'feedtitle'></span>

<?php
	
$posts = get_user_feed($session_user_id, 0, 1);

echo('<div id = "posts">');

foreach ($posts[0] as $currentpost) {

		
	create_display_set($currentpost['id'], 'feed', 'load');
	
	
}

if($posts[1]){

	echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_feed_posts(5)">More Posts</span>');

}

echo('</div>');
	
?>