<?php

require ('../init.php');

$function = $_POST['function'];

if($function == 'judgement' && isset($_POST['post_id']) && isset($_POST['judgement']) && isset($session_user_id)){
	
	if(user_moderates_service($_POST['service'], $_POST['community'], $session_user_id)){
	
		$success = judgement_user($_POST['post_id'], $_POST['judgement'], $session_user_id);
		
		if($success){
	
			echo("success");
	
		}else{
		
			echo($success);
		}
	
	}
}

if($function == 'delete_meme' && isset($_POST['pic_id']) && isset($session_user_id)){
		
	$success = delete_meme($_POST['pic_id'], $session_user_id);
		
	if($success){
	
		echo("success");
	
	}else{
		
		echo($success);
	}
	
	
}



if($function == 'addtodb' && isset($_POST['service']) && isset($_POST['community']) && isset($_POST['post_id'])){

	
	$success = add_to_memebase($_POST['community'], $_POST['service'], $_POST['post_id']);
		
	if($success){
	
		echo('added to memedb');
	
	}	
	
	echo($success);
}


if($function == 'give_point' && isset($_POST['post_id']) && isset($session_user_id)){
	
	$success = give_point($_POST['post_id'], $session_user_id);
		
	if($success){
	
		echo('Point Given');
	
	}	
	
}



if($function == 'get_comments' && isset($_POST['post_id'])){
	
	$comments = get_comments($_POST['post_id']);
	
	foreach ($comments as $currentcomment) {
	
		display_comment($currentcomment['id'], 'text', 'username', 'give_point', 'point_count', 'take_point');
	
	
	}
	
}

if($function == 'submit_comment' && isset($_POST['post_id'])){

    $timestamp = date('g:i A \ \ D, M d, Y' , time());
					
	$comment_data = array(
		'text'	 	=> $_POST['comment'],
		'post_id'			=> $_POST['post_id'],
		'second'		=> time(),
	);
	
			
	if(logged_in() === true){
		
		$comment_data['user_id'] = $session_user_id;
		$comment_data['show_username'] = 1;
		
	}
	
	$success = submit_comment($comment_data);
	
	echo($success);

}


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

if($function == 'set_comments' && isset($_POST['post_id']) && isset($_POST['status_in']) && isset($session_user_id)){
	
	$success = set_comments($_POST['post_id'], $_POST['status_in'], $session_user_id);
	
	if($success){		
			
		if($_POST['status_in'] == 1){
		
			echo('Comments Added');
	
		}
		if($_POST['status_in'] == 0){
		
			echo('Comments Removed');
	
		}
	}	
	
}

if($function == 'subscribe_community' && isset($_POST['community_name']) && isset($session_user_id)){
	
	$success = subscribe_community($session_user_id, $_POST['community_name'], $_POST['service']);
	
	if($success){
	
		echo('You are now subscribed');
	
	}	
	
}

if($function == 'delete_subscription' && isset($_POST['community_name']) && isset($session_user_id)){
	
	$success = delete_subscription($session_user_id, $_POST['community_name'], $_POST['service']);
	
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
	
	$posts = get_more_approved_posts($_POST['start'], $_POST['site'], $_POST['service']);
			
	foreach ($posts[0] as $currentpost) {
		
			if($_POST['service'] === "all"){
				
				create_display_set($currentpost['id'], 'home', 'ajax');
		
			}else{
		
				if($currentpost['service'] == "Hole" || $_POST['service'] === "Hole"){
						
						echo('<span class = "hole-post col-xs-12 no-padding">');
		
						display_hole_post($currentpost['id'], 'post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'change_time', 'image');
							
						echo('</span>');
						
				}else{
					
					create_display_set($currentpost['id'], 'service', 'ajax');
				
				}
		
			}		
		
	}
	
	if($posts[1]){
		
		$newstart = $_POST['start'] + 5;
		
		
		if($_POST['service'] == "Hole"){
		
				echo('<span class = "btn btn-hole btn-lg" id = "clickmore" onclick = "get_more_approved_posts('.$newstart.', \''.$_POST['site'].'\', \''.$_POST['service'].'\')">Go Deeper</button>');
				
		}else{
		
	
			echo('<button class = "btn btn-default" id = "clickmore" onclick = "get_more_approved_posts('.$newstart.', \''.$_POST['site'].'\', \''.$_POST['service'].'\')">More Posts</button>');
		
		}
	
	}

}


if($function == 'get_more_feed_posts' && isset($_POST['start']) && isset($session_user_id)){
		
	$posts = get_user_feed($session_user_id, $_POST['start'], 1);
			
	foreach ($posts[0] as $currentpost) {
		
		
			create_display_set($currentpost['id'], 'feed', 'ajax');
		
	}
	
	if($posts[1]){
		
		$newstart = $_POST['start'] + 5;
	
		echo('<button class = "btn btn-default" id = "clickmore" onclick = "get_more_feed_posts('.$newstart.')">More Posts</button>');
	
	}
	
}

//check!!

if($function == 'get_more_admin_posts' && isset($_POST['start'])){
	
	if(user_moderates_service($_POST['service'], $_POST['site'], $session_user_id)){
	
		$posts = get_more_approved_posts($_POST['start'], $_POST['site'], $_POST['service']);
			
		foreach ($posts[0] as $currentpost) {
				
			create_display_set($currentpost['id'], 'moderator', 'ajax');
				
		}
	
	}
	
}



if($function == 'send_to' && isset($_POST['towards'])){	
	
	if(user_moderates_service($_POST['service'], $_POST['community'], $session_user_id)){
	
		$towards = $_POST['towards'];
	
		$towards = sanitize($towards);
	
		$post_id = $_POST['post_id'];
	
		if($towards == 'Hole'){
		
			mysql_query("UPDATE posts SET status = 1, service = '$towards' WHERE id = '$post_id'") or die(mysql_error());
				
		
		}else{
	
			mysql_query("UPDATE posts SET status = 0 , service = '$towards' WHERE id = '$post_id'");
		
			create_mod_notification($_POST['service'], $_POST['community'], 'new_post', 'A moderator sent a post to your board', $post_id);
			
		}
	
	}
			
	
}



if($function == 'user_enter' && isset($_POST['service'])){

	return user_enter($_POST['service'], $_POST['community']);

}

if($function == 'user_leave' && isset($_POST['service'])){


	return user_leave($_POST['service'], $_POST['community']);



}


	
?>