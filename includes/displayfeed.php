<h1>My Feed</h1>


<?php
	
$posts = get_user_feed($session_user_id);

foreach ($posts as $currentpost) {

	echo($currentpost['post'] . '<br>');
	echo($currentpost['site'] . '<br>');
	echo($currentpost['display_time'] . '<br>');
	echo('<span class = "save_post" onclick="save_post('.$currentpost['id'].')"">Save Post</span><br><br>');

	if($currentpost['reply_on'] == 1){
	
		if(logged_in() == false){
		
			echo("If you want to reply, you need to log in<br><br>");
	
		}else{
	
			echo('<span id = "'.$currentpost['id'].'"><input type = "text" id = "reply">&nbsp;<span onclick="reply_post('.$currentpost['id'].')">Reply</span></span><br><br>');
	
		}

	}else{


		echo('<br>');
	

	}

}

	
?>