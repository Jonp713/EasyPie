<?php

//moderator_protect_page();

$services = get_services($admin_data['community'], 0);

foreach ($services as $currentservice){
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-6">');

	echo($currentservice['name'] . '<br>');
	
	if(service_is_inappropriate($currentservice['name'])){
		
		echo('Owner says the content of this board could be innapropriate<br>');
		
		
				
	}
	
	
	if($currentservice['is_home'] == 0){
		
		echo('Not on Home Feed<br>');
				
		if(is_geo_locked($currentservice['name'])){
			
			echo("This service is geo-locked and cannot appear on the Home Feed<br>");
			
		}else if (has_blur($currentservice['name'])){
			
			echo("This service has security blur and cannot appear on the Home Feed<br>");
			
			
		}else{		
				
			echo('<span class = "'.$currentservice['id'].'addhome"><span onclick="homeing('.$currentservice['id'].', 1)"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-thumbs-up"></span> Add to Home Feed</span></span><br></span>');
		
		}
	
	}
	if($currentservice['is_home'] == 1){
		
		echo('Is part of Home Feed<br>');
				
		echo('<span class = "'.$currentservice['id'].'dehome"><span onclick="homeing('.$currentservice['id'].', 0)"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-thumbs-down"></span> Remove from Home Feed</span></span><br></span>');
	
		
	}

	echo('<span class = "'.$currentservice['id'].'defranchise"><span onclick="defranchise('.$currentservice['id'].')"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-remove-sign"></span>  Defranchise</span></span><br></span>');
	
	echo('<span class = "'.$currentservice['name'].'message"><input type = "text" class = "reply form-control">&nbsp;<span onclick="message_mod(\''.$currentservice['name'].'\', \'owner\')"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-share-alt"></span> Message</span></span><br></span>');

	echo('</span></span>');

}

	
?>