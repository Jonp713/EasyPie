<?php

if(check_mod_power($session_user_id) > 0){
	
	echo('<span class = "admin-section col-xs-12 no-padding">');
	
	echo('<span class = "col-xs-12 section-top"><strong>Boards you moderate:</strong></span><br>');
	
	
	$services = get_mod_services($session_user_id, 'moderator');

	foreach ($services as $currentservice){
	
		
			echo("<span class = 'col-xs-12 col-sm-4'>");
		
	   		 $color = get_service_color_from_service_name($currentservice['name']);
			 $url =  get_logo_picture_url_from_service_name($currentservice['name']);
	  		 		
 			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		
 			echo('<a href="admin.php?service='.$currentservice['name'].'&community='.$currentservice['community'].'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
			
			if($currentservice['name'] == "ICU"){
		echo('<span class = "service-list-name2"><span class = "service-name-sub blackfont">'.strtoupper($currentservice['name']).'</span><span class = "service-name-sub blackfont">'.strtoupper($currentservice['community']).'</span></span></a>');
 			
			
			}else{
					echo('<span class = "service-list-name2"><span class = "service-name-sub blackfont">'.strtoupper($currentservice['community']).'</span><span class = "service-name-sub blackfont">'.strtoupper($currentservice['name']).'</span></span></a>');
				
			}
						
			echo('</span>');
			echo('</span>');

	}
	
	echo('</span>');
	

}


if(check_mod_power($session_user_id) > 0){
	
	
	echo('<span class = "admin-section col-xs-12 no-padding">');
	
	echo('<span class = "col-xs-12 section-top"><strong>Boards you own:</strong></span><br>');
	
	$services = get_mod_services($session_user_id, 'owner');

	foreach ($services as $currentservice){
	
			
			echo("<span class = 'col-xs-12 col-sm-4'>");
		
	   		 $color = get_service_color_from_service_name($currentservice['name']);
			 $url =  get_logo_picture_url_from_service_name($currentservice['name']);
	  		 		
 			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		
 			echo('<a href="admin.php?service='.$currentservice['name'].'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
	
 			echo('<span class = "service-list-name3"><span class = "whitefont">'.strtoupper($currentservice['name']).'</span></span></a>');
						
			echo('</span>');
			echo('</span>');

	
	

	}
	
	echo('</span>');
	
	

}


if(check_mod_power($session_user_id) > 0){
	
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

}
	
?>