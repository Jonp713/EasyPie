<?php

function give_points($post_id, $amount, $admin_id, $community_name){
	$post_id = sanitize($post_id);
	
	$user_id = user_id_from_post_id($post_id);
	
	$amount = sanitize($amount);
	$community_name = sanitize($community_name);
	$admin_id = sanitize($admin_id);
	
	$success = mysql_query("INSERT INTO points (user_id, amount, post_id, admin_id, community_name) VALUES ('$user_id', '$amount', '$post_id', '$admin_id', '$community_name')") or die(mysql_error());
	
	$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM points WHERE user_id = '$user_id'"));
	
	create_notification($user_id, 'give_points', 'You got '.$amount.' points!', $post_id);
	
	return $success;
	
}


?>
