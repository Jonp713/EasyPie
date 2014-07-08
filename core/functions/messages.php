<?php

function get_user_messages($user_id, $status){
	
	$result = mysql_query("SELECT * FROM messages WHERE recieve_id = '$user_id' AND status = 0 ORDER BY ID DESC");
	
	$all_messages = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_messages[] = $number;		
   	}
	
	return $all_messages;
}

function reply_message($user_id, $message_id, $message){
	
	$message = sanitize($message);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM messages WHERE id = '$message_id' LIMIT 1"));
	
    $second = time();
	
	$reciever = $result['send_id'];
		
	$prev_message = $result['message'];
	
	$success = mysql_query("INSERT INTO messages (recieve_id, send_id, message, prev_message, second) VALUES ('$reciever', '$user_id', '$message', '$prev_message', '$second')") or die(mysql_error());
	
	mysql_query("UPDATE `messages` SET `status` = 2 WHERE `id` = '$message_id'");		
	
	return $success;
	
	
}

?>
