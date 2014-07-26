<?php

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$userlist = highest_points($_GET['community'], 3);
	$cmon = $_GET['community'];
}

if(empty($_GET) === true){
	
	$userlist = highest_points($admin_data['community'], 3);
	$cmon = $admin_data['community'];
	
}	

foreach ($userlist as $currentuser){
	
	$currentuser_data = user_data($currentuser['id'], 'username');
	
	echo('Username: '.$currentuser_data['username'].'<br>');
	
	echo('Points: ' . $currentuser['totalpoints'] . '<br>');
	
	$currentuser_posts = count_user_posts($currentuser['id'], $cmon);
	
	echo('Posts: '.$currentuser_posts['total'].'<br>');
	
	echo('<span id = "'.$currentuser['id'].'send"><input type = "text" id = "send">&nbsp;<span onclick="send_admin_message('.$currentuser['id'].', 1)">Send Message</span></span><br><br>');
	
}

	
?>