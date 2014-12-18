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
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `services` WHERE `name` = '$service'"), 0) == 1) ? true : false;
}




?>