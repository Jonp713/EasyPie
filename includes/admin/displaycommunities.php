<?php


	
	echo('<span class = "admin-section col-xs-12 no-padding">');
	
	echo('<span class = "col-xs-12 section-top"><strong>Franchises you moderate:</strong></span><br>');
	
	
	$services = get_mod_services($session_user_id, 'moderator');

	foreach ($services as $currentservice){
	
		
			echo("<span class = 'col-xs-12 col-sm-4'>");
		
	   		 $color = get_service_color_from_service_name($currentservice['name']);
			 $url =  get_logo_picture_url_from_service_name($currentservice['name']);
	  		 		
 			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		
 			echo('<a href="admin.php?service='.$currentservice['name'].'&c='.$currentservice['community'].'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9">'); 
			
			$newcolor = hex2rgb($color);
			
			
			echo('<span style = "background-color:rgba('.implode($newcolor,',').', .6);" class = "service-logo-circle col-xs-2 no-padding pull-left"></span>');
			
			
			if(get_service_char_type($currentservice['name']) == "character_image" && !empty($url)){
	
				echo('<img class = "service-logo col-xs-2 no-padding pull-left" src = "'.$url.'">');
	
			}else if(get_service_char_type($currentservice['name']) == "character_text"){
	
				echo('<span class = "service-logo-text2 col-xs-2 no-padding pull-left">'. strtoupper($currentservice['name'][0]).'</span>');
	
			}
						
			if($currentservice['name'] == "ICU"){
		echo('<span class = "service-list-name2"><span class = "service-name-sub blackfont">'.strtoupper($currentservice['name']).'</span><span class = "service-name-sub blackfont">'.strtoupper($currentservice['community']).'</span></span></a>');
 			
			
			}else{
					echo('<span class = "service-list-name2"><span class = "service-name-sub blackfont">'.strtoupper($currentservice['community']).'</span><span class = "service-name-sub blackfont">'.strtoupper($currentservice['name']).'</span></span></a>');
				
			}
						
			echo('</span>');
			echo('</span>');

	}
	
	echo('</span>');
	


	
	
	echo('<span class = "admin-section col-xs-12 no-padding">');
	
	echo('<span class = "col-xs-12 section-top"><strong>Boards you own:</strong></span><br>');
	
	$services = get_mod_services($session_user_id, 'owner');

	foreach ($services as $currentservice){
	
			
			echo("<span class = 'col-xs-12 col-sm-4'>");
		
	   		 $color = get_service_color_from_service_name($currentservice['name']);
			 $url =  get_logo_picture_url_from_service_name($currentservice['name']);
	  		 		
 			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		
 			echo('<a href="admin.php?service='.$currentservice['name'].'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9">');
			
			$newcolor = hex2rgb($color);
			
			
			echo('<span style = "background-color:rgba('.implode($newcolor,',').', .6);" class = "service-logo-circle col-xs-2 no-padding pull-left"></span>');
			
			
			if(get_service_char_type($currentservice['name']) == "character_image" && !empty($url)){
	
				echo('<img class = "service-logo col-xs-2 no-padding pull-left" src = "'.$url.'">');
	
			}else if(get_service_char_type($currentservice['name']) == "character_text"){
	
				echo('<span class = "service-logo-text2 col-xs-2 no-padding pull-left">'. strtoupper($currentservice['name'][0]).'</span>');
	
			}
				
 			echo('<span class = "service-list-name2"><span class = "service-name-sub blackfont ">'.strtoupper($currentservice['name']).'</span></span></a>');
						
			echo('</span>');
			echo('</span>');


	}
	
	echo('</span>');
	
	


	
	echo('<span class = "admin-section col-xs-12 no-padding">');
	
	echo('<span class = "col-xs-12 section-top"><strong>Communities you run:</strong></span><br>');

	$communitys = get_mod_communities($session_user_id, 'overseer');

	foreach ($communitys as $currentcommunity){
	
		
			echo("<span class = 'col-xs-12 col-sm-4'>");
		
			$name = strtoupper($currentcommunity["name"]);

		//	echo('<a class = "communitynamecom" href = "admin.php?community=' . $currentcommunity['name'] . '"><span class ="communityname"><font color = "'.$currentcommunity["color"].'">'. $name  .'</font></span></a>');
						
						
			echo('</span>');
			
	
	

	}
	
	echo('</span>');
	
	echo('</span>');

	
?>