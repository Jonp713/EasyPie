<?php


function user_moderates_service($service_name, $community_name, $user_id){
	
	$service_name = sanitize($service_name);
	$community_name = sanitize($community_name);
	$user_id = sanitize($user_id);
	
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `admins` WHERE `user_id` = '$user_id' AND service_name = '$service_name' AND community_name = '$community_name' AND type = 'moderator'"), 0) >= 1) ? true : false;
	
	
}

function user_owns_service($service_name, $user_id){
	$user_id = sanitize($user_id);
	$service_name = sanitize($service_name);
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `admins` WHERE `user_id` = '$user_id' AND service_name = '$service_name' AND type = 'owner'"), 0) >= 1) ? true : false;
	
	
}

function has_moderator($service_name, $community_name){
	
	$service_name = sanitize($service_name);
	$community_name = sanitize($community_name);
	
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `admins` WHERE service_name = '$service_name' AND community_name = '$community_name' AND type = 'moderator'"), 0) > 0) ? true : false;
	
	
}

function user_oversees_community($community_name, $user_id){
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `admins` WHERE `user_id` = '$user_id' AND community_name = '$community_name' AND type = 'overseer'"), 0) >= 1) ? true : false;
	
	
}

function find_moderator_ids_from_service_and_community_name($service_name, $community_name){
	$service_name = sanitize($service_name);
	$community_name = sanitize($community_name);
	
	$result = mysql_query("SELECT * FROM admins WHERE community_name = '$community_name' AND service_name = '$service_name' AND type = 'moderator'");
	
	$all_ids = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		
		if(!in_array($number['user_id'], $all_ids)){
			
			$all_ids[] = $number['user_id'];	
			
		}
		
			
   	}
	
	if(count($all_ids) < 1){
		
		return array();
	}
	
	return $all_ids;
	
}

function find_moderator_ids_from_service_name($service_name){
	$service_name = sanitize($service_name);
	
	$result = mysql_query("SELECT * FROM admins WHERE service_name = '$service_name'");
	
	$all_ids = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		
		if(!in_array($number['user_id'], $all_ids)){
			
			$all_ids[] = $number['user_id'];	
			
		}
		
			
   	}
	
	if(count($all_ids) < 1){
		
		return array();
	}
	
	return $all_ids;
	
}


function judgement_user($post_id, $judgement, $admin_id){
		
		$post_id = sanitize($post_id);
		$judgement = sanitize($judgement);
		$admin_id = sanitize($admin_id);
	
		$time = time();
			
		if($judgement != 2){
		
			$success = mysql_query("UPDATE `posts` SET `status` = '$judgement', `judged_by` = '$admin_id', `second_judged` = '$time' WHERE `id` = '$post_id'") or die(mysql_error());
	
		
		}else{
		
			$success = mysql_query("UPDATE `posts` SET `status` = 2, `judged_by` = '$admin_id', `second_judged` = '$time' AND is_home = 0 AND service = 'Hole' WHERE `id` = '$post_id'") or die(mysql_error());
		
		}
	
		if($success and $judgement == 1){
		
			$user_id = user_id_from_post_id($post_id);
		
			if($user_id !== 0 && $user_id !== null){
		
				create_notification($user_id, 'post_approved', 'Your post got approved!', $post_id);
		
			}
	
		}
	
		return $success;
	

	
}

function get_mod_services($user_id, $type){
	
	$user_id = sanitize($user_id);
	
	if($type == "owner"){
	
		$result_moderated = mysql_query("SELECT * FROM admins WHERE user_id = '$user_id' AND type = 'owner'");
	
	}
	
	if($type == "moderator"){
	
		$result_moderated = mysql_query("SELECT * FROM admins WHERE user_id = '$user_id' AND type = 'moderator'");
	
	}

    while($number = mysql_fetch_assoc($result_moderated)) { 
		
		$all_names[] = $number['service_name'];	
	
   	}

	if(!isset($all_names)){

		return array();
	}

	$all_names = "'" . implode("','",$all_names) . "'";
	
	if($type == "owner"){
	
		$result_services = mysql_query("SELECT * FROM `services` WHERE name IN ($all_names) AND core = 1");
	
	}
	if($type == "moderator"){
		
		$home = get_home_from_user_id($user_id);
		
		$result_services = mysql_query("SELECT * FROM `services` WHERE name IN ($all_names) AND core = 0 AND community = '$home'");
		
	}

	$all_services = array();

    while($number = mysql_fetch_assoc($result_services)) { 
		$all_services[] = $number;	
   	}

	return $all_services;


}

function get_mod_communities($user_id, $type){
	
	$user_id = sanitize($user_id);

	$result_moderated = mysql_query("SELECT * FROM admins WHERE user_id = '$user_id' AND type = 'overseer'");

    while($number = mysql_fetch_assoc($result_moderated)) { 
		
		$all_names[] = $number['community_name'];		
	
   	}

	if(!isset($all_names)){

		return array();
	}

	$all_names = "'" . implode("','",$all_names) . "'";
	
	if($type == "overseer"){
	
		$result_communities = mysql_query("SELECT * FROM `communities` WHERE name IN ($all_names)");
	
	}

	$all_communities = array();

    while($number = mysql_fetch_assoc($result_communities)) { 
		$all_communities[] = $number;	
   	}

	return $all_communities;


}


function check_mod_power($user_id){
	$user_id = sanitize($user_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT admin FROM users WHERE user_id = '$user_id' LIMIT 1"));
	
	return $result['admin'];
	
}

function create_mod($register_data) {
	array_walk($register_data, 'array_sanitize');
				
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	mysql_query("INSERT INTO `admins` ($fields) VALUES ($data)");
	
}


?>