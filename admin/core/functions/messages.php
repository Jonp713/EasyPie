<?php
	
function admin_reply($post_id, $message, $admin_id){
	$post_id = sanitize($post_id);
	
	$user_id = user_id_from_post_id($post_id);
	
	$message = sanitize($message);
	$admin_id = sanitize($admin_id);
		
	$result = mysql_fetch_assoc(mysql_query("SELECT post FROM posts WHERE id = '$post_id' LIMIT 1"));
	
	$post = $result["post"];
    $second = sanitize(time());
	
	$success = mysql_query("INSERT INTO messages (recieve_id, message, prev_message, second, post_id, from_post, admin_id) VALUES ('$user_id', '$message', '$post', '$second', '$post_id', 3, '$admin_id')") or die(mysql_error());
	
	$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$user_id'"));
	
	create_notification($user_id, 'admin_reply', 'You have a new message!', $theid['id']);
	
	return $success;
	
}

function send_admin_message($user_id, $message, $admin_id){
	$user_id = sanitize($user_id);
	$message = sanitize($message);
	$admin_id = sanitize($admin_id);
		
    $second = sanitize(time());
	
	$success = mysql_query("INSERT INTO messages (recieve_id, message, second, from_post, admin_id) VALUES ('$user_id', '$message', '$second', 4, '$admin_id')") or die(mysql_error());
	
	$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$user_id'"));
	
	create_notification($user_id, 'admin_message', 'You have a new message!', $theid['id']);
	
	return $success;
	
}
	
	
	
?>