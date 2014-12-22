<span class = "subscriptions col-sm-12 hidden-xs">

<?php

$services = get_subscriptions(0, $session_user_id, '');

foreach ($services as $currentservice){
	
	echo('<span style = "padding:0px;" class = "subscription col-xs-12">');
	
	 $color = get_service_color_from_service_name($currentservice['service']);

	 $url =  get_logo_picture_url_from_service_name($currentservice['service']);

	 $desc = get_service_description_from_service_name($currentservice['service']);
 
	 if($currentservice['service'] == "Hole"){
	 
			$link = 'hole.php?c='.$currentservice['community_name'].'&service='.$currentservice['service'];
	 		
	}else{
 	
	 	$link = 'posts.php?c='.$currentservice['community_name'].'&service='.$currentservice['service'];
	
	}

	switch($currentservice['service']){
		case "ICU":		
		
			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['community_name'].'-container">');
		
		
			echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
	
			echo('<span class = "service-list-name2"><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span></span></a>');



		break;
		case "Zombledon":		
		
			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['community_name'].'-container">');
			
			echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
 		
			$user_count = get_user_count($currentservice['service'], $currentservice['community_name']);
		
		
			echo('<span class = "service-list-name2"><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span></span></a>');
		
		
			if($user_count > 0){ 
				

				echo('<span class = "badge user-count-badge-feed" style = "color:'.$color.'">'.$user_count.'</span>');
				
			}
		
		break;
		case "Events":		
		
			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['community_name'].'-container">');
			
			echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
 		
		 	$live_count = count_total_live_events($currentservice['community_name']);
		
		
			echo('<span class = "service-list-name2"><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span></span></a>');
		
		
			if($live_count > 0){ 
				
				echo('<span class = "badge user-count-badge-feed" style = "color:'.$color.'">'.$live_count.'</span>');
				
			}
		
		break;
		default:
			
			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['community_name'].'-container">');
			
			
			echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-9 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
		
		
			echo('<span class = "service-list-name2"><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span></span></a>');
		
		}

	
			echo('<button class = "pull-right btn btn-danger btn-sm col-xs-3" onclick="delete_subscription(\''.$currentservice['community_name'].'\', \''.$currentservice['service'].'\', this, 1)">REMOVE</button>');
		
	
			echo('</span></span>');
	
}
?>
</span>