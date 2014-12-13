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

function random_post($community_name){
	
	$community_name = sanitize($community_name);	
	
	$id = mysql_fetch_assoc(mysql_query("SELECT id FROM posts WHERE site = '$community_name' AND status = 1 ORDER BY RAND() LIMIT 1"));
	
	return $id['id'];
}

function submit_post($post_data){

	array_walk($post_data, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($post_data)) . '`';
	$data = '\'' . implode('\', \'', $post_data) . '\'';
	
	save_suspicious_request('submit_post');
	
	return mysql_query("INSERT INTO `posts` ($fields) VALUES ($data)");
	
	
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
	
	$user_for_not = user_id_from_post_id($post_id);
	
	create_notification($user_for_not, "saved_post", "Someone saved your post!", $post_id);
	
	$time = time();
	
	$success = mysql_query("INSERT INTO saved_posts (user_id, post_id, second) VALUES ('$user_id', '$post_id', '$time')");
	

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

function post_text_from_post_id($post_id){
	$post_id = sanitize($post_id);
	
		
	return mysql_result(mysql_query("SELECT `post` FROM `posts` WHERE `id` = '$post_id'"), 0, 'post');
	
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



function get_user_feed($user_id, $start){
	
	$user_id = sanitize($user_id);
	$start = sanitize($start);
	
	$result_saved = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
	
	$all_names = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_names[] = $number['community_name'];		
		
   	}
	
	if(count($all_names) < 1){
		
		return array();
	}
		
	$all_names2 = "'" . implode("','", $all_names) . "'";
		
	$result_posts = mysql_query("SELECT * FROM posts WHERE site IN ($all_names2) AND status = 1 ORDER BY id DESC LIMIT $start,30");
		
	$all_posts = array();
		
    while($number = mysql_fetch_assoc($result_posts)) { 
		$all_posts[] = $number;	
   	}
	
	if(count($all_posts) < 30){
		
		return array($all_posts, false);
		
	}else{
		
		return array($all_posts, true);
		
	}
	

}

function get_more_approved_posts($start, $site, $service){
	
	$start = sanitize($start);
	$site = sanitize($site);
	
	if($service = 'all'){
		
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND site = '$site' ORDER BY ID DESC LIMIT $start,30");
		
	}else{
	
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND site = '$site' AND service = '$service' ORDER BY ID DESC LIMIT $start,30");
		
	}


	$newposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$newposts[] = $number;		
   	}
	
	
	if(count($newposts) < 30){
		
		return array($newposts, false);
		
	}else{
		
		return array($newposts, true);
		
	}
}

function get_posts($status, $site, $type, $admin_id, $service){
	
	$admin_id = sanitize($admin_id);
	$status = sanitize($status);
	$site = sanitize($site);
	$service = sanitize($service);
	
	if($service != 'all'){
		//shit with services
		
		if($type == -1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND service = '$service' ORDER BY ID DESC LIMIT 0, 30");
		
		}
		
		if($type == 0){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND service = '$service' ORDER BY ID DESC");
		
		}
	
		if($service == 'Hole'){
				
			$result = mysql_query("SELECT * FROM posts WHERE status = 2 ORDER BY ID DESC");
	
		}
		
	}else{
		
		//old shit?
	
		if($type == -2){
		
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND judged_by = '$admin_id' ORDER BY ID DESC LIMIT 0, 30");
		
		}
	
		if($type == -1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC LIMIT 0, 30");
		
		}
	
		if($type == 0){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");
		
		}
	
		if($type == 1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC LIMIT 30");
	
		}
	
		if($type == 2){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND judged_by = '$admin_id' ORDER BY ID DESC");
		
		}
		if($type == 3){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");		
		
		}
		if($type == 4){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND flagged = 1 AND judged_by = '$admin_id' ORDER BY ID DESC");
		
		}
	
	}
	
	$allposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allposts[] = $number;		
   	}
	
	if($type == 1){
	
		return $allposts;
	}
	
	if(count($allposts) < 30){
		
		return array($allposts, false);
		
	}else{
		
		return array($allposts, true);
		
	}
}

function reply_post($user_id, $post_id, $message){
	
	$message = sanitize($message);
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$post_id' LIMIT 1"));
	
    $second = time();
		
	$reciever = $result['user_id'];
		
	$post = $result['post'];
	
	$post = sanitize($post);
	
	save_suspicious_request('reply_post');
	
	$success = mysql_query("INSERT INTO messages (recieve_id, send_id, message, prev_message, second, post_id, from_post) VALUES ('$reciever', '$user_id', '$message', '$post', '$second', '$post_id', 1)");
	
	$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$reciever'"));
	
	create_notification($reciever, 'reply_post', 'You have a new message!', $post_id);
	
	return $success;
	
}

function set_reply($post_id, $status_in, $user_id){
	
	$post_id = sanitize($post_id);
	$status_in = sanitize($status_in);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("UPDATE `posts` SET `reply_on` = '$status_in' WHERE `id` = '$post_id' and `user_id` = '$user_id'");	
	
	return $success;	
	
}

function flag($post_id){
	
	$post_id = sanitize($post_id);
	
	$success = mysql_query("UPDATE `posts` SET flagged = 1 WHERE id = '$post_id'");
	
	return $success;
}

function clear_old_posts($community){
	$community = sanitize($community);
	
	$results = mysql_query("SELECT * FROM `posts` WHERE status = 2 AND expired = 0 AND site = '$community'");
    
	while($number = mysql_fetch_assoc($results)) { 
		
		if(empty($number['second_judged']) == false){
		
			if(time() > ($number['second_judged'] + 86400)){
		
				$all_ids[] = $number['id'];		
		
			}
		
		}
   	}
	
	if(!isset($all_ids)){
		
		return false;
	}
	
	$all_ids = "'" . implode("','",$all_ids) . "'";
			
	$result_communities = mysql_query("UPDATE `posts` SET expired = 1 WHERE id IN ($all_ids)");
	
	return true;
	
}



function search_posts($keyword){
	$keyword = sanitize($keyword);
	
	$result = mysql_query("SELECT * FROM posts WHERE post LIKE '%$keyword%' AND status = 1 ORDER BY ID DESC");
	
	$foundposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$foundposts[] = $number;		
   	}
	
	return $foundposts;
}



?>

