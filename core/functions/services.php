<?php

function get_logo_picture_url_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
	
	$picture_id = mysql_fetch_assoc(mysql_query("SELECT picture_id FROM services WHERE name = '$service_name' AND core = 1"));
	
	$picture_id = $picture_id['picture_id'];
	
	$url =  mysql_fetch_assoc(mysql_query("SELECT url FROM pictures WHERE id = '$picture_id'"));
	
	return $url['url'];
	
}


function get_service_color_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `color` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'color');
	
}


function get_service_description_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `description` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'description');
	
}

function get_services($community, $type){
	$type = sanitize($type);
	$community = sanitize($community);
	
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 1");
	
	}else{
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 0 AND community = '$community'") or die(mysql_error());
		
	}
	
	$allservices = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allservices[] = $number;		
   	}
	
	return $allservices;
	
	
}

function update_service($update_data, $service_name){
	$admin_id = sanitize($admin_id);
	$service_name = sanitize($service_name);
	
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	
	}

	return mysql_query("UPDATE `services` SET " . implode(', ', $update) . " WHERE `name` = '$service_name' AND core = 1") or die(mysql_error());
		

}


?>