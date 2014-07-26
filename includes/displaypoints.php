<h1>My Points</h1>

<?php

	$points = count_user_points($session_user_id, 0, null);
	
	echo('Total: '.$points);

?>