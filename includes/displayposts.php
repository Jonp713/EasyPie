<h1>Posts</h1>

<?php

	$posts = get_posts(0, $community_in, false);

	foreach ($posts as $currentpost) {
		
		echo($currentpost['post'] . '<br>');
		echo($currentpost['display_time'] . '<br>');
		echo('<span class = "save_post" onclick="save_post('.$currentpost['id'].')">Save Post</span><br>');
		
		if($currentpost['reply_on'] == 1){
		
			echo('<span id = "'.$currentpost['id'].'"><input type = "text" id = "reply">&nbsp;<span onclick="reply_post('.$currentpost['id'].', '.$session_user_id.')">Reply</span></span><br><br>');
		
		}else{
		
			echo('<br>');
		
		}
	
	}

?>