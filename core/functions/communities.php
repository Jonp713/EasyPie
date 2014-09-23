<?php

function community_sub_count($community_name){
	$community_name = sanitize($community_name);
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(user_id) AS totalsubs FROM subscriptions WHERE community_name = '$community_name'"));
	
	return ($count['totalsubs']);
}

function community_queue_count($community_name){
	$community_name = sanitize($community_name);
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS totalqueue FROM posts WHERE site = '$community_name' AND status = 0"));
	
	return ($count['totalqueue']);
}

function community_data($community_name) {
	$data = array();
	$community_name = (string)$community_name;
	$community_name = sanitize($community_name);
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	array_walk($func_get_args, 'array_sanitize');
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `communities` WHERE `name` = '$community_name'"));
		
		return $data;
	}
}


function create_community($community_data){
	
	array_walk($community_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($community_data)) . '`';
	$data = '\'' . implode('\', \'', $community_data) . '\'';

	mysql_query("INSERT INTO `communities` ($fields) VALUES ($data)");
	
}
	
function delete_community($community_name){
	
	$community_name = sanitize($community_name);
	
	$success = mysql_query("DELETE FROM communities WHERE community_name = '$community_name'");
	
	return $success;
	
}
	
function community_exists($name) {
	
	$name = sanitize($name);
	
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `communities` WHERE `name` = '$name'"), 0) == 1) ? true : false;
}
	
	
function get_communities($type, $state){
	
	$state = sanitize($state);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM communities ORDER BY status");
		
	}
	if($type == 1){
	
		$result = mysql_query("SELECT * FROM communities WHERE status = 1 ORDER BY state DESC");
	
	}
	
	$allcommunities = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allcommunities[] = $number;		
   	}
	
	return $allcommunities;
}

function get_subscriptions($type, $user_id, $state){
	
	$user_id = sanitize($user_id);
	$state = sanitize($state);
	
	if($type == 0){
	
		$result_subscribed = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
		
	}
	if($type == 1){
	
		$result_subscribed = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
	
	}
	
    while($number = mysql_fetch_assoc($result_subscribed)) { 
		
		$all_names[] = $number['community_name'];		
		
   	}
	
	if(!isset($all_names)){
		
		return array();
	}
	
	$all_names = "'" . implode("','",$all_names) . "'";
			
	$result_communities = mysql_query("SELECT * FROM `communities` WHERE name IN ($all_names)");
	
	$all_communities = array();
		
    while($number = mysql_fetch_assoc($result_communities)) { 
		$all_communities[] = $number;	
   	}
	
	return $all_communities;

}


function subscribe_community($user_id, $community_name){
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	
	$time = time();
	
	$success = mysql_query("INSERT INTO subscriptions (user_id, community_name, second) VALUES ('$user_id', '$community_name', '$time')");
	
	return $success;
}

function delete_subscription($user_id, $community_name){
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	
	$success = mysql_query("DELETE FROM subscriptions WHERE user_id = '$user_id' AND community_name = '$community_name'");
	
	return $success;
}

function user_subscribed($user_id, $community_name) {	
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	
	return (mysql_result(mysql_query("SELECT COUNT('id') FROM `subscriptions` WHERE `user_id` = '$user_id' AND `community_name` = '$community_name'"), 0) == 1) ? true : false;
	
}

function community_is_active($community_name){
	$community_name = sanitize($community_name);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT status FROM `communities` WHERE name = '$community_name'"));
	
	if($result['status'] == 1){
		
		return true;
	}else{
		
		return false;
	}
	
	
}

function hole_is_active($community_name){
	$community_name = sanitize($community_name);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT hole FROM `communities` WHERE name = '$community_name'"));
	
	if($result['hole'] == 1){
		
		return true;
	}else{
		
		return false;
	}
	
}


function admin_posts($community_name){
	$community_name = sanitize($community_name);
		
	$result = mysql_query("SELECT * FROM admin_post WHERE status = 0 AND community = '$community_name' ORDER BY ID DESC");
	
	$all_posts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_posts[] = $number;		
   	}
	
	return $all_posts;
}

function get_mods_picurl($admin_id){
	$admin_id = sanitize($admin_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT profile FROM cementsalesmen WHERE id = '$admin_id' ORDER BY ID DESC"));
	
	$pic_id = $result['profile'];
		
	$result2 = mysql_fetch_assoc(mysql_query("SELECT url FROM pictures WHERE id = '$pic_id' ORDER BY ID DESC"));
		
	return $result2['url'];
	
}




	
?>