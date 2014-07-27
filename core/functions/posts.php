<?php

function count_replies($post_id, $type){
	$post_id = sanitize($post_id);	
	
	//direct
	if($type == 0){
	
		$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM messages WHERE post_id = '$post_id' AND from_post = 1"));
	
	}
	if($type == 1){
	
		$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM messages WHERE post_id = '$post_id' AND from_post = 0"));
	
	}
	
	return ($count['total']);
}

function count_saved($post_id){
	
	$post_id = sanitize($post_id);	
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM saved_posts WHERE post_id = '$post_id'"));
	
	return ($count['total']);
	
	
}

function submit_post($post_data){

	array_walk($post_data, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($post_data)) . '`';
	$data = '\'' . implode('\', \'', $post_data) . '\'';
	
	save_suspicious_request('submit_post');
	
	return mysql_query("INSERT INTO `posts` ($fields) VALUES ($data)") or die(mysql_error());
	
	
}


function get_user_posts($status, $user_id){
	
	$status = sanitize($status);
	$user_id = sanitize($user_id);
	
	$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND user_id = '$user_id' ORDER BY ID DESC");
	
	$all_posts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_posts[] = $number;		
   	}
	
	return $all_posts;
}


function save_post($user_id, $post_id){
	
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("INSERT INTO saved_posts (user_id, post_id) VALUES ('$user_id', '$post_id')") or die(mysql_error());
	
	return $success;
}

function unsave_post($user_id, $post_id){
	
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("DELETE FROM `saved_posts` WHERE `user_id` = '$user_id' AND `post_id` = '$post_id'");
	
	return $success;
}

function delete_post($user_id, $post_id){
	
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("DELETE FROM `posts` WHERE `user_id` = '$user_id' AND `id` = '$post_id'");
	
	return $success;
}

function get_user_saved_posts($user_id){
	
	$user_id = sanitize($user_id);
	
	$result_saved = mysql_query("SELECT * FROM saved_posts WHERE user_id = '$user_id'");
	
	$all_ids = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_ids[] = $number['post_id'];		
		
   	}
	
	if(count($all_ids) < 1){
		
		return array();
	}
	
	$all_ids = implode(",",$all_ids);
		
	$result_posts = mysql_query("SELECT * FROM posts WHERE id IN ($all_ids)");
	
	$all_posts = array();
		
    while($number = mysql_fetch_assoc($result_posts)) { 
		$all_posts[] = $number;	
   	}
	
	return $all_posts;

}


function get_user_feed($user_id){
	
	$user_id = sanitize($user_id);
	
	$result_saved = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
	
	$all_names = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_names[] = $number['community_name'];		
		
   	}
	
	if(count($all_names) < 1){
		
		return array();
	}
		
	$all_names2 = "'" . implode("','", $all_names) . "'";
		
	$result_posts = mysql_query("SELECT * FROM posts WHERE site IN ($all_names2) AND status = 1 ORDER BY id DESC");
		
	$all_posts = array();
		
    while($number = mysql_fetch_assoc($result_posts)) { 
		$all_posts[] = $number;	
   	}
	
	return $all_posts;

}

function get_posts($status, $site, $type, $admin_id){
	
	$status = sanitize($status);
	$site = sanitize($site);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");
		
	}
	
	if($type == 1){
	
		$result = mysql_query("SELECT post FROM posts WHERE status = '$status' AND site = '$site' AND expired = 0 ORDER BY ID DESC");
	
	}
	
	if($type == 2){
	
		$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND judged_by = '$admin_id' ORDER BY ID DESC");
		
	}
	if($type == 3){
	
		$result = mysql_query("SELECT post FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");		
		
	}
	if($type == 4){
	
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND flagged = 1 AND judged_by = '$admin_id' ORDER BY ID DESC");
		
	}
	
	$allposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allposts[] = $number;		
   	}
	
	return $allposts;
}

function reply_post($user_id, $post_id, $message){
	
	$message = sanitize($message);
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$post_id' LIMIT 1"));
	
    $second = time();
		
	$reciever = $result['user_id'];
		
	$post = $result['post'];
	
	save_suspicious_request('reply_post');
	
	$success = mysql_query("INSERT INTO messages (recieve_id, send_id, message, prev_message, second, post_id, from_post) VALUES ('$reciever', '$user_id', '$message', '$post', '$second', '$post_id', 1)") or die(mysql_error());
	
	$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$reciever'"));
	
	create_notification($reciever, 'reply_post', 'You have a new message!', $theid['id']);
	
	return $success;
	
	
}

function set_reply($post_id, $status_in, $user_id){
	
	$post_id = sanitize($post_id);
	$status_in = sanitize($status_in);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("UPDATE `posts` SET `reply_on` = '$status_in' WHERE `id` = '$post_id' and `user_id` = '$user_id'");	
	
	return $success;	
	
}

function flag($post_id, $user_id){
	
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("UPDATE `posts` SET flagged = 1 WHERE id = '$post_id' AND user_id = '$user_id'");
	
	return $success;
}


?>