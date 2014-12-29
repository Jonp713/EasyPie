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

function get_service_char_type($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `char_type` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'char_type');
	
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

function service_is_home($service_name){
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `is_home` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'is_home');
	
}

function service_needs_approve($service_name){
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `moderation` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'moderation');
	
}


function display_form($service_name, $service_in){
	
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM services WHERE name = '$service_name' AND core = 1"));
	
	
	if($service_in == $service_name){

		echo('<span id = "sf-'.$service_name.'" data-active = "active">');

	}else{
	
	   echo('<span id = "sf-'.$service_name.'" data-active = "notactive">');
   
	}
	
	echo('<form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">');
	
	echo('<strong>'.$service_name.'</strong>');
	
	//textarea and service
	echo('<div class="form-group"><input value = "'.$data['name'].'" name = "service" hidden><div class="col-xs-12"><textarea placeholder = "'.$data['prompt'].'" name="post" class ="form-control" ></textarea></div></div>');
	
	
	if($data['images_on']){
		
		echo('<div class = "form-group"><label for="is_image"   class="col-xs-3 control-label">Use a picture:</label><div class="col-xs-8">');
			
	echo('<input onclick = "toggle_post_picture(\''.$service_name.'\')" type="checkbox" name = "is_image" value="checked"></div></div>');
		
	 echo('<div id = "post-pic-form-'.$service_name.'" class="form-group picture-disabled"><label for="pic" class="col-xs-3 control-label">Picture:</label><div class="col-xs-8"><input class = "form-control"  type="file" name="pic"></div></div>');
	 
		
	}
	
	if($data['videos_on']){
		
		echo('<div class = "form-group"><label for="is_video"   class="col-xs-3 control-label">Use a video:</label><div class="col-xs-8">');
			
	echo('<input onclick = "toggle_post_video(\''.$service_name.'\')" type="checkbox" name = "is_video" value="checked"></div></div>');
		
	 echo('<div id = "post-vid-form-'.$service_name.'" class="form-group picture-disabled"><label for="vurl" class="col-xs-3 control-label">Video URL (Youtube Only)</label><div class="col-xs-8"><input class = "form-control"  type="text" onchange="youtube_parser(this.value,\''.$service_name.'\')" id = "vurl_'.$service_name.'" name="vurl"></div></div>');

	 
	}
	
	if($data['websites_on']){
		
		echo('<div class = "form-group"><label for="is_website"   class="col-xs-3 control-label">Use a website:</label><div class="col-xs-8">');
			
	echo('<input onclick = "toggle_post_web(\''.$service_name.'\')" type="checkbox" name = "is_website" value="checked"></div></div>');
		
	 echo('<div id = "post-web-form-'.$service_name.'" class="form-group picture-disabled"><label for="web" class="col-xs-3 control-label">Website URL</label><div class="col-xs-8"><input class = "form-control" id = "web" type="text" name="wurl" value = "http://"></div></div>');
		
	}
	
	
	
	if($data['comments_on']){
		
	   echo('<div class="checkbox"><label><input type="checkbox" name="comments_on" checked = "checked">Allow comments</label></div>');
		
	}
	
	if($data['private_on']){
		
		if(logged_in() === true){ 
								
			echo('<div class="checkbox"><label data-container="body" data-toggle="popover" data-placement="left" data-content="Users can anonymously send you messages by clicking reply. They will not see your username in a message.">');
		 		
			echo('<input type="checkbox" name="reply_on" checked = "checked">I want replies </label></div>');
					
		
		}else{
			
			echo('<div class="checkbox disabled"><label><input type="checkbox" value="" disabled>I want replies</label></div>You must <a href = "login.php">login</a> or <a href = "register.php">register</a> to recieve private replies');
		
		} 
		
		
	}
	
	
	
	echo('<br><button type="submit" class="post-submit-button btn btn-info">SUBMIT</button></form></span>');
	
}





?>