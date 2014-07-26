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

if(empty($_GET) === true){

	$posts = get_posts(1, $admin_data['community'], 0, null);
}

	foreach ($posts as $currentpost) {
		
		echo($currentpost['post'] . '<br>');
		echo($currentpost['display_time'] . '<br>');
		if($adminshow == true){
			
			echo($currentpost['site'] . '<br>');
			
		}
		
		$savedcount = count_saved($currentpost['id'], 1);
		
		echo("Times Saved: " . $savedcount . "<br>");
		
		
		if(isset($currentpost['user_id'])){

			$current_post_user_data = user_data($currentpost['user_id'], 'username');
		
			echo("Submitted by:<i> " . $current_post_user_data['username'] . "</i><br>");
		
			if($currentpost['reply_on'] == 1){
				
				$directreplies = count_replies($currentpost['id'], 0);
				
				echo("Direct Replies: " . $directreplies . "<br>");
				
				$sustainedreplies = count_replies($currentpost['id'], 1);
				
				echo("Sustained Replies: " . $sustainedreplies . "<br>");
				
			}
		
			echo('<span id = "'.$currentpost['id'].'reply"><input type = "text" id = "reply">&nbsp;<span onclick="admin_reply('.$currentpost['id'].', 1)">Moderator Reply</span></span><br>');
			echo('<span id = "'.$currentpost['id'].'points"><input type = "text" id = "points">&nbsp;<span onclick="give_points('.$currentpost['id'].',\''.$currentpost['site'].'\')">Dish Points</span></span><br>');
			//echo('<span id = "'.$currentpost['id'].'award"><select id = "award">&nbsp;</select><span onclick="give_award('.$currentpost['id'].', '.$session_admin_id.')">Award</span></span><br>');
		
		
		}

		echo('<span id = "'.$currentpost['id'].'deny"><span onclick="judgement('.$currentpost['id'].', 2)">Deny</span></span><br>');
		echo('<span id = "'.$currentpost['id'].'delete"><span onclick="judgement('.$currentpost['id'].', 3)">Delete</span></span><br><br>');
		
	}
		

?>
