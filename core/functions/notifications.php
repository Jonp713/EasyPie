<?php

function get_notifications($user_id, $type){
	
	$type = sanitize($type);
	$user_id = sanitize($user_id);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM notifications WHERE user_id = '$user_id' AND seen = 0 ORDER BY ID DESC");
		
	}
	
	$allnotifications = array();

    while($number = mysql_fetch_assoc($result)) { 
		$allnotifications[] = $number;		
   	}

	return $allnotifications;
		
	
}
	
function count_notifications($user_id){
	
	$user_id = sanitize($user_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM notifications WHERE user_id = '$user_id' AND seen = 0"));
	
	return $result['total'];
	
}

function notification_seen($id, $user_id){
	$id = sanitize($id);
	$user_id = sanitize($user_id);
	
	mysql_query("UPDATE notifications SET seen = 1 WHERE id = '$id' AND user_id = '$user_id'");
	
}

function create_notification($user_id, $type, $textin, $ref_id){
	$type = sanitize($type);
	$user_id = sanitize($user_id);
	$textin = sanitize($textin);
	$ref_id = sanitize($ref_id);
	
	$time = time();
		
	$success = mysql_query("INSERT INTO notifications (user_id, type, textin, ref_id, second) VALUES ('$user_id', '$type', '$textin', '$ref_id', '$time')") or die(mysql_error());
	
	return $success;
	
}
	
	
?>