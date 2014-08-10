<?php

function ddos(){
	
	if(empty($_SESSION['ddos'])){

		$_SESSION['ddos'] = 0;
		$_SESSION['lasturl'] = $_SERVER['REQUEST_URI'];

	}
	
	if($_SERVER['REQUEST_URI'] == $_SESSION['lasturl']){
	
		$_SESSION['ddos'] = $_SESSION['ddos'] + 1;
		$_SESSION['lasturl'] = $_SERVER['REQUEST_URI'];
		
		
		if($_SESSION['ddos'] > 10){
				
			sleep(($_SESSION['ddos'] - 10)/2);
		
		}
	
	}else{
	
		if($_SESSION['ddos']  > 0){
	
			$_SESSION['ddos']  = $_SESSION['ddos']  - 1;
			$_SESSION['lasturl'] = $_SERVER['REQUEST_URI'];
	
		}
	
	}

}

function terminator(){
	
	$result = mysql_fetch_assoc(mysql_query('SELECT * FROM `general` WHERE `name` = "terminator"'));
	
	if($result['status'] == 1){
			
		$blacklist = get_blacklist(1);
				
		if(in_array($_SERVER['REMOTE_ADDR'], $blacklist)){
	
			header('Location: down.php');
	
		}

	}
	
	if($result['status'] == 2){
		
		$blacklist = get_blacklist(1);
		
		if(in_array($_SERVER['REMOTE_ADDR'], $blacklist)){
	
			header('Location: down.php');
	
		}
		
		session_destroy();
		
	}
	if($result['status'] == 3){
		
		session_destroy();
		
		header('Location: down.php');
		
	}
	
	
}

function get_blacklist($type){
	
	$result = mysql_query('SELECT * FROM `blacklist` WHERE `status` = 0');
	
	$all_blacklist = array();
		
	if($type == 0){
		
	    while($number = mysql_fetch_assoc($result)) { 
			$all_blacklist[] = $number;	
	   	}
	
	}
	
	if($type == 1){
		
	    while($number = mysql_fetch_assoc($result)) { 
			$all_blacklist[] = $number['ip'];	
	   	}
	
	}
	
	return $all_blacklist;	
	
}


function get_request_count($ip, $type){
	$type = sanitize($type);
	$ip = sanitize($ip);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT count FROM `suspicious_requests` WHERE `ip` = '$ip' AND `type` = '$type'"));
	
	return $result['count'];
}

function check_new_request($ip, $type){
	$type = sanitize($type);
	$ip = sanitize($ip);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM `suspicious_requests` WHERE `ip` = '$ip' AND `type` = '$type'"));
	
	if($result['total'] == 0){
		
		return true;
		
	}else{
		
		return false;
	}
	
}

function clear_old_requests(){
	$results = mysql_query("SELECT * FROM `suspicious_requests`");
    
	while($number = mysql_fetch_assoc($results)) { 
		
		if(time() > ($number['second'] + 25920)){
				
			$all_ids[] = $number['id'];		
		
		}
   	}
	
	if(!isset($all_ids)){
		
		return false;
	}
	
	$all_ids = "'" . implode("','",$all_ids) . "'";
			
	$result_communities = mysql_query("DELETE FROM `suspicious_requests`WHERE id IN ($all_ids)");
	
	return true;
	
}


function save_suspicious_request($type){
	$type = sanitize($type);
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$ip = sanitize($ip);
	
	$second = time();
	
	$community = '';
	
	if(isset($_GET['c'])){
		
		$community = $_GET['c'];
		
	}
		
	if(check_new_request($ip, $type)){
		
		mysql_query("INSERT INTO `suspicious_requests` (ip, count, type, second, community) VALUES ('$ip', 1, '$type', '$second', '$community')");
		
		return 1;
		
	}else{
		
		$count = get_request_count($ip, $type) + 1;
		
		mysql_query("UPDATE `suspicious_requests` SET `count` = '$count', `second` = '$second', community = '$community' WHERE `ip` = '$ip' AND `type` = '$type'") or die(mysql_error());
		
		return $count;
		
	}
	
	
}

function email($to, $subject, $body) {
	mail($to, $subject, $body, 'From: donotreply@icuhampy.com');
}


function logged_in_redirect() {
	if (logged_in() === true) {
		header('Location: index.php');
		exit();
	}
}

function protect_page() {
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

function active_protect($community_name){
	
	$is = community_is_active($community_name);
	
	if($is == false){
		
		header('location: explore.php');
	}
	
	
}

function has_hole($community_name){
	
	$is = hole_is_active($community_name);
	
	if($is == false){
		
		header('location: explore.php');
		
	}
	
}


function hash_password($password){
	
	$hasher = new PasswordHash(8, false);
	
	if (strlen($password) > 72) { die("Password must be 72 characters or less"); }
	
	$hash = $hasher->HashPassword($password);
	
	if (strlen($hash) >= 20) {

		return $hash;

	} else {

		die('Hash Failed');
	}


}

function check_hash($hash, $password){
	
	$hasher = new PasswordHash(8, false);

	// Passwords should never be longer than 72 characters to prevent DoS attacks
	if (strlen($password) > 72) { die("Password must be 72 characters or less"); }

	// Retrieve the hash that you stored earlier
	$stored_hash = $hash;

	// Check that the password is correct, returns a boolean
	$check = $hasher->CheckPassword($password, $stored_hash);

	if ($check){

		return true;

	}else{

		return false;

	}
	
	
}

function array_sanitize(&$item) {
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function output_errors($errors) {
	
	return '<div class="alert alert-danger" role="alert"><strong>' . implode('</strong></div><div class="alert alert-danger" role="alert"><strong>', $errors) . '</strong></div>';
}


?>