<?php

function submit_post($post_data){

	array_walk($post_data, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($post_data)) . '`';
	$data = '\'' . implode('\', \'', $post_data) . '\'';
	
	return mysql_query("INSERT INTO `posts` ($fields) VALUES ($data)") or die(mysql_error());
	
	
}

function get_posts($status, $site, $type){
	
	if($type == 1){
	
		$result = mysql_query("SELECT post FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");
	
	}else{
	
		$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");
		
	}
	
	$allposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allposts[] = $number;		
   	}
	
	return $allposts;
}

function get_user_posts($status, $user_id){
	
	$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND user_id = '$user_id' ORDER BY ID DESC");
	
	$all_posts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_posts[] = $number;		
   	}
	
	return $all_posts;
}


function save_post($user_id, $post_id){
	
	$success = mysql_query("INSERT INTO saved_posts (user_id, post_id) VALUES ('$user_id', '$post_id')") or die(mysql_error());
	
	return $success;
}

function get_user_saved_posts($user_id){
	
	$result_saved = mysql_query("SELECT * FROM saved_posts WHERE user_id = '$user_id'");
	
	$all_ids = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_ids[] = $number['post_id'];		
		
   	}
	
	if(count($all_ids) < 1){
		
		exit();
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
	
	$result_saved = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
	
	$all_names = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_names[] = $number['community_name'];		
		
   	}
	
	if(count($all_names) < 1){
		
		exit();
	}
		
	$all_names2 = "'" . implode("','", $all_names) . "'";
		
	$result_posts = mysql_query("SELECT * FROM posts WHERE site IN ($all_names2) ORDER BY id DESC");
		
	$all_posts = array();
		
    while($number = mysql_fetch_assoc($result_posts)) { 
		$all_posts[] = $number;	
   	}
	
	return $all_posts;

}

function reply_post($user_id, $post_id, $message){
	
	$message = sanitize($message);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$post_id' LIMIT 1"));
	
    $second = time();
	
	$reciever = $result['user_id'];
		
	$post = $result['post'];
	
	$success = mysql_query("INSERT INTO messages (recieve_id, send_id, message, prev_message, second) VALUES ('$reciever', '$user_id', '$message', '$post', '$second')") or die(mysql_error());
	
	return $success;
	
	
}


?>