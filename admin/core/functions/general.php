<?php


function moderator_protect_page() {
	if (admin_logged_in() === false) {
		header('Location: index.php');
		exit();
	}else{
		
		if(check_admin_power($_SESSION['admin_id']) >= 1){
			
			header('Location: index.php');
			exit();
			
		}
		
	}
}



function admin_protect_page() {
	if (admin_logged_in() === false) {
		header('Location: index.php');
		exit();
	}else{
		if(check_admin_power($_SESSION['admin_id']) < 1){
			
			header('Location: index.php');
			exit();
			
		}
		
	}
}

function ok_requests($id, $admin_id){
	$id = sanitize($id);
	$admin_id = sanitize($admin_id);
	
	if(check_admin_power($admin_id) > 0){
		
		$success = mysql_query("UPDATE `suspicious_requests` SET `count` = 0 WHERE `id` = '$id'");
	
	}
	
	return $success;	
}

function get_requests(){
	
	$result = mysql_query("SELECT * FROM suspicious_requests WHERE count > 8 ORDER BY ID DESC");
	
	$all_requests = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_requests[] = $number;		
   	}
	
	return $all_requests;
	
}


function blacklist($ip, $admin_id){
	$ip = sanitize($ip);
	$admin_id = sanitize($admin_id);
	
	if(check_admin_power($admin_id) > 0){
	
		$success = mysql_query("INSERT INTO `blacklist` (ip) VALUES ('$ip')");
	
	}
	
	return $success;
	
}



function remove_blacklist($ip, $admin_id){
	$ip = sanitize($ip);
	$admin_id = sanitize($admin_id);
	
	if(check_admin_power($admin_id) > 0){
	
		$success = mysql_query("DELETE FROM `blacklist` WHERE `ip` = '$ip'") or die(mysql_error());
		
	}
		
	return $success;
	
	
}



function update_terminator($admin_id, $status, $password){
	$status = sanitize($status);
		
	if(check_admin_power($admin_id) > 0 && $password == 'f998325eeb785830789ca65e6b99a247'){
	
		$success = mysql_query("UPDATE `general` SET `status` = '$status' WHERE `name` = 'terminator'");
	
	}
		
}

?>

