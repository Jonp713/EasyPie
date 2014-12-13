<?php

$services = get_services($_GET['c'], 0);

echo("<span class = 'services col-xs-12 nopadding'>");

if(hole_is_active($_GET['c'])){

	echo('<a href="hole.php?c='.$_GET['c'].'" style = "background-color:#272727 !important;" class="servicebutton btn btn-custom2 btn-lg btn-block">HOLE</a>');

}

foreach ($services as $currentservice){
	
	if(isset($_GET['service']) && $_GET['service'] == $currentservice['name']){
		
		
	}else{
	
 $color = get_service_color_from_service_name($currentservice['name']);
 
 $url = get_logo_picture_url_from_service_name($currentservice['name']) ;
 
 $desc = get_service_description_from_service_name($currentservice['name']) ;
 
	echo('<a data-toggle="tooltip" data-container = "body" title="'.$desc.'"  data-placement="left" href="posts.php?c='.$_GET['c'].'&service='.$currentservice['name'].'" style = "background-color:'.$color.'" class="btn btn-custom2 btn-lg btn-block servicebutton"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'"><span class = "service-name"> '.strtoupper($currentservice['name']).'</span></a>');
	
	}

}
echo("</span>");

	
?>