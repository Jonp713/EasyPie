<?php

$communities = get_communities(0, '');

foreach ($communities as $currentcommunity){

	echo('ICU' . $currentcommunity['name'] . '<br>');
	echo($currentcommunity['state'] . '<br>');
	

	if($currentcommunity['status'] == 0){
		
		echo('Pending<br>');
				
	}
	if($currentcommunity['status'] == 1){
		
		$admin = admin_data($currentcommunity['head_admin_id'], 'codename');
		
		echo('Live<br>');
		echo('Moderator: '. $admin['codename']. '<br>');
				
	}
	if($currentcommunity['status'] == 2){
		
		echo('Shut Down<br>');
				
	}

	if($currentcommunity['needs_moderator'] == 1){
		
		echo('Alert: Needs Moderator<br>');
				
	}
	echo('Queue Count: '.community_queue_count($currentcommunity['name']).'<br>');
	
	echo('<a href = "queue.php?community=' . $currentcommunity['name'] . '">Queue</a><br>');
	echo('<a href = "denied.php?community=' . $currentcommunity['name'] . '">Denied</a><br>');
	echo('<a href = "approved.php?community=' . $currentcommunity['name'] . '">Approved</a><br>');
	echo('<a href = "overview.php?community=' . $currentcommunity['name'] . '">Overview</a><br>');
	echo('<a href = "stats.php?community=' . $currentcommunity['name'] . '">Stats</a><br><br>');

}

	
?>