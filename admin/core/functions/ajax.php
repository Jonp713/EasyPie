<?php

require ('../init.php');

$function = $_POST['function'];

if($function == 'judgement' && isset($_POST['post_id']) && isset($_POST['judgement']) && isset($session_admin_id)){
	
	$success = judgement($_POST['post_id'], $_POST['judgement'], $session_admin_id);
		
	if($success){
	
		echo("Judgement Is Law. All Hail NG");
	
	}
	
}


if($function == 'admin_reply' && isset($_POST['post_id']) && isset($_POST['message']) && isset($session_admin_id)){
	
	$success = admin_reply($_POST['post_id'],  $_POST['message'], $session_admin_id);
		
	if($success){
	
		echo("Reply Sent");
	
	}	
	
}

if($function == 'give_points' && isset($_POST['post_id']) && isset($_POST['amount']) && isset($session_admin_id)){
	
	$success = give_points($_POST['post_id'],  $_POST['amount'], $session_admin_id, $_POST['community_name']);
		
	if($success){
	
		echo("Points Dished");
	
	}	
	
}

if($function == 'admin_post' && isset($_POST['community']) && isset($_POST['message']) && isset($session_admin_id)){
	
	$success = admin_post($_POST['message'],  $_POST['community'],  $session_admin_id);
		
	if($success){
	
		echo("Admin post is up");
	
	}	
	
}

if($function == 'delete_admin_post' && isset($_POST['admin_post_id']) && isset($session_admin_id)){
	
	$success = delete_admin_post($_POST['admin_post_id'],  $session_admin_id);
		
	if($success){
	
		echo("Admin Post Taken Down");
	
	}	
	
}

if($function == 'send_admin_message' && isset($_POST['user_id']) && isset($_POST['message']) && isset($session_admin_id)){
	
	$success = send_admin_message($_POST['user_id'],  $_POST['message'], $session_admin_id);
		
	if($success){
	
		echo("Message Sent");
	
	}	
	
}

if($function == 'remove_pic' && isset($_POST['pic_id']) && isset($session_admin_id)){
	
	$success = remove_pic($_POST['pic_id'], $session_admin_id);
			
	if($success){
	
		echo("Picture Removed");
	
	}	
	
}

if($function == 'blacklist' && isset($_POST['ip']) && isset($session_admin_id)){
	
	$success = blacklist($_POST['ip'], $session_admin_id);
			
	if($success){
	
		echo("IP Blacklisted");
	
	}	
	
}

if($function == 'remove_blacklist' && isset($_POST['ip']) && isset($session_admin_id)){
	
	$success = remove_blacklist($_POST['ip'], $session_admin_id);
		
	if($success){
		
		echo('Blacklist Removed');
	}	
	
	
}


if($function == 'ok_requests' && isset($_POST['id']) && isset($session_admin_id)){
	
	$success = ok_requests($_POST['id'], $session_admin_id);
		
	if($success){
		
		echo('Requests Okay\'d');
	}	
	
	
}



?>