<span class = "subscriptionstitle">SUBSCRIPTIONS</span>

<?php

$communities = get_subscriptions(0, $session_user_id, '');

foreach ($communities as $currentcommunity){
	
	echo('<br><span style = "padding:0px;" class = "subscription col-xs-12">');

	echo('<a class = "pull-left" href = "posts.php?c=' . $currentcommunity['name'] . '">ICU' . $currentcommunity['name'] .'</a>');		
	
	echo('');
	
	echo('<button class = "pull-right btn btn-danger btn-sm" onclick="delete_subscription(\''.$currentcommunity['name'].'\', this, 1)">UNSUBSCRIBE</button>');
	
	
	
	echo('<span class = "pull-right">&nbsp;&nbsp;</span>');
	
	if($currentcommunity['hole'] == 1){
	
	
	echo('<a class="hidden-xs pull-right btn btn-custom btn-sm" href = "hole.php?c=' . $currentcommunity['name'] . '">HOLE</a>');
	
	
	}
	
	echo('</span><br>');
	

}

?>