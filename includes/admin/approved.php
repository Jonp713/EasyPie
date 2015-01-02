<?php

protect_moderator($_GET['service'], $_GET['c'], $session_user_id);


if(isset($_GET['service']) && $_GET['service'] != "Events"){
	
	echo('<div id = "posts" class = "approved-feed">');
	
	
	$posts = get_posts(1, $_GET['c'], -1, $session_user_id, $_GET['service']);
	
	foreach ($posts[0] as $currentpost) {
	
		create_display_set($currentpost['id'], 'moderator', 'load');
	
	}
		
	if($posts[1]){
		
		echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_approved_posts(10,\''.$community_in.'\',\''.$service_in.'\')">More Posts</span>');
	
	
	}
	
	echo('</div>');
	
}


?>