<?php

require ('../init.php');

$function = $_POST['function'];

if($function == 'save_post' && isset($_POST['post_id'])){
	
	$success = save_post($session_user_id, $_POST['post_id']);
	
	if($success){
	
		echo("Post Saved");
	
	}
	
	
}


if($function == 'reply_post' && isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['message'])){
	
	$success = reply_post($_POST['user_id'], $_POST['post_id'], $_POST['message']);
	
	if($success){
	
		echo('Your reply has been submitted');
	
	}
	
	
}

if($function == 'reply_message' && isset($_POST['message_id']) && isset($_POST['user_id']) && isset($_POST['message'])){
	
	$success = reply_message($_POST['user_id'], $_POST['message_id'], $_POST['message']);
	
	if($success){
	
		echo('Your reply has been submitted');
	
	}else{
		
		echo($success);
	}	
	
}

if($function == 'subscribe_community' && isset($_POST['community_name']) && isset($_POST['user_id'])){
	
	$success = subscribe_community($_POST['user_id'], $_POST['community_name']);
	
	if($success){
	
		echo('You are now subscribed');
	
	}	
	
}
	
?>