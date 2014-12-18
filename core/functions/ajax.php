<?php

require ('../init.php');

$function = $_POST['function'];


if($function == 'give_point' && isset($_POST['post_id']) && isset($session_user_id)){
	
	$success = give_point($_POST['post_id'], $session_user_id);
		
	if($success){
	
		echo('Point Given');
	
	}	
	
}



if($function == 'get_comments' && isset($_POST['post_id'])){
	
	$comments = get_comments($_POST['post_id']);
	
	foreach ($comments as $currentcomment) {
	
		display_comment($currentcomment['id'], 'text', 'username');
	
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
		
		
		if($currentpost['service'] == "ICU"){
			
			if($_POST['service'] === "all"){
			
				display_post($currentpost['id'], 'post', 'service', 'change_time', 'share_post', 'save_post', 'reply','comment_count', 'comment_on', 'point_count', 'give_point');
				echo('<br>');
			
			}else{
				
				display_post($currentpost['id'], 'post', 'change_time', 'share_post', 'save_post', 'reply','comment_count', 'comment_on', 'point_count', 'give_point');
				
			}
			
		}
		if($currentpost['service'] == "Bone"){
			
			if($_POST['service'] === "all"){
		
				display_post($currentpost['id'], 'post', 'service', 'change_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
				echo('<br>');
			
			}else{
			
				display_post($currentpost['id'], 'post', 'change_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			
			
			}
		
		}
		
		if($currentpost['service'] == "Hole"){
			
			
			
			if($_POST['service'] === "Hole"){
												
				echo('<span class = "hole-post col-xs-12 no-padding">');
		
				display_hole_post($currentpost['id'], 'post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'change_time', 'image');
		
				echo('</span><br>');
				
			}else{
				
		
				display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'change_time', 'image');
			
				echo('<br>');
				
			}
		
		
		
		}
	}
	
	if($posts[1]){
		
		$newstart = $_POST['start'] + 30;
	
		echo('<button class = "btn btn-default" id = "clickmore" onclick = "get_more_approved_posts('.$newstart.', \''.$_POST['site'].'\', \''.$_POST['service'].'\')">More Posts</button>');
	
	}

}


if($function == 'get_more_feed_posts' && isset($_POST['start']) && isset($session_user_id)){
		
	$posts = get_user_feed($session_user_id, $_POST['start']);
			
	foreach ($posts[0] as $currentpost) {
		
		if($currentpost['service'] == "ICU"){
			
			display_post($currentpost['id'], 'post', 'service', 'change_time', 'share_post', 'save_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			echo('<br>');
			
		}
		if($currentpost['service'] == "Bone"){
		
			display_post($currentpost['id'], 'post', 'service', 'change_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			echo('<br>');
		
		}
		
		if($currentpost['service'] == "Hole"){
		
			display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'change_time', 'image');
			
			echo('<br>');
		
		
		}
	}
	
	if($posts[1]){
		
		$newstart = $_POST['start'] + 30;
	
		echo('<button class = "btn btn-default" id = "clickmore" onclick = "get_more_feed_posts('.$newstart.')">More Posts</button>');
	
	}
	
}



	
?>