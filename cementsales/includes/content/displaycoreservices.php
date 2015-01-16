<?php

//moderator_protect_page();

$services = get_services(null, 1);

foreach ($services as $currentservice){
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-6">');

	echo($currentservice['name'] . '<br>');
	
	if(service_is_inappropriate($currentservice['name'])){
		
		echo('Owner says the content of this board could be innapropriate<br>');
		
				
	}

	

	echo('<span class = "'.$currentservice['id'].'delete"><span onclick="delete_service('.$currentservice['id'].')"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-remove-sign"></span>  Delete service</span></span><br></span>');
	
	echo('<span class = "'.$currentservice['name'].'message"><input type = "text" class = "reply form-control">&nbsp;<span onclick="message_mod(\''.$currentservice['name'].'\', \'owner\')"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-share-alt"></span> Message</span></span><br></span>');
	
		
	
	
	
	

	echo('</span></span>');

}

	
?>