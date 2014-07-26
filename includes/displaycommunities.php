<?php

$communities = get_communities(0, '');

foreach ($communities as $currentcommunity){
	
	if($currentcommunity['status'] == 2){}else{

		echo('ICU' . $currentcommunity['name'] . '<br>');
		echo($currentcommunity['state'] . '<br>');
		echo('<a href = "posts.php?c=' . $currentcommunity['name'] . '">Posts</a><br>');
	
		if($currentcommunity['hole'] == 1){
	
			echo('<a href = "hole.php?c=' . $currentcommunity['name'] . '">Hole</a><br>');
	
		}
	
		echo('<br>');
	
	}
	

}

	
?>