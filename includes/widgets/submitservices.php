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
			 
	 			echo('<span class = "col-xs-1 no-padding serviceformcontainer"><button style = "background-color:'.$color.'" id = "sf-'.$currentservice['name'].'-icon" data-target = "#sf-'.$currentservice['name'].'" class="btn btn-custom2 btn-md service-submit-button">');
				
					echo('<span style = "background-color:rgba(255,255,255,.3);" class = "service-form-circle"></span>');
								
				if(get_service_char_type($currentservice['name']) == "character_image" && !empty($url)){
			
					echo('<img class = "img-responsive service-form-image no-padding" src = "'.$url.'">');
			
				}else if(get_service_char_type($currentservice['name']) == "character_text"){
			
					echo('<span class = "form-font-service no-padding">'. strtoupper($currentservice['name'][0]).'</span>');
			
				}
				
				
			
				
				echo('</button></span>');
	   	
		
		 }

		


}

echo("</span>");

	
?>