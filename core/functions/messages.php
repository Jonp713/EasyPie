<?php

function message_from_message_id($message_id){
	$message_id = sanitize($message_id);
	
	return mysql_result(mysql_query("SELECT `message` FROM `messages` WHERE `id` = '$message_id'"), 0, 'message');
}
function prev_message_from_message_id($message_id){
	$message_id = sanitize($message_id);
	
	return mysql_result(mysql_query("SELECT `prev_message` FROM `messages` WHERE `id` = '$message_id'"), 0, 'prev_message');
}

function get_user_messages($user_id, $status, $type){
	
	$user_id = sanitize($user_id);
	$status = sanitize($status);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM messages WHERE recieve_id = '$user_id' AND status = 0 AND expired = 0 ORDER BY ID DESC");
	
	}
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM messages WHERE send_id = '$user_id' AND status = 0 AND expired = 0 ORDER BY ID DESC");
		
	}
	
	$all_messages = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_messages[] = $number;		
   	}
	
	return $all_messages;
}

function admin_initials_from_admin_id($admin_id){
	$admin_id = sanitize($admin_id);
	
	return mysql_result(mysql_query("SELECT `initials` FROM `cementsalesmen` WHERE `id` = '$admin_id'"), 0, 'initials');
	
}

function reply_message($user_id, $message_id, $message){
	
	$message = sanitize($message);
	$user_id = sanitize($user_id);
	$message_id = sanitize($message_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM messages WHERE id = '$message_id' and recieve_id = '$user_id' LIMIT 1"));
	
    $second = sanitize(time());
	$reciever = sanitize($result['send_id']);
	$prev_message = sanitize($result['message']);
	$post_id = sanitize($result['post_id']);
	
	$success = mysql_query("INSERT INTO messages (recieve_id, send_id, message, prev_message, second, post_id, from_post) VALUES ('$reciever', '$user_id', '$message', '$prev_message', '$second', '$post_id', 0)");
	
	mysql_query("UPDATE `messages` SET `status` = 2 WHERE `id` = '$message_id'");	
	
	$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$reciever'"));
		
	create_notification($reciever, 'reply_message', 'You have a new message!', $post_id);
	
	return $success;
	
	
}

function delete_message($message_id, $user_id, $type){
	
	$message_id = sanitize($message_id);
	$user_id = sanitize($user_id);	
	$type = sanitize($type);
	
	if($type == 0){
	
		$success = mysql_query("UPDATE `messages` SET `status` = 3, `message` = ' ',  `prev_message` = ' ' WHERE `id` = '$message_id' AND `recieve_id` = '$user_id'");	
	
	}
	if($type == 1){
		
		$success = mysql_query("UPDATE `messages` SET `status` = 3, `message` = ' ',  `prev_message` = ' ' WHERE `id` = '$message_id' AND `send_id` = '$user_id'");
		
	}	
	
	return $success;

}

function clear_old_messages($user_id){
	$user_id = sanitize($user_id);
	
	$results = mysql_query("SELECT * FROM `messages` WHERE status = 0 AND recieve_id = '$user_id'");
    
	while($number = mysql_fetch_assoc($results)) { 
		
		if(time() > ($number['second'] + 604800)){

			$all_ids[] = $number['id'];		
		
		}
   	}
	
	if(!isset($all_ids)){
		
		return false;
	}
	
	$all_ids = "'" . implode("','",$all_ids) . "'";
			
	$result_communities = mysql_query("UPDATE `messages` SET expired = 1 WHERE id IN ($all_ids)");
	
	return true;
	
}


?>
