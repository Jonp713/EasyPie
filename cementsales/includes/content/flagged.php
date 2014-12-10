<?php

moderator_protect_page();


if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	$admin_profile_id = admin_id_from_codename($_GET['codename']);
		
	$posts = get_posts(1, null, 4, $admin_profile_id, 'all');
	
	$adminshow = true;
	
}



foreach ($posts[0] as $currentpost) {
	
	display_post_admin($currentpost['id'], 'post', 'site', 'display_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply',  'deny', 'delete');

	echo('<br>');
	
}
		

?>