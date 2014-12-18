<?php

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



?>
