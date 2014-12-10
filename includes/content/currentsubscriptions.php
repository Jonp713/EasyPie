<span class = "subscriptionstitle">SUBSCRIPTIONS</span>

<?php

$services = get_subscriptions(0, $session_user_id, '');

foreach ($services as $currentservice){
	
	echo('<br><span style = "padding:0px;" class = "subscription col-xs-12">');

	echo('<a class = "pull-left" href = "posts.php?c=' . $currentservice['community_name'] . '&service=' . $currentservice['service'] . '">'. $currentservice['community_name'].' - '.$currentservice['service'].'</a>');		
	
	echo('');
	
	echo('<button class = "pull-right btn btn-danger btn-sm" onclick="delete_subscription(\''.$currentservice['community_name'].'\', \''.$currentservice['service'].'\', this, 1)">REMOVE</button>');
	
	
	
	echo('<span class = "pull-right">&nbsp;&nbsp;</span>');
	
	
	echo('</span><br>');
	

}

?>