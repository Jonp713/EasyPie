<?php

require ('../init.php');

$function = $_POST['function'];

if($function == 'save_post' && isset($_POST['post_id']) && isset($session_user_id)){
	
	$success = save_post($session_user_id, $_POST['post_id']);
	
	if($success){
	
		echo("Post Saved");
	
	}
	
	
}


if($function == 'unsave_post' && isset($_POST['post_id']) && isset($session_user_id)){
	
	$success = unsave_post($session_user_id, $_POST['post_id']);
	
	if($success){
	
		echo("Post Unsaved");
	
	}
	
	
}

if($function == 'delete_post' && isset($_POST['post_id']) && isset($session_user_id)){
	
	$success = delete_post($session_user_id, $_POST['post_id']);
	
	if($success){
	
		echo("Post Deleted");
	
	}
	
	
}

if($function == 'reply_post' && isset($_POST['post_id']) && isset($session_user_id) && isset($_POST['message'])){
	
	$success = reply_post($session_user_id, $_POST['post_id'], $_POST['message']);
	
	if($success){
	
		echo('Your reply has been submitted');
	
	}
	
}

if($function == 'reply_message' && isset($_POST['message_id']) && isset($session_user_id) && isset($_POST['message'])){
	
	$success = reply_message($session_user_id, $_POST['message_id'], $_POST['message']);
	
	if($success){
	
		echo('Your reply has been submitted');
	
	}else{
		
		echo($success);
	}	
	
}

if($function == 'set_reply' && isset($_POST['post_id']) && isset($_POST['status_in']) && isset($session_user_id)){
	
	$success = set_reply($_POST['post_id'], $_POST['status_in'], $session_user_id);
	
	
	if($success){		
			
		if($_POST['status_in'] == 1){
		
			echo('Reply Added');
	
		}
		if($_POST['status_in'] == 0){
		
			echo('Reply Removed');
	
		}
	}	
	
}

if($function == 'subscribe_community' && isset($_POST['community_name']) && isset($session_user_id)){
	
	$success = subscribe_community($session_user_id, $_POST['community_name']);
	
	if($success){
	
		echo('You are now subscribed');
	
	}	
	
}

if($function == 'delete_subscription' && isset($_POST['community_name']) && isset($session_user_id)){
	
	$success = delete_subscription($session_user_id, $_POST['community_name']);
	
	if($success){
	
		echo('You are now unsubscribed');
	
	}	
	
}

if($function == 'delete_message' && isset($_POST['message_id']) && isset($session_user_id)){
	
	$success = delete_message($_POST['message_id'], $session_user_id, $_POST['type']);
		
	if($success){
	
		echo('Message deleted');
	
	}	
	
}

if($function == 'flag' && isset($_POST['post_id'])){
	
	$success = flag($_POST['post_id']);
		
	if($success){
	
		echo('Post Flagged');
	
	}	
	
}

if($function == 'get_more_approved_posts' && isset($_POST['start'])){
	
	$posts = get_more_approved_posts($_POST['start'], $_POST['site']);
			
	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'post', 'change_time', 'share_post', 'save_post', 'flag', 'reply', "share_post");
		
		echo('<br>');
	}
	
	if($posts[1]){
		
		$newstart = $_POST['start'] + 30;
	
		echo('<span id = "clickmore" onclick = "get_more_approved_posts('.$newstart.', '.$_POST['site'].')">More Posts</span>');
	
	}
	
}


if($function == 'get_more_feed_posts' && isset($_POST['start']) && isset($session_user_id)){
		
	$posts = get_user_feed($session_user_id, $_POST['start']);
			
	foreach ($posts[0] as $currentpost) {
		
		display_post($currentpost['id'], 'change_time', 'post', 'site', 'save_post', 'flag', 'reply', "share_post");
		
		echo('<br>');
	}
	
	if($posts[1]){
		
		$newstart = $_POST['start'] + 30;
	
		echo('<span id = "clickmore" onclick = "get_more_feed_posts('.$newstart.')">More Posts</span>');
	
	}
	
}



	
?>