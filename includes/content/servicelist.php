<?php

$services = get_services($_GET['c'], 0);

echo("<span class = 'services col-xs-12 nopadding'>");

foreach ($services as $currentservice){
	
	if(isset($_GET['service']) && $_GET['service'] == $currentservice['name']){
		
		
	}else{
	
	 $color = get_service_color_from_service_name($currentservice['name']);
	  
	 $url =  get_logo_picture_url_from_service_name($currentservice['name']);
 
	 $desc = get_service_description_from_service_name($currentservice['name']);
	 
	 
	 
	 
	 switch ($currentservice['name']) {
	     case "Hole":
  			
			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
	 
	 
			$link = 'hole.php?c='.$_GET['c'].'&service='.$currentservice['name'];
	 
	 
		 	echo('<a data-toggle="tooltip" data-container = "body" title="'.$desc.'"  data-placement="left" href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 btn-lg btn-block servicebutton">');
		
			echo('<span style = "background-color:rgba(255,255,255,.3);" class = "service-logo-circle col-xs-2 no-padding pull-left"></span>');
					
			if(get_service_char_type($currentservice['name']) == "character_image" && !empty($url)){
		
				echo('<img class = "service-logo col-xs-2 no-padding pull-left" src = "'.$url.'">');
		
			}else if(get_service_char_type($currentservice['name']) == "character_text"){
		
				echo('<span class = "service-logo-text col-xs-2 no-padding pull-left">'. strtoupper($currentservice['name'][0]).'</span>');
		
			}
		
		
			echo('<span class = "pull-left service-list-name col-xs-10">'.strtoupper($currentservice['name']).'</span></a>');
	 
			echo('</span>');
			
			
	     break;
	     case 'Zombledon':
		 
   	 	 		$user_count = get_user_count($currentservice['name'], $community_in);
		 
 				$link = 'zombledon.php?c='.$_GET['c'].'&service='.$currentservice['name'];
				
				echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		
				echo('<a data-toggle="tooltip" data-container = "body" title="'.$desc.'"  data-placement="left" href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 btn-lg btn-block servicebutton">'); 
		
		
				echo('<img class = "service-logo pull-left col-xs-2 no-padding" src = "'.$url.'">');
			
				echo('<span class = "pull-left service-list-name col-xs-10">'.strtoupper($currentservice['name']).'</span>');
		
								
				echo('</a>');
				
				if($user_count > 0){ 
					
					echo('<span class = "pull-left badge user-count-badge" style = "color:'.$color.'">'.$user_count.'</span>');
					
				}
				
				echo('</span>');
			
	     break;
		 case "Events":
		 
		 
			 	$live_count = count_total_live_events($community_in);
					 
 				$link = 'posts.php?c='.$_GET['c'].'&service='.$currentservice['name'];
				
				echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		
				echo('<a data-toggle="tooltip" data-container = "body" title="'.$desc.'"  data-placement="left" href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 btn-lg btn-block servicebutton">'); 
		
		
				echo('<img class = "service-logo pull-left col-xs-2 no-padding" src = "'.$url.'">');
			
				echo('<span class = "pull-left service-list-name col-xs-10">'.strtoupper($currentservice['name']).'</span>');
		
								
				echo('</a>');
				
				if($live_count > 0){ 
					
					echo('<span class = "pull-left badge user-count-badge" style = "color:'.$color.'">'.$live_count.'</span>');
					
				}
				
				echo('</span>');
		 
		 break;
	     default:
		 
			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		 
		 
 			$link = 'posts.php?c='.$_GET['c'].'&service='.$currentservice['name'];
		 
		 
		 	echo('<a data-toggle="tooltip" data-container = "body" title="'.$desc.'"  data-placement="left" href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 btn-lg btn-block servicebutton">');
			
			echo('<span style = "background-color:rgba(255,255,255,.3);" class = "service-logo-circle col-xs-2 no-padding pull-left"></span>');
						
			if(get_service_char_type($currentservice['name']) == "character_image" && !empty($url)){
			
				echo('<img class = "service-logo image-responsive pull-left" src = "'.$url.'">');
			
			}else if(get_service_char_type($currentservice['name']) == "character_text"){
			
				echo('<span class = "service-logo-text col-xs-2 no-padding pull-left">'. strtoupper($currentservice['name'][0]).'</span>');
			
			}
			
			
			echo('<span class = "pull-left service-list-name col-xs-10">'.strtoupper($currentservice['name']).'</span></a>');
		 
			echo('</span>');
		 
	 }
	 

	
	
	
	}

}

echo('<hr class = "col-xs-12 no-padding messagehr"><span class = "col-xs-12 no-padding aservice-list new-container">');


$link = 'createservice.php';


 	echo('<a data-toggle="tooltip" data-container = "body" title="Create your own board!"  data-placement="left" href="'.$link.'" style = "background-color:#aaa" class="btn btn-custom2 btn-lg btn-block servicebutton"><img class = "service-logo col-xs-2 no-padding pull-left" src = ""><span class = "pull-left service-list-name col-xs-10">CREATE</span></a>');

 
	echo('</span>');
 

 

echo("</span>");






	
?>