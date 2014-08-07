<?php

$adminshow = false;

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$posts = get_posts(2, $_GET['community'], 0, false);

}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	
	$admin_profile_id = admin_id_from_codename($_GET['codename']);
		
	$posts = get_posts(2, null, 2, $admin_profile_id);
	
	$adminshow = true;
	
}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){

	$posts = get_posts(2, $admin_data['community'], 0, false);
}

foreach ($posts as $currentpost) {
	
	if($adminshow){
	
		display_post($currentpost['id'], 'post', 'site', 'display_time', 'username', 'admin_reply', 'approve', 'delete');
	
	}else{
		display_post($currentpost['id'], 'post', 'display_time', 'username', 'admin_reply', 'approve', 'delete');
		
	}
	
	echo('<br>');
	
}
		

?>
