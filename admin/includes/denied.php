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

if(empty($_GET) === true){

	$posts = get_posts(2, $admin_data['community'], 0, false);
}
	foreach ($posts as $currentpost) {
		
		echo($currentpost['post'] . '<br>');
		echo($currentpost['display_time'] . '<br>');
		if($adminshow == true){
			
			echo($currentpost['site'] . '<br>');
			
		}
		
		if(isset($currentpost['user_id'])){

			$current_post_user_data = user_data($currentpost['user_id'], 'username');
		
			echo("Submitted by:<i> " . $current_post_user_data['username'] . "</i><br>");
		
			echo('<span id = "'.$currentpost['id'].'reply"><input type = "text" id = "reply">&nbsp;<span onclick="admin_reply('.$currentpost['id'].', '.$session_admin_id.', 1)">Moderator Reply</span></span><br>');	
		
		}

		echo('<span id = "'.$currentpost['id'].'approve"><span onclick="judgement('.$currentpost['id'].', '.$session_admin_id.', 1)">Approve</span></span><br>');
		echo('<span id = "'.$currentpost['id'].'delete"><span onclick="judgement('.$currentpost['id'].', '.$session_admin_id.', 3)">Delete</span></span><br><br>');
		
	}
		

?>
