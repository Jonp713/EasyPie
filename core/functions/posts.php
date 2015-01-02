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

function submit_post($post_data, $post_text){

	array_walk($post_data, 'array_sanitize');
		
	//$post_text = nl2br($post_text);
	
	$post_text = mysql_real_escape_string(nl2br(htmlentities($post_text)));
			
	$post_data['post'] = $post_text;
	
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

function check_saved($post_id, $user_id){
	
		$post_id = sanitize($post_id);
		
		$user_id = sanitize($user_id);
				
		return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `saved_posts` WHERE `user_id` = $user_id AND `post_id` = $post_id"), 0) >= 1) ? true : false;

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


function community_name_from_post_id($post_id){
	$post_id = sanitize($post_id);
	
	return mysql_result(mysql_query("SELECT `site` FROM `posts` WHERE `id` = '$post_id'"), 0, 'site');
	
}

function service_name_from_post_id($post_id){
	$post_id = sanitize($post_id);
	
	return mysql_result(mysql_query("SELECT `service` FROM `posts` WHERE `id` = '$post_id'"), 0, 'service');
	
}

function status_from_post_id($post_id){
	$post_id = sanitize($post_id);
	
	return mysql_result(mysql_query("SELECT `status` FROM `posts` WHERE `id` = '$post_id'"), 0, 'status');
	
}

function upvotes_from_post_id($post_id){
	$post_id = sanitize($post_id);
	
	return mysql_result(mysql_query("SELECT `upvotes` FROM `posts` WHERE `id` = '$post_id'"), 0, 'upvotes');
	
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



function get_user_feed($user_id, $start, $status){
	
	$user_id = sanitize($user_id);
	$start = sanitize($start);
	$status = sanitize($status);
	
	
	$result_saved = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
	
	$all_names = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_names[] = $number['community_name'];	
		$all_services[] = $number['service'];		
		
   	}
	
	if(count($all_names) < 1){
		
		return array();
	}
			
	$all_names2 = "'" . implode("','", $all_names) . "'";
		
	$all_services2 = "'" . implode("','", $all_services) . "'";
	
	if($status != 0){
		
		$result_posts = mysql_query("SELECT * FROM posts WHERE site IN ($all_names2) AND service IN ($all_services2) AND (status = '$status' OR service = 'Hole') ORDER BY coolness DESC, id DESC LIMIT $start,5");
	
	}else{
		
		$result_posts = mysql_query("SELECT * FROM posts WHERE site IN ($all_names2) AND service IN ($all_services2) AND status = '$status' AND service <> 'Hole') ORDER BY coolness DESC, id DESC LIMIT $start,5");
		
	}
		
	$all_posts = array();
		
    while($number = mysql_fetch_assoc($result_posts)) { 
		$all_posts[] = $number;	
   	}
	
	if(count($all_posts) < 5){
		
		return array($all_posts, false);
		
	}else{
		
		return array($all_posts, true);
		
	}
	

}

function get_more_approved_posts($start, $site, $service){
	
	$start = sanitize($start);
	$site = sanitize($site);
	$service = sanitize($service);
	
	if($service === 'all'){
		
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND is_home = 1 AND site = '$site' ORDER BY coolness DESC, id DESC LIMIT $start,5");
		
	}else{
		
		if($service === 'Hole'){
			
			$result = mysql_query("SELECT * FROM posts WHERE status <> 3 AND site = '$site' AND service = '$service' ORDER BY ID DESC LIMIT $start,5");
			
		}else if($service === "Events"){
	
	$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND site = '$site' AND service = '$service' ORDER BY start_second LIMIT $start,5");
			
		}else{
			
			$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND site = '$site' AND service = '$service' ORDER BY ID DESC LIMIT $start,5");
		}
	
		
	}


	$newposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$newposts[] = $number;		
   	}
	
	
	if(count($newposts) < 5){
		
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
		
		
		if($type == -2){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND service = '$service' ORDER BY ID DESC");
		
		}
		
		
		if($type == -1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND service = '$service' ORDER BY ID DESC LIMIT 0, 5");
		
		}
		
		if($type == 0){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND service = '$service' ORDER BY ID DESC");
		
		}
	
		if($service == 'Hole'){
				
			$result = mysql_query("SELECT * FROM posts WHERE (service = 'Hole' OR status = 2) AND status <> 3 AND site = '$site' ORDER BY ID DESC LIMIT 0,5");
			
			
			
		}
		
		if($service == "Events"){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND service = '$service' AND time_status <> 2 ORDER BY start_second LIMIT 0,5");
		}
		
	}else{
		
		//old shit?
		

		
		if($type == -3){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND is_home = 1 AND needs_approve = 0");
		
		}
	
		if($type == -2){
		
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND judged_by = '$admin_id' ORDER BY ID DESC LIMIT 0, 5");
		
		}
	
		if($type == -1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND is_home = 1 ORDER BY coolness DESC, id DESC LIMIT 0,5");
		
		}
	
		if($type == 0){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");
		
		}
	
		if($type == 1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC LIMIT 10");
	
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
	
	if(count($allposts) < 5){
		
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


function set_comments($post_id, $status_in, $user_id){
	
	$post_id = sanitize($post_id);
	$status_in = sanitize($status_in);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("UPDATE `posts` SET `allow_comments` = '$status_in' WHERE `id` = '$post_id' and `user_id` = '$user_id'");	
	
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

function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);

    		if ($info['mime'] == 'image/jpeg'){
        			$image = imagecreatefromjpeg($source_url);
		    		imagejpeg($image, $destination_url, $quality);
					
				}

    		if ($info['mime'] == 'image/gif'){
        			$image = imagecreatefromgif($source_url);
		    		imagegif($image, $destination_url);
					
				}

			if ($info['mime'] == 'image/png'){
    			$image = imagecreatefrompng($source_url);
	    		imagepng($image, $destination_url, $quality);
				
				
			}
			
			
		return $destination_url;
}




function upload_image_post($type, $file_temp, $file_extn){
	$file_temp = sanitize($file_temp);
	$file_extn = sanitize($file_extn);
	$type = sanitize($type);
	
	
	$file_path = 'images/posts/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
	
	
	move_uploaded_file($file_temp, $file_path);
	
	
	if(filesize($file_path) > 3000000){
													
		compress_image($file_path, $file_path, 30);
	
	}
		
	$success = mysql_query("INSERT INTO pictures (url, type) VALUES ('$file_path', '$type')") or die(mysql_error());
	
	
	return $file_path;
	
}


function time_check($community){
	$community = sanitize($community);
	
	$results = mysql_query("SELECT * FROM `posts` WHERE status = 1 AND time_status <> 2 AND site = '$community' AND is_event = 1");
    
	while($number = mysql_fetch_assoc($results)) { 
	
		if(time() > ($number['end_second'])){
			
			
			if($number['recurring_type'] != "Not" && time() < $number['recurring_end']){
				
				$new_start_seconds = time();
				
				switch($number['recurring_type']){
					case "Weekly":
					
						$new_start_seconds = $number['start_second'] + 604800;
					
					break;
					case "Bi-Weekly":
					
						$new_start_seconds = $number['start_second'] + 1209600;
					
					break;
					
				}
				
				$id = $number['id'];
				
				$duration = $number['end_second'] - $number['start_second'];
				
				$new_end_seconds = $new_start_seconds + $duration;
				
				mysql_query("UPDATE `posts` SET start_second = '$new_start_seconds' WHERE id = '$id'");
				mysql_query("UPDATE `posts` SET end_second = '$new_end_seconds' WHERE id = '$id'");
				mysql_query("UPDATE `posts` SET time_status = 0 WHERE id = '$id'");
				
				create_notification($number['user_id'], "post_approved", "Your event " . $number['title'] . " has been renewed!", $id);
				
				
			}else{
			
			

				$all_ids_old[] = $number['id'];		
			
			}

		}
		if(time() < ($number['end_second']) && time() > ($number['start_second']) ){

			$all_ids_now[] = $number['id'];		
			
		}
	}
	
	if(!isset($all_ids_old) ){
		
		
	}else{
	
		$all_ids_old = "'" . implode("','",$all_ids_old) . "'";
		
			
		$result_communities = mysql_query("UPDATE `posts` SET time_status = 2 WHERE id IN ($all_ids_old)");
					
	}
	
	if(!isset($all_ids_now) ){
		
		
	}else{
	
		$all_ids_now = "'" . implode("','",$all_ids_now) . "'";
			
		$result_communities = mysql_query("UPDATE `posts` SET time_status = 1 WHERE id IN ($all_ids_now)");
	
		
	}

	
}

function count_total_live_events($community){
	$community = sanitize($community);
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM posts WHERE site = '$community' AND time_status = 1"));
	
	return ($count['total']);
	
}

function sort_coolness($site){
	
	$result = mysql_fetch_assoc(mysql_query("SELECT last_sort_seconds FROM `sort_manager` LIMIT 1"));
	
	$now = time();
	
	if(time() > $result['last_sort_seconds'] + 10000){
	
		$result = mysql_query("SELECT * FROM `posts` WHERE site = '$site' AND coolness > 0");
	
		$second_value = 0;
			
		$allposts = array();
	
	    while($number = mysql_fetch_assoc($result)) { 
			$allposts[] = $number;		
	   	}
	
	
		foreach ($allposts as $currentpost) {
		
			$coolness = 0;
	
			//seconds
			$seconds = $now - $currentpost['second'];		
		
			if($seconds > 518400){
			
				$coolness = 0; // :(
			
			}else{
	
				$second_value = 518400 - $seconds;
	
				$second_value = $second_value/51840;
					
				//upvotes
				$upvotes = $currentpost['upvotes'];
	
				$upvote_value = $currentpost['upvotes']/2;
		
	
				$coolness = $upvote_value + $second_value;
			
			}
			
				
			$id = $currentpost['id'];
		
			$result = mysql_query("UPDATE posts SET coolness = '$coolness' WHERE id = $id");
		
		
		
		}
		
	}
	
	$result = mysql_query("UPDATE sort_manager SET last_sort_seconds = '$now'");

}


?>

