<?php
	
	
$services = get_services($_GET['c'], 0);

foreach ($services as $currentservice){
	
	if(get_is_mine_from_service_name($currentservice['name']) != 1){
		
		display_form($currentservice['name'], $service_in);
	
	}
	
}


?>




	
	