<?php

function recover($mode, $email) {
	$mode 		= sanitize($mode);
	$email		= sanitize($email);
	
	$user_data 	= user_data(user_id_from_email($email), 'user_id', 'username');
	
	if ($mode == 'username') {
		email($email, 'Your username', "Hello " . ",\n\nYour username is: " . $user_data['username'] . "");
	}
	
	if ($mode == 'password') {
		$generated_password = rand(999, 999999);
		
		change_password($user_data['user_id'], $generated_password);
		
		update_user($user_data['user_id'], array('password_recover' => '1'));
		
		email($email, 'Your password recovery', "Hello " . $user_data['username'] . ",\n\nYour new password is: " . $generated_password . "\n\n");
	}
	
}

function upload_image_user($nickname, $type, $file_temp, $file_extn){
	$file_temp = sanitize($file_temp);
	$file_extn = sanitize($file_extn);
	$nickname = sanitize($nickname);
	
	$file_path = 'images/profile/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
	move_uploaded_file($file_temp, $file_path);
		
	$success = mysql_query("INSERT INTO pictures (url, nickname, type) VALUES ('$file_path', '$nickname', '$type')") or die(mysql_error());
	
	return($file_path);
	
	
}


function update_user($user_id, $update_data) {
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	$user_id = sanitize($user_id);
	
	save_suspicious_request('user_update');
	
	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	
	mysql_query("UPDATE `users` SET " . implode(', ', $update) . " WHERE `user_id` = $user_id");
}

function activate($email, $email_code) {
	$email 		= sanitize($email);
	$email_code = sanitize($email_code);
	
	if (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 2"), 0) == 1) {
		mysql_query("UPDATE `users` SET `active` = 3 WHERE `email` = '$email'");
		return true;
	} else {
		return false;
	}
}

function change_password($user_id, $password) {
	$user_id = sanitize($user_id);
	$password = sanitize($password);
	$password = hash_password($password);
	
	save_suspicious_request('password_change');
	
	mysql_query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id");
}


function register_user($register_data) {
	array_walk($register_data, 'array_sanitize');
	
	save_suspicious_request('registration');
	
	$register_data['password'] = hash_password($register_data['password']);
		
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	
}

function register_user_with_email($register_data) {
	array_walk($register_data, 'array_sanitize');
	
	$register_data['password'] = hash_password($register_data['password']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
		
	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	
	email($register_data['email'], 'Activate your account', "Hello " . $register_data['username'] . ",\n\nTo confirm your email, use the link below:\n\nhttps://icu.university/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n");
}

function register_email_only($email, $user_id) {
	$user_id = sanitize($user_id);
	$email = sanitize($email);
	
	$emailer_data = user_data($user_id, 'username', 'email_code');
	
	mysql_query("UPDATE `users` SET `email` = '$email', `active` = 2  WHERE `user_id` = '$user_id'");
	
	email($email, 'Confirm Your Email', "Hello " . $emailer_data['username'] . ",\n\nTo confirm your email, use the link below:\n\nhttps://icu.university/activate.php?email=" . $email . "&email_code=" . $emailer_data['email_code'] . "\n\n");
	
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;
	$user_id = sanitize($user_id);
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	array_walk($func_get_args, 'array_sanitize');
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));
		
		return $data;
	}
}

function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}

function user_exists($username) {
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'"), 0) == 1) ? true : false;
}

function user_exists_outside($username, $user_id ) {
	$username = sanitize($username);
	$user_id = sanitize($user_id);
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `user_id` <> '$user_id'"), 0) == 1) ? true : false;
}

function email_exists($email) {
	$email = sanitize($email);
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'"), 0) == 1) ? true : false;
}

function email_exists_outside($email, $user_id) {
	$email = sanitize($email);
	$user_id = sanitize($user_id);
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `user_id` <> '$user_id'"), 0) == 1) ? true : false;
}

function user_active($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `active` FROM `users` WHERE `username` = '$username'"), 0, 'active');
}

function user_has_identity($user_id) {
	$user_id = sanitize($user_id);
	return mysql_result(mysql_query("SELECT `has_identity` FROM `users` WHERE `user_id` = '$user_id'"), 0, 'has_identity');
}

function user_id_from_username($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'"), 0, 'user_id');
}

function user_id_from_post_id($post_id) {
	$post_id = sanitize($post_id);
	return mysql_result(mysql_query("SELECT `user_id` FROM `posts` WHERE `id` = '$post_id'"), 0, 'user_id');
}

function username_from_user_id($user_id) {
	$user_id = sanitize($user_id);
		
	return mysql_result(mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '$user_id'"), 0, 'username');
}


function get_home_from_user_id($user_id) {
	$user_id = sanitize($user_id);
		
	return mysql_result(mysql_query("SELECT `home` FROM `users` WHERE `user_id` = '$user_id'"), 0, 'home');
}

function get_home_from_username($username) {
	$username = sanitize($username);
		
	return mysql_result(mysql_query("SELECT `home` FROM `users` WHERE `username` = '$username'"), 0, 'home');
}


function user_id_from_email($email) {
	$email = sanitize($email);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'"), 0, 'user_id');
}

function check_owns_board($user_id, $service_name){
	
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `admins` WHERE `user_id` = '$user_id' AND `service_name` = '$service_name'"), 0) == 1) ? true : false;
}

function check_moderates_board($user_id, $community_name, $service_name){
	
	
}

function check_oversees_community($user_id, $community_name){
	
	
}

function login($username, $password) {	
	$username = sanitize($username);

	$user_id = user_id_from_username($username);
		
	save_suspicious_request('login');
			
	$userhash = mysql_result(mysql_query("SELECT `password` FROM `users` WHERE `user_id` = '$user_id'"), 0, 'password');	
				
	if(check_hash($userhash, $password)){
		
		return $user_id;
		
		
	}else{
		
		return false;
	}
	
}

function logout(){
	
	session_start();
	session_destroy();
	header('Location: index.php');
	
}


function user_enter($service_name, $community_name){
	$total_users = mysql_result(mysql_query("SELECT `user_count` FROM `live_service_count` WHERE `community_name` = '$community_name' AND `service_name` = '$service_name'"), 0, 'user_count');	
	
	$total_users += 1;
	
	return mysql_query("UPDATE `live_service_count` SET `user_count` = '$total_users' WHERE `community_name` = '$community_name' AND `service_name` = '$service_name'");
	
}

function user_leave($service_name, $community_name){
	
	$total_users = mysql_result(mysql_query("SELECT `user_count` FROM `live_service_count` WHERE `community_name` = '$community_name' AND `service_name` = '$service_name'"), 0, 'user_count');	
	
	if($total_users > 0){
	
		$total_users -= 1;
	
	}else{
		
		$total_users = 0;
	}
	
	
	return mysql_query("UPDATE `live_service_count` SET `user_count` = '$total_users' WHERE `community_name` = '$community_name' AND `service_name` = '$service_name'");
	
	
}

function get_user_count($service_name, $community_name){
	
	$total_users = mysql_result(mysql_query("SELECT `user_count` FROM `live_service_count` WHERE `community_name` = '$community_name' AND `service_name` = '$service_name'"), 0, 'user_count');	
	
	return $total_users;
}

?>