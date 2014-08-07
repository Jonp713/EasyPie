<h1>Notifications</h1>

<?php

	$notifications = get_notifications($session_user_id, 0);
		
	foreach ($notifications as $currentnot) {
				
		echo($currentnot['textin'].'<br>');
		notification_seen($currentnot['id'], $session_user_id);

	}


?>