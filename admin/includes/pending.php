<?php

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$posts = get_posts(0, $_GET['community'], 0, false);

}

if(empty($_GET) === true){

	$posts = get_posts(0, $admin_data['community'], 0, false);
}

	foreach ($posts as $currentpost) {
		
		echo($currentpost['post'] . '<br>');
		echo($currentpost['display_time'] . '<br>');
		
		
		if(isset($currentpost['user_id'])){

			$current_post_user_data = user_data($currentpost['user_id'], 'username');
		
			echo("Submitted by:<i> " . $current_post_user_data['username'] . "</i><br>");
		
			echo('<span id = "'.$currentpost['id'].'reply"><input type = "text" id = "reply">&nbsp;<span onclick="admin_reply('.$currentpost['id'].', 1)">Moderator Reply</span></span><br>');
			echo('<span id = "'.$currentpost['id'].'points"><input type = "text" id = "points">&nbsp;<span onclick="give_points('.$currentpost['id'].',\''.$currentpost['site'].'\')">Dish Points</span></span><br>');
			//echo('<span id = "'.$currentpost['id'].'award"><select id = "award">&nbsp;</select><span onclick="give_award('.$currentpost['id'].', '.$session_admin_id.')">Award</span></span><br>');
		
		
		}

		echo('<span id = "'.$currentpost['id'].'approve"><span onclick="judgement('.$currentpost['id'].', 1)">Approve</span></span><br>');
		echo('<span id = "'.$currentpost['id'].'deny"><span onclick="judgement('.$currentpost['id'].', 2)">Deny</span></span><br>');
		echo('<span id = "'.$currentpost['id'].'delete"><span onclick="judgement('.$currentpost['id'].', 3)">Delete</span></span><br><br>');
		
	}
		

?>
