<?php

moderator_protect_page();


if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$userlist = highest_points($_GET['community'], 3);
	$cmon = $_GET['community'];
}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){
	
	$userlist = highest_points($admin_data['community'], 3);
	$cmon = $admin_data['community'];
	
}	

foreach ($userlist as $currentuser){
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-6">');
	
	$currentuser_data = user_data($currentuser['id'], 'username');
	
	echo('Username: '.$currentuser_data['username'].'<br>');
	
	echo('Points: ' . $currentuser['totalpoints'] . '<br>');
	
	$currentuser_posts = count_user_posts($currentuser['id'], $cmon);
	
	echo('Posts: '.$currentuser_posts['total'].'<br>');
	
	echo('<span class = "'.$currentuser['id'].'send"><input type = "text" id = "send">&nbsp;<span onclick="send_admin_message('.$currentuser['id'].', 1)"><span class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span>Send Message</span></span></span><br><br>');
	
	echo('</span></span>');
	
}

	
?>