<?php

function create_community($community_data){
	
	array_walk($community_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($community_data)) . '`';
	$data = '\'' . implode('\', \'', $community_data) . '\'';

	mysql_query("INSERT INTO `communities` ($fields) VALUES ($data)");
	
}
	
	
	
function community_exists($name) {
	$name = sanitize($name);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `communities` WHERE `name` = '$name'"), 0) == 1) ? true : false;
}
	
	
function get_communities($type, $state){
	
	if($type == 1){
	
		$result = mysql_query("SELECT * FROM communities WHERE state = '$state' ORDER BY state DESC");
	
	}else{
	
		$result = mysql_query("SELECT * FROM communities ORDER BY state DESC");
		
	}
	
	$allcommunities = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allcommunities[] = $number;		
   	}
	
	return $allcommunities;
}

function subscribe_community($user_id, $community_name){
	
	$success = mysql_query("INSERT INTO subscriptions (user_id, community_name) VALUES ('$user_id', '$community_name')") or die(mysql_error());
	
	return $success;
}

function user_subscribed($user_id, $community) {	
	
	return (mysql_result(mysql_query("SELECT COUNT('id') FROM `subscriptions` WHERE `user_id` = '$user_id' AND `community_name` = '$community'"), 0) == 1) ? true : false;
	
}
	
?>