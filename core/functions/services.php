<?php

function create_service($service_data){
		
	array_walk($service_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($service_data)) . '`';
	$data = '\'' . implode('\', \'', $service_data) . '\'';

	mysql_query("INSERT INTO `services` ($fields) VALUES ($data)");
	
}

function add_service($service_data){
		
	array_walk($service_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($service_data)) . '`';
	$data = '\'' . implode('\', \'', $service_data) . '\'';

	mysql_query("INSERT INTO `services` ($fields) VALUES ($data)") or die(mysql_error());
	
}

function service_exists($service) {
	$service = sanitize($service);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `services` WHERE `name` = '$service' AND `core` = 1"), 0) == 1) ? true : false;
}

function service_exists_in_community($service, $community) {
	$service = sanitize($service);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `services` WHERE `name` = '$service' AND `community` = '$community'"), 0) == 1) ? true : false;
}


function get_logo_picture_url_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
	
	$character_id = mysql_fetch_assoc(mysql_query("SELECT character_id FROM services WHERE name = '$service_name' AND core = 1"));
	
	$character_id = $character_id['character_id'];
	
	$picture_id = mysql_fetch_assoc(mysql_query("SELECT pic_id FROM characters WHERE id = '$character_id'"));	
	
	$picture_id = $picture_id['pic_id'];
	
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

function get_service_id_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `id` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'id');
	
}


function get_is_mine_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `is_mine` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'is_mine');
	
}


function get_services_ajax($community){
	$community = sanitize($community);
	
	$result = mysql_query("SELECT * FROM `services` WHERE core = 0 AND community = '$community'") or die(mysql_error());
	

	$allservices = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		
		$allservices[] = $number['name'];	
	
	}
	
	return $allservices;
	
}


function get_services($community, $type){
	$type = sanitize($type);
	$community = sanitize($community);
	
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 1");
	
	}
	if($type == 0){
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 0 AND community = '$community'") or die(mysql_error());
		
	}
	if($type == 2){
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 1") or die(mysql_error());
		
		$result2 = mysql_query("SELECT * FROM `services` WHERE core = 0 AND community = '$community'") or die(mysql_error());
		
	}
	
	
	$allservices = array();
	
	
    while($number = mysql_fetch_assoc($result)) { 
		$continue = true;
		
		if($type == 2){
		    while($number_community = mysql_fetch_assoc($result2)) { 
								
				
				if($number['name'] == $number_community['name']){
					
					$continue = false;
				}
				
			
			}
			mysql_data_seek($result2, 0);
			
			if($continue && $type == 2){
			
				$allservices[] = $number;	
			
			}
			
		}else{
		
			$allservices[] = $number;	
			
		}	
		
		
	
   	}
	
	return $allservices;
	
	
}

function update_service($update_data, $service_name){
	$service_name = sanitize($service_name);
	
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	
	}

	return mysql_query("UPDATE `services` SET " . implode(', ', $update) . " WHERE `name` = '$service_name' AND core = 1") or die(mysql_error());
		

}


function display_form($service_name, $service_in){
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM services WHERE name = '$service_name' AND core = 1"));
	
	
	if($service_in == $service_name){

		echo('<span id = "sf-'.$service_name.'" data-active = "active">');

	}else{
	
	   echo('<span id = "sf-'.$service_name.'" data-active = "notactive">');
   
	}
	
	echo('<form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">');
	
	//textarea and service
	echo('<div class="form-group"><input value = "'.$data['name'].'" name = "service" hidden><div class="col-xs-12"><textarea placeholder = "'.$data['prompt'].'" name="post" class ="form-control" ></textarea></div></div>');
	
	
	echo('<br><button type="submit" class="post-submit-button btn btn-info">SUBMIT</button></form></span>');
	
}





?>