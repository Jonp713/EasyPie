<?php

function delete_service($service_id, $admin_id){
	
	$service_id = sanitize($service_id);
	
	$data = mysql_fetch_assoc(mysql_query("SELECT name, community FROM services WHERE id = '$service_id'"));

	$service = $data['name'];
	
	if(check_admin_power($admin_id) > 0){
	
		create_owner_notification($service, 'got_defranchised', 'The board '.$service.' was deleted by Matropolix admins', null);
	
		mysql_query("DELETE FROM admins WHERE service_name = '$service'");
	
		mysql_query("DELETE FROM services WHERE name = '$service'");
	
		mysql_query("DELETE FROM subscriptions WHERE service = '$service'");
		
	
		mysql_query("UPDATE posts SET is_home = 0, status = 3 WHERE service = '$service' AND status <> 2 AND status <> 3");
	
	}
	
}

function defranchise_service($service_id, $admin_id){
	
	//if(check_admin_power($admin_id) >= 0){
					
		$service_id = sanitize($service_id);	
		$data = mysql_fetch_assoc(mysql_query("SELECT name, community FROM services WHERE id = '$service_id'"));

		$community = $data['community'];
		$service = $data['name'];
		
		create_mod_notification($service, $community, 'got_defranchised', 'Hey, sorry, the community overseer defranchised your board ' . $service, null);
	
		mysql_query("DELETE FROM admins WHERE community_name = '$community' AND service_name = '$service' AND type = 'moderator'");
	
		mysql_query("DELETE FROM services WHERE community = '$community' AND name = '$service' AND core = 0");
	
		mysql_query("DELETE FROM subscriptions WHERE community_name = '$community' AND service = '$service'");
	
		mysql_query("UPDATE posts SET is_home = 0 WHERE site = '$community' AND service = '$service' AND status <> 2 AND status <> 3");
	
		//}
	
	
	
	
}

function change_home($service, $admin_id, $change){
	
	$service = sanitize($service);	

	$result = mysql_fetch_assoc(mysql_query("SELECT community FROM cementsalesmen WHERE id = '$admin_id' LIMIT 1"));

	$community = $result['community'];
	$change = sanitize($change);
	
	mysql_query("UPDATE services SET is_home = '$change' WHERE id = '$service' AND community = '$community'");
	
	$service_name = get_service_name_from_service_id($service);
	
	if($change == 1){
	
			create_mod_notification($service_name, $community, 'home_change', 'Congratulations! Your board '.$service_name.' was added to the ' . $community .' home feed', $service);
		
	}else{
		
			create_mod_notification($service_name, $community, 'home_change', 'Unfortunately, '.$service_name.' was removed from the ' . $community .' home feed', $service);
			
			mysql_query("UPDATE posts SET is_home = 0 WHERE site = '$community' AND service = '$service_name' AND status <> 2 AND status <> 3");
	}
	
}

function message_moderators($service, $message, $admin_id){
	
	$message = sanitize($message);
	$service = sanitize($service);
	$admin_id = sanitize($admin_id);
	
	$community = mysql_fetch_assoc(mysql_query("SELECT community FROM cementsalesmen WHERE id = '$admin_id"));
	
	$community = $community['community'];
	
	$mod_ids = find_moderator_ids_from_service_and_community_name($service, $community);
	
	$time = time();
    $second = sanitize(time());
	
	foreach ($mod_ids as $current_id) {
	
		$success = mysql_query("INSERT INTO messages (recieve_id, message, second, from_post, admin_id) VALUES ('$current_id', '$message', '$second', 4, '$admin_id')") or die(mysql_error());
	
		$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$current_id'") or die(mysql_error()));
	
		create_notification($current_id, 'admin_message', 'You have a new message!', $theid['id']);
		
	}
	

}

function message_owners($service, $message, $admin_id){
	
	$message = sanitize($message);
	$service = sanitize($service);
	$admin_id = sanitize($admin_id);
	
	$mod_ids = find_moderator_ids_from_service_name($service);
	
	$time = time();
    $second = sanitize(time());
	
	foreach ($mod_ids as $current_id) {
	
		$success = mysql_query("INSERT INTO messages (recieve_id, message, second, from_post, admin_id) VALUES ('$current_id', '$message', '$second', 4, '$admin_id')");
	
		$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$current_id'"));
	
		create_notification($current_id, 'admin_message', 'You have a new message!', $theid['id']);
		
	}
}


?>