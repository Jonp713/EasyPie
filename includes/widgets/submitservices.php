<?php

$services = get_services('Hampy', 0);

echo("<span class = 'submit-services col-xs-12 no-padding'>");

echo('<strong>Select service to send post to:</strong><br><br>');

foreach ($services as $currentservice){
	
    $color = get_service_color_from_service_name($currentservice['name']);
 
    $url = get_logo_picture_url_from_service_name($currentservice['name']) ;
 
    $desc = get_service_description_from_service_name($currentservice['name']);
		

			
	   	 switch ($currentservice['name']) {
	   	     case 'Zombledon':
			 	
	   	     break;
	   	     default:
	 			echo('<button style = "background-color:'.$color.'" data-target = "#sf-'.$currentservice['name'].'" class="btn btn-custom2 btn-md service-submit-button "><img class = "img-responsive no-padding" src = "'.$url.'"></button>');
	   	
		
		 }

		


}

echo("</span>");

	
?>