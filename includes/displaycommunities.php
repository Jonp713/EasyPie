<?php

$communities = get_communities(0, '');

foreach ($communities as $currentcommunity) {
	
	echo('ICU' . $currentcommunity['name'] . '<br>');
	echo($currentcommunity['state'] . '<br>');
	echo('<a href = "posts.php?c=' . $currentcommunity['name'] . '">Posts</a><br>');
	echo('<a href = "hole.php?c=' . $currentcommunity['name'] . '">Hole</a><br><br>');
	
	

}
	
?>