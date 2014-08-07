<?php

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$posts = get_posts(0, $_GET['community'], 0, false);

}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){

	$posts = get_posts(0, $admin_data['community'], 0, false);
}

foreach ($posts as $currentpost) {
	
	display_post($currentpost['id'], 'post', 'display_time', 'username', 'admin_reply', 'give_points', 'approve', 'deny', 'delete');
	
	echo('<br>');
	
}
	

?>
