<?php

function get_user_messages($user_id, $status, $type){
	
	$user_id = sanitize($user_id);
	$status = sanitize($status);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM messages WHERE recieve_id = '$user_id' AND status = 0 ORDER BY ID DESC");
	
	}
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM messages WHERE send_id = '$user_id' AND status = 0 ORDER BY ID DESC");
		
	}
	
	$all_messages = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_messages[] = $number;		
   	}
	
	return $all_messages;
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
	
	$success = mysql_query("INSERT INTO messages (recieve_id, send_id, message, prev_message, second, post_id, from_post) VALUES ('$reciever', '$user_id', '$message', '$prev_message', '$second', '$post_id', 0)") or die(mysql_error());
	
	mysql_query("UPDATE `messages` SET `status` = 2 WHERE `id` = '$message_id'");		
	
	return $success;
	
	
}

function delete_message($message_id, $user_id, $type){
	
	$message_id = sanitize($message_id);
	$user_id = sanitize($user_id);	
	
	if($type == 0){
	
		$success = mysql_query("UPDATE `messages` SET `status` = 3, `message` = ' ',  `prev_message` = ' ' WHERE `id` = '$message_id' AND `recieve_id` = '$user_id'");	
	
	}
	if($type == 1){
		
		$success = mysql_query("UPDATE `messages` SET `status` = 3, `message` = ' ',  `prev_message` = ' ' WHERE `id` = '$message_id' AND `send_id` = '$user_id'") or die(mysql_error());
		
	}	
	
	return $success;

}

?>
