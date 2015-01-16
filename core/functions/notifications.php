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
		
	$success = mysql_query("INSERT INTO notifications (user_id, type, textin, ref_id, second) VALUES ('$user_id', '$type', '$textin', '$ref_id', '$time')");
		
	return $success;
	
}


function create_mod_notification($service, $community, $type, $textin, $ref_id){
	$type = sanitize($type);
	$textin = sanitize($textin);
	$ref_id = sanitize($ref_id);
	$service = sanitize($service);
	$community = sanitize($community);
	
	if($community == null){
		
		$community = get_site_from_post_id($post_id);
	}
	
	$mod_ids = find_moderator_ids_from_service_and_community_name($service, $community);
	
	$time = time();
	
	foreach ($mod_ids as $current_id) {
	
		$success = mysql_query("INSERT INTO notifications (user_id, type, textin, ref_id, second) VALUES ('$current_id', '$type', '$textin', '$ref_id', '$time')");
		
		
	}	
	
}

function create_owner_notification($service, $type, $textin, $ref_id){
	$type = sanitize($type);
	$textin = sanitize($textin);
	$ref_id = sanitize($ref_id);
	$service = sanitize($service);

	$mod_ids = find_moderator_ids_from_service_name($service);
	
	$time = time();
	
	foreach ($mod_ids as $current_id) {
	
		$success = mysql_query("INSERT INTO notifications (user_id, type, textin, ref_id, second) VALUES ('$current_id', '$type', '$textin', '$ref_id', '$time')");
		
		
	}	
	
}
	
	
?>