<?php

$communities = get_subscriptions(0, $session_user_id, '');

foreach ($communities as $currentcommunity){

	echo('ICU' . $currentcommunity['name'] . '<br>');
	echo($currentcommunity['state'] . '<br>');
	echo('<a href = "posts.php?c=' . $currentcommunity['name'] . '">Posts</a><br>');
	echo('<a href = "hole.php?c=' . $currentcommunity['name'] . '">Hole</a><br>');
	echo('<span onclick="delete_subscription(\''.$currentcommunity['name'].'\')">Unsubscribe</span><br><br>');

}

?>