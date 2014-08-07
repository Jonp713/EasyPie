<?php

$adminshow = false;

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$posts = get_posts(1, $_GET['community'], 0, null);

}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	$admin_profile_id = admin_id_from_codename($_GET['codename']);
		
	$posts = get_posts(1, null, 2, $admin_profile_id);
	
	$adminshow = true;
	
}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){

	$posts = get_posts(1, $admin_data['community'], 0, null);
}

foreach ($posts as $currentpost) {
	
	if($adminshow){

		display_post($currentpost['id'], 'post', 'site', 'display_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete');

	}else{
		display_post($currentpost['id'], 'post', 'display_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete');
	
	}
			
	echo('<br>');

}
		

?>
