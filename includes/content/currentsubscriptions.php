<span class = "subscriptions col-sm-12 hidden-xs">

<?php

$services = get_subscriptions(0, $session_user_id, '');

foreach ($services as $currentservice){
	
	echo('<br><span style = "padding:0px;" class = "subscription col-xs-12">');
	
	 $color = get_service_color_from_service_name($currentservice['service']);

	 $url =  get_logo_picture_url_from_service_name($currentservice['service']);

	 $desc = get_service_description_from_service_name($currentservice['service']);
 
	 if($currentservice['service'] == "Hole"){
	 
			$link = 'hole.php?c='.$currentservice['community_name'].'&service='.$currentservice['service'];
	 		
	}else{
 	
	 	$link = 'posts.php?c='.$currentservice['community_name'].'&service='.$currentservice['service'];
	
	}

	echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-8 servicebutton-feed"><img class = "service-logo-sub col-xs-2 no-padding" src = "'.$url.'">'); 
	
	if($currentservice['service'] == "ICU"){
	
		echo('<span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span></a>');

	}else{
		
		echo('<span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span></a>');
	}
	
	
		echo('<button class = "pull-right btn btn-danger btn-sm col-xs-3" onclick="delete_subscription(\''.$currentservice['community_name'].'\', \''.$currentservice['service'].'\', this, 1)">REMOVE</button>');
	
	
	
	
	echo('<span class = "pull-right">&nbsp;&nbsp;</span>');
	
	
	echo('</span><br>');
	

}

?>
</span>