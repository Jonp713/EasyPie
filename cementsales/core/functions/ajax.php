<?php

require ('../init.php');

$function = $_POST['function'];

if($function == 'judgement' && isset($_POST['post_id']) && isset($_POST['judgement']) && isset($session_admin_id)){
	
	$success = judgement($_POST['post_id'], $_POST['judgement'], $session_admin_id);
		
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
}


if($function == 'change_service' && isset($session_admin_id)){
	
	$success = change_service($_POST['post_id'], $_POST['service'], $session_admin_id);
		
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
}



if($function == 'admin_reply' && isset($_POST['post_id']) && isset($_POST['message']) && isset($session_admin_id)){
	
	if(empty($_POST['message'])){
		
		echo("You cannot send a blank reply");
		exit();
		
	}
	
	$success = admin_reply($_POST['post_id'],  $_POST['message'], $session_admin_id);
		
	if($success){
	
		echo true;
	
	}else{
		
		echo($success);
	}
}

if($function == 'give_points' && isset($_POST['post_id']) && isset($_POST['amount']) && isset($session_admin_id)){
	
	if($_POST['amount'] > 120){
		
		echo('You can only give out 100 points');
		exit();
	}
	
	if($_POST['amount'] <= 0){
		
		echo('You must give out at least 1 point');
		exit();
		
	}
	
	$success = give_points($_POST['post_id'],  $_POST['amount'], $session_admin_id, $_POST['community_name']);
		
	if($success){
	
		echo true;
	
	}else{
		
		echo($success);
	}
	
}

if($function == 'admin_post' && isset($_POST['community']) && isset($_POST['message']) && isset($session_admin_id)){
	
	if(empty($_POST['message'])){
		
		echo("Admin Posts cannot be blank");
		exit();
		
	}
	
	$success = admin_post($_POST['message'],  $_POST['community'],  $session_admin_id);
		
	if($success){
	
		echo true;
	
	}else{
		
		echo($success);
	}
	
}

if($function == 'delete_admin_post' && isset($_POST['admin_post_id']) && isset($session_admin_id)){
	
	$success = delete_admin_post($_POST['admin_post_id'],  $session_admin_id);
		
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
}

if($function == 'send_admin_message' && isset($_POST['user_id']) && isset($_POST['message']) && isset($session_admin_id)){
	
	if(empty($_POST['message'])){
		
		echo("You cannot send a blank message");
		exit();
		
	}
	
	$success = send_admin_message($_POST['user_id'],  $_POST['message'], $session_admin_id);
		
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
}

if($function == 'remove_pic' && isset($_POST['pic_id']) && isset($session_admin_id)){
	
	$success = remove_pic($_POST['pic_id'], $session_admin_id);
			
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
}

if($function == 'blacklist' && isset($_POST['ip']) && isset($session_admin_id)){
	
	$success = blacklist($_POST['ip'], $session_admin_id);
			
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
}

if($function == 'remove_blacklist' && isset($_POST['ip']) && isset($session_admin_id)){
	
	$success = remove_blacklist($_POST['ip'], $session_admin_id);
		
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
}


if($function == 'ok_requests' && isset($_POST['id']) && isset($session_admin_id)){
	
	$success = ok_requests($_POST['id'], $session_admin_id);
		
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
}

if($function == 'get_more_approved_posts_admin' && isset($_POST['start'])){
	
	$posts = get_more_approved_posts_admin($_POST['start'], $_POST['site'], $_POST['type']);
			
	foreach ($posts[0] as $currentpost) {
		
		if($_POST['type'] == 0){
		
			display_post($currentpost['id'], 'post', 'change_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete');
	
		}	
		
		if($_POST['type'] == 1){

			display_post($currentpost['id'], 'post', 'site', 'change_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete');

		}
		
		if($posts[1]){
		
			$newstart = $_POST['start'] + 30;
	
			echo('<span id = "clickmore" onclick = "get_more_approved_posts_admin('.$newstart.', '.$_POST['site'].', '.$_POST['type'].')">More Posts</span>');
	
		}
	
		echo('<br>');
	}
	
}


if($function == 'get_more_denied_posts_admin' && isset($_POST['start'])){
	
	$posts = get_more_denied_posts_admin($_POST['start'], $_POST['site'], $_POST['type']);
			
	foreach ($posts[0] as $currentpost) {
		
		if($_POST['type'] == 0){
		
			display_post($currentpost['id'], 'post', 'display_time', 'username', 'admin_reply', 'approve', 'delete');
	
		}	
		
		if($_POST['type'] == 1){

			display_post($currentpost['id'], 'post', 'site', 'display_time', 'username', 'admin_reply', 'approve', 'delete');

		}
	
		if($posts[1]){
		
			$newstart = $_POST['start'] + 30;
	
			echo('<span id = "clickmore" onclick = "get_more_denied_posts_admin('.$newstart.', '.$_POST['site'].', '.$_POST['type'].')">More Posts</span>');
	
		}
	
		echo('<br>');
	}
	
}


?>