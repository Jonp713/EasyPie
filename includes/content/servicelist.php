<?php

$services = get_services($_GET['c'], 0);

echo("<span class = 'col-xs-12 nopadding services'>");

echo('<font color = "#999">'.$_GET['c'].'\'s Boards</font>');

foreach ($services as $currentservice){
	
	
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
			
			if(is_geo_locked($currentservice['name']) == 1){
				
					echo('<span class = "pull-right home-badge glyphicon glyphicon-globe"></span>');
			
				
				}
	 
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
				
				if(is_geo_locked($currentservice['name']) == 1){
				
						echo('<span class = "pull-right home-badge glyphicon glyphicon-globe"></span>');
			
				
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
			
			
	 		if(is_event($currentservice['name']) == 1){
	 		
			 	$live_count = count_total_live_events($community_in, $currentservice['name']);
			
				if($live_count > 0){ 
				
					echo('<span class = "pull-left badge user-count-badge" style = "color:'.$color.'">'.$live_count.'</span>');
				
				}
			
			}
			
			if(service_is_home($currentservice['name'], $_GET['c'])){
				
				echo('<span class = "pull-right home-badge glyphicon glyphicon-home"></span>');
			
				
			}	
			if(is_geo_locked($currentservice['name']) == 1){
				
					echo('<span class = "pull-right home-badge glyphicon glyphicon-globe"></span>');
			
				
				}
		 
			echo('</span>');
		 
	 }
	 

	


}


if(isset($session_user_id)){

	$home = get_home_from_user_id($session_user_id);

	if(!empty($home) && $home == $_GET['c']){

		echo('<br><br><span class = "col-xs-12 no-padding aservice-list new-container">');

		$link = 'createservice.php';

	 	echo('<a data-toggle="tooltip" data-container = "body" title="Create your own board!"  data-placement="left" href="'.$link.'" style = "background-color:#aaa" class="btn btn-custom2 btn-lg btn-block">CREATE</a>');

		echo('</span>');
		
 

	}

}


/*
echo('<span class = "greyzone"><a class = "greylink" href = "about.php">About</a> | <a class = "greylink" href = "conditions.php">Terms & Conditons</a> | <a class = "greylink" href = "privacy.php">Privacy Policy</a> | <a class = "greylink" href = "copyright.php">Copyright</a> </span>');*/

echo("</span>");

echo('<br><span class = "key col-xs-12"><span class = "glyphicon-home glyphicon"></span> = Posts from this board appear on the home feed. <br><span class = "glyphicon-globe glyphicon"></span> = This board is geo-locked so you will only be able to view it if you are in the radius of this Habbitat</span>');


	
?>