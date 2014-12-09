<?php

moderator_protect_page();

$communities = get_communities(0, '');

foreach ($communities as $currentcommunity){
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-6">');

	echo('ICU' . $currentcommunity['name'] . '<br>');
	echo('State: '.$currentcommunity['state'] . '<br>');
	
	$admin = admin_data($currentcommunity['head_admin_id'], 'codename');

	if($currentcommunity['status'] == 0){
		
		echo('Status: Pending<br>');
				
	}
	if($currentcommunity['status'] == 1){
		
		echo('Status: Live<br>');
				
	}
	if($currentcommunity['status'] == 2){
		
		echo('Status: Shut Down<br>');
				
	}else{

		if($currentcommunity['needs_moderator'] == 1){
		
			echo('<div class="alert alert-danger" role="alert">Alert: Needs Head Moderator</div>');
				
		}else{
		
			echo('Head Moderator: <a href = "profile.php?codename='. $admin['codename']. '">'. $admin['codename']. '<br>');
		}
	
	}
	
	echo('<a href = "queue.php?community=' . $currentcommunity['name'] . '">Queue</a> <span class = "badge">'.community_queue_count($currentcommunity['name']).'</span><br>');
	echo('<a href = "denied.php?community=' . $currentcommunity['name'] . '">Denied</a><br>');
	echo('<a href = "approved.php?community=' . $currentcommunity['name'] . '">Approved</a><br>');
	echo('<a href = "overview.php?community=' . $currentcommunity['name'] . '">Overview</a><br>');
	echo('<a href = "stats.php?community=' . $currentcommunity['name'] . '">Stats</a><br>');
	echo('<a href = "points.php?community=' . $currentcommunity['name'] . '">Points</a><br>');
	
	echo('</span></span>');

}

	
?>