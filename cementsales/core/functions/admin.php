<?php 

function admin_logged_in() {
	return (isset($_SESSION['admin_id'])) ? true : false;
}

function check_admin_power($admin_id){
	$admin_id = sanitize($admin_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT type FROM cementsalesmen WHERE id = '$admin_id' LIMIT 1"));
	
	return $result['type'];
	
	
}

function change_profile_image($admin_id, $file_temp, $file_extn) {
	$admin_id = sanitize($admin_id);
	$file_temp = sanitize($file_temp);
	$file_extn = sanitize($file_extn);
	
	$file_path = 'images/profile/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
	move_uploaded_file($file_temp, $file_path);
	$success = mysql_query("UPDATE `cementsalesmen` SET `profile` = '" . mysql_real_escape_string($file_path) . "' WHERE `id` = " . (int)$admin_id) or die(mysql_error());
	
	echo($success);
}



function remove_pic($pic_id, $admin_id){
	$pic_id = sanitize($pic_id);
	
	if(check_admin_power($admin_id) > 0){
	
		$success = mysql_query("UPDATE `pictures` SET `status` = 1 WHERE `id` = " . $pic_id) or die(mysql_error());
	
	}
	
	return $success;
	
}

function get_pics($type, $status, $all){
	$type = sanitize($type);
	$status = sanitize($status);
	
	if($all == 1){
	
	$result = mysql_query("SELECT * FROM pictures WHERE type = '$type' AND status = '$status' ORDER BY ID DESC");
	
}else{
	
		$result = mysql_query("SELECT * FROM pictures WHERE status = '$status' AND type <> 'Hole' ORDER BY ID DESC");
	
}
	
	$all_pics = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_pics[] = $number;		
   	}
	
	return $all_pics;
	
}


function check_admin_community($community_name, $admin_id){
	$admin_id = sanitize($admin_id);
	$community_name = sanitize($community_name);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM cementsalesmen WHERE id = '$admin_id' LIMIT 1"));
	
	if($result['community'] == $community_name || $result['type'] > 0){
		
		return true;
		
	}else{
		
		return false;
	}
	
}
	

function mail_users($subject, $body) {
	$query = mysql_query("SELECT `email`, `codename` FROM `users` WHERE `allow_email` = 1");
	while (($row = mysql_fetch_assoc($query)) !== false) {
		email($row['email'], $subject, "Hello " . $row['username'] . ",\n\n" . $body);
	}
}

function has_access($admin_id, $number) {
	$admin_id 	= (int)$admin_id;
	$type 		= (int)$type;
	
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `cementsalesmen` WHERE `id` = $admin_id AND `type` = $number"), 0) == 1) ? true : false;
}


function admin_access() {
	return (isset($_SESSION['admin_id'])) ? true : false;
}


function admin_data($admin_id) {
	$data = array();
	$admin_id = (int)$admin_id;
	
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	array_walk($func_get_args, 'array_sanitize');
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `cementsalesmen` WHERE `id` = $admin_id"));
		
		return $data;
	}
}

function register_admin($register_data) {
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = hash_password($register_data['password']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	$return = mysql_query("INSERT INTO `cementsalesmen` ($fields) VALUES ($data)") or die(mysql_error());
	
	
	echo($return);
}

function admin_exists($codename) {
	$codename = sanitize($codename);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `cementsalesmen` WHERE `codename` = '$codename'"), 0) == 1) ? true : false;
}

function admin_login($codename, $password) {	
	$admin_id = admin_id_from_codename($codename);
	
	save_suspicious_request('admin_login');
			
	$userhash = mysql_result(mysql_query("SELECT `password` FROM `cementsalesmen` WHERE `id` = '$admin_id'"), 0, 'password');	
				
	if(check_hash($userhash, $password)){
		
		return $admin_id;
		
	}else{
		
		return false;
	}
	
	
}


function admin_id_from_codename($codename) {
	$codename = sanitize($codename);
	return mysql_result(mysql_query("SELECT `id` FROM `cementsalesmen` WHERE `codename` = '$codename'"), 0, 'id');
}	

function head_admin_codename_from_community_name($community_name){
	$community_name = sanitize($community_name);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT head_admin_id FROM communities WHERE name = '$community_name' LIMIT 1"));
	
	$admin_id = $result['head_admin_id'];
	
	$result = mysql_fetch_assoc(mysql_query("SELECT codename FROM cementsalesmen WHERE id = '$admin_id' LIMIT 1"));
	
	return $result['codename'];
	
}

function head_admin_id_from_community_name($community_name){
	$community_name = sanitize($community_name);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT head_admin_id FROM communities WHERE name = '$community_name' LIMIT 1"));
	
	return $result['head_admin_id'];
	
}

function get_admins($community_name, $type){
	$type = sanitize($type);
	$community_name = sanitize($community_name);
	
	if($type == 0){
		
		$result = mysql_query("SELECT * FROM cementsalesmen ORDER BY status");
		
	}
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM cementsalesmen WHERE community = '$community_name' AND type = 0 ORDER BY ID DESC");
	
	}
	if($type == 2){
		
		$result = mysql_query("SELECT * FROM cementsalesmen WHERE type = 1 ORDER BY ID DESC");
	
	}
		
	$all_admins = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_admins[] = $number;		
   	}
	
	return $all_admins;
}

function check_if_head_moderator_exists($admin_id, $community_name){
	$admin_id = sanitize($admin_id);
	$community_name = sanitize($community_name);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT head_admin_id FROM communities WHERE name = '$community_name' LIMIT 1"));
	
	if($result['head_admin_id'] < 0 || $result['head_admin_id'] == null){
		
		$update_data = array(
			'needs_moderator' 	=> 1,
			'head_admin_id' => -1,	
		);
		
		update_community($admin_id, $update_data, $community_name);
		
		return false;
		
	}else{
		
		$id = $result['head_admin_id'];		
		
		$result2 = mysql_query("SELECT status FROM cementsalesmen WHERE id = '$id' LIMIT 1");
		
		if($result2['status'] >= 2){
						
			
			$update_data = array(
				'needs_moderator' 	=> 1,
				'head_admin_id' => -1,	
					
			);
	
			update_community($admin_id, $update_data, $community_name);
			
			return false;
			
		}else{
			
			$update_data = array(
				'needs_moderator' 	=> 0,
			);
			
			update_community($admin_id, $update_data, $community_name);
			
			return true;
			
		}
		
	}
	
}

function update_admin($admin_id, $update_data) {
	$admin_id = sanitize($admin_id);
	
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	
	mysql_query("UPDATE `cementsalesmen` SET " . implode(', ', $update) . " WHERE `id` = $admin_id");
}



?>