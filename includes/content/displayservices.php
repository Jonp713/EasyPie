<?php

//moderator_protect_page();

$services = get_services($admin_data['community'], 0);

echo("CHUPOW!");
xxx
echo("CHUPOW!");
echo("CHUPOW!");
echo("CHUPOW!");

foreach ($services as $currentservice){
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-6">');

	echo($currentservice['name'] . '<br>');
	
	$admin = admin_data($currentservice['head_admin_id'], 'codename');

	if($currentservice['is_home'] == 0){
		
		echo('Not on Home Feed<br>');
				
	}
	if($currentservice['is_home'] == 1){
		
		echo('Is part of Home Feed<br>');
				
	}
	if($currentservice['innapropriate'] == 1){
		
		echo('Moderator says the content of this board could be innapropriate<br>');
				
	}

	echo('</span></span>');

}

	
?>