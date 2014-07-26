<h1>Sent</h1>

<?php

	$messages = get_user_messages($session_user_id, 0, 1);
		
	foreach ($messages as $currentmessage) {
				
		echo($currentmessage['prev_message'].'<br>');
		echo('<i>'.$currentmessage['message'].'</i><br>');
		echo('<span onclick="delete_message('.$currentmessage['id'].', 1)">Delete</span><br><br>');

	}


?>