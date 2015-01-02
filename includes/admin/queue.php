<?php

protect_moderator($_GET['service'], $_GET['c'], $session_user_id);


if(isset($_GET['service']) && $_GET['service'] != "Events"){
	
	
	$posts = get_posts(0, $_GET['c'], -2, $session_user_id, $_GET['service']);
	
	foreach ($posts[0] as $currentpost) {
	
		create_display_set($currentpost['id'], 'moderator', 'load');
	
	}
		
	
}


?>