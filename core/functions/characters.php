<?php

function get_logo_picture_url_from_character_id($character_id){
	
	$character_id = sanitize($character_id);	
	
	$picture_id = mysql_fetch_assoc(mysql_query("SELECT pic_id FROM characters WHERE id = '$character_id'"));
	
	$use_id = $picture_id['pic_id'];
		
	$url =  mysql_fetch_assoc(mysql_query("SELECT url FROM pictures WHERE id = '$use_id'"));
	
	return $url['url'];
	
}

function get_logo_picture_url_from_character_name($character_id){
	
	$character_id = sanitize($character_id);	
	
	$picture_id = mysql_fetch_assoc(mysql_query("SELECT pic_id FROM characters WHERE name = '$character_id'"));
	
	$use_id = $picture_id['pic_id'];
		
	$url =  mysql_fetch_assoc(mysql_query("SELECT url FROM pictures WHERE id = '$use_id'"));
	
	return $url['url'];
	
}



function get_character_name_from_character_id($character_id){
	
	$character_id = sanitize($character_id);
	
	$name = mysql_fetch_assoc(mysql_query("SELECT name FROM characters WHERE id = '$character_id'"));
	
	return $name['name'];
	
}


function get_random_quote_from_character_id($character_id, $community_name, $service_name){
		
	$community_name = sanitize($community_name);
	$character_id= sanitize($character_id);	
	$service_name = sanitize($service_name);	
	
	$service_id = get_service_id_from_service_name($service_name);

	$quote = mysql_fetch_assoc(mysql_query("SELECT text FROM quotes WHERE community_name = '$community_name' AND service_id = '$service_id' AND character_id = '$character_id' ORDER BY RAND() LIMIT 1"));

	return $quote['text'];

	
}

function create_character($character_data){
		
	array_walk($character_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($character_data)) . '`';
	$data = '\'' . implode('\', \'', $character_data) . '\'';

	mysql_query("INSERT INTO `characters` ($fields) VALUES ($data)") or die(mysql_error());

	
}

function character_exists($character) {
	$character = sanitize($character);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `characters` WHERE `name` = '$character'"), 0) == 1) ? true : false;
}


function update_character($update_data, $character_name){
	$character_name = sanitize($character_name);
	
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	
	}

	return mysql_query("UPDATE `characters` SET " . implode(', ', $update) . " WHERE `name` = '$character_name'") or die(mysql_error());
		

}

function add_quote($quote_data){
		
	array_walk($quote_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($quote_data)) . '`';
	$data = '\'' . implode('\', \'', $quote_data) . '\'';

	mysql_query("INSERT INTO `quotes` ($fields) VALUES ($data)") or die(mysql_error());
	
}


function upload_image_characters($nickname, $file_temp, $file_extn, $user_id){
	$file_temp = sanitize($file_temp);
	$file_extn = sanitize($file_extn);
	$nickname = sanitize($nickname);
	$user_id = sanitize($user_id);
	
	
	$file_path = 'images/profile/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
	
	move_uploaded_file($file_temp, $file_path);
	
	if(filesize($file_path) > 3000000){
													
		compress_image($file_path, $file_path, 30);
	
	}
		
	$success = mysql_query("INSERT INTO pictures (url, nickname, type, admin_id) VALUES ('$file_path', '$nickname', 'user_character', '$user_id')") or die(mysql_error());
	
	return $file_path;
	
}



?>
