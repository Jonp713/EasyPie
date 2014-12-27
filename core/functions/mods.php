<?php

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
		
		$result_services = mysql_query("SELECT * FROM `services` WHERE name IN ($all_names) AND core = 0");
		
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