<?php

moderator_protect_page();

$adminshow = false;

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$posts = get_posts(1, $_GET['community'], -4, null, 'all');
	
	$moretype = 0;
	
}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	$admin_profile_id = admin_id_from_codename($_GET['codename']);
		
	$posts = get_posts(1, null, -4, $admin_profile_id, 'all');
		
	$moretype = 1;
	
}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){

	$posts = get_posts(1, $admin_data['community'], -4, null, 'all');
	
	$moretype = 0;
	
}

echo('<div id = "posts">');



foreach ($posts[0] as $currentpost) {
	
	if($moretype == 1){

		display_post_admin($currentpost['id'], 'post', 'site', 'display_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete', 'image', 'service');

	}else{
		display_post_admin($currentpost['id'], 'post', 'display_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete', 'image', 'service');
	
	}
			
	echo('<br>');

}

if($posts[1]){

	echo('<span id = "clickmore" onclick = "get_more_approved_posts_admin(5,\''.$_GET['community'].'\', '.$moretype.')">More Posts</span>');

}

echo('</div>');	
		

?>
