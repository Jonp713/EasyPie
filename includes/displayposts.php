<h1>Posts</h1>

<?php

	$posts = get_posts(1, $community_in, 0, false);

	foreach ($posts as $currentpost) {
		
		echo($currentpost['post'] . '<br>');
		echo($currentpost['display_time'] . '<br>');
		
		
		if(logged_in() == false){
			
			echo("If you want to reply or save a post, you need to log in<br><br>");
		
			
	
		}else{
			
			echo('<span class = "save_post" onclick="save_post('.$currentpost['id'].')">Save Post</span><br>');
			
				
			if($currentpost['reply_on'] == 1){
				
				echo('<span id = "'.$currentpost['id'].'"><input type = "text" id = "reply">&nbsp;<span onclick="reply_post('.$currentpost['id'].')">Reply</span></span><br><br>');
				
		
			}else{
				
				echo('<br>');
			}
			
	
			
	
		}
	}

?>