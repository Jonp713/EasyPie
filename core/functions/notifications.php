<?php

function get_notifications($user_id, $type){
	
	
}
	
function count_notifications($user_id){
	
	$user_id = sanitize($user_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM notifications WHERE user = '$user_id' AND seen = 0"));
	
	return $result['total'];
	
}

function notification_seen($id, $user_id){
	$id = sanitize($id);
	$user_id = sanitize($user_id);
	
	mysql_query("UPDATE notifications SET seen = 1 WHERE id = '$id' AND user_id = '$user_id'");
	
}

function create_notification($user_id, $type, $textin, $ref_id){
	
	$success = mysql_query("INSERT INTO notifications (user_id, type, textin, ref_id) VALUES ('$user_id', '$type', '$textin', '$ref_id')") or die(mysql_error());
	
	return $success;
	
}
	
	
?>