<?php

function service_sub_count($service_name){
	$service_name = sanitize($service_name);
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(user_id) AS totalsubs FROM subscriptions WHERE service = '$service_name'"));
	
	return ($count['totalsubs']);
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
	if($type == 2){
	
		$result_subscribed = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
	
	}
	
	
    while($number = mysql_fetch_assoc($result_subscribed)) { 
		
		if($type != 2){
		
			$all_names[] = $number;		
		
		
		}else{
			
			$all_names[] = $number['community_name'];		
			
		}
		
		
   	}
	
	if($type != 2){
		
		if(isset($all_names)){
			
			return $all_names;
			
		}
	
	
	}else{
		
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
}


function subscribe_community($user_id, $community_name, $service){
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	$service = sanitize($service);
	
	$time = time();
	
	$success = mysql_query("INSERT INTO subscriptions (user_id, community_name, second, service) VALUES ('$user_id', '$community_name', '$time', '$service')");
	
	return $success;
}

function delete_subscription($user_id, $community_name, $service){
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	$service = sanitize($service);
	
	
	$success = mysql_query("DELETE FROM subscriptions WHERE user_id = '$user_id' AND community_name = '$community_name' AND service = '$service'");
	
	return $success;
}

function user_subscribed($user_id, $community_name, $service) {	
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	$service = sanitize($service);
	
	
	return (mysql_result(mysql_query("SELECT COUNT('id') FROM `subscriptions` WHERE `user_id` = '$user_id' AND `community_name` = '$community_name' AND `service` = '$service'"), 0) == 1) ? true : false;
	
}

function community_is_active($community_name){
	$community_name = sanitize($community_name);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT status FROM `communities` WHERE name = '$community_name'"));
	
	if($result['status'] <= 1){
		
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

/*

function get_mods_picurl($admin_id){
	$admin_id = sanitize($admin_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT profile FROM cementsalesmen WHERE id = '$admin_id' ORDER BY ID DESC"));
	
	$pic_id = $result['profile'];
		
	$result2 = mysql_fetch_assoc(mysql_query("SELECT url FROM pictures WHERE id = '$pic_id' ORDER BY ID DESC"));
		
	return $result2['url'];
	
}



function get_logo_picture_url_from_community_name($community_name){
	
	$community_name = sanitize($community_name);
	
	$picture_id = mysql_fetch_assoc(mysql_query("SELECT picture FROM communities WHERE name = '$community_name'"));
	
	$picture_id = $picture_id['picture'];
	
	$url =  mysql_fetch_assoc(mysql_query("SELECT url FROM pictures WHERE id = '$picture_id'"));
	
	return $url['url'];
	
}
*/


	
?>