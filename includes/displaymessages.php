<h1>Inbox</h1>

<?php

	$messages = get_user_messages($session_user_id, 0, 0);
		
	foreach ($messages as $currentmessage) {
		
		if($currentmessage['from_post'] >= 3){
			
			if($currentmessage['from_post'] == 3){
			
				echo('<i>'. $currentmessage['prev_message'] . '</i><br>');
				echo($currentmessage['message'] . '<br>');
				echo('<span onclick="delete_message('.$currentmessage['id'].', 0)">Delete</span><br><br>');
			
			}
			if($currentmessage['from_post'] == 4){
			
				echo($currentmessage['message'] . '<br>');
				echo('<span onclick="delete_message('.$currentmessage['id'].', 0)">Delete</span><br><br>');
			
			}
			
			
		}else{
				
			echo('<i>'. $currentmessage['prev_message'] . '</i><br>');
			echo($currentmessage['message'] . '<br>');
	
			echo('<span id = "'.$currentmessage['id'].'"><input type = "text" id = "reply">&nbsp;<span onclick="reply_message('.$currentmessage['id'].')">Reply</span></span><br>');
			echo('<span onclick="delete_message('.$currentmessage['id'].', 0)">Delete</span><br><br>');
		

		}

	}


?>