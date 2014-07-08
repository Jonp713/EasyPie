<h1>Messages</h1>

<?php

	$messages = get_user_messages($session_user_id, 0, 0);
		
	if($messages >= 1){

		foreach ($messages as $currentmessage) {
					
			echo('<i>'. $currentmessage['prev_message'] . '</i><br>');
			echo($currentmessage['message'] . '<br>');
		
			echo('<span id = "'.$currentmessage['id'].'"><input type = "text" id = "reply">&nbsp;<span onclick="reply_message('.$currentmessage['id'].', '.$session_user_id.')">Reply</span></span><br><br>');
		
	
		}


	}
?>