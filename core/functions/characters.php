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



?>
