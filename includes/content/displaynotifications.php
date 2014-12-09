<span class = "dashcontentnot">


<?php

	$notifications = get_notifications($session_user_id, 0);
	
	if(count($notifications) <= 0){
		
		echo('<span class = "col-xs-8 col-sm-offset-2 text-center">');
	
		echo("<br><br><h1>No notifications</h1><br><h4>Its okay, you'll get some soon</h4>");
		
		echo('</span>');
		
	}
		
	foreach ($notifications as $currentnot) {
		
		echo("<span class = 'row'>");
		
		echo("<span class = 'col-xs-3 text-center'>");
			
		if($currentnot['type'] == "saved_post"){
			echo('<span class="glyphicon glyphicon-star"></span><br>');
			
		}
		if($currentnot['type'] == "admin_reply"){
			
			echo('<span class="glyphicon glyphicon-bullhorn"></span><br>');
			
		}
		if($currentnot['type'] == "post_approved"){
			
			echo('<span class="glyphicon glyphicon-ok"></span><br>');
			
			
		}	
		if($currentnot['type'] == "reply_message"){
			
			echo('<span class="glyphicon glyphicon-comment"></span><br>');
			
			
		}	
		if($currentnot['type'] == "reply_post"){
			
			echo('<span class="glyphicon glyphicon-envelope"></span><br>');
			
			
		}	
		if($currentnot['type'] == "give_points"){
			echo('<span class="glyphicon glyphicon-gift"></span><br>');
			
			
		}
		if($currentnot['type'] == "admin_message"){
			
			echo('<span class="glyphicon glyphicon-bullhorn"></span><br>');
			
		}				
			
			
		echo('</span>');
		
		
		echo("<span class = 'col-xs-6'>");
		
			
		echo('<span class = "notificationtext">'.$currentnot['textin'].'</span><br>');
		notification_seen($currentnot['id'], $session_user_id);
		
		echo('<span class = "extranottext">');
		
		if($currentnot['type'] == "saved_post"){

			$post = post_text_from_post_id($currentnot['ref_id']);
			
			if(isset($post)){

				echo($post);
				
			}
						
		}
		if($currentnot['type'] == "admin_reply"){
			
			$post = post_text_from_post_id($currentnot['ref_id']);
			
			if(isset($post)){

				echo($post);
				
			}
						
		}
		if($currentnot['type'] == "post_approved"){
			
			$post = post_text_from_post_id($currentnot['ref_id']);
			
			if(isset($post)){

				echo($post);
				
			}
						
		}	
		if($currentnot['type'] == "reply_message"){
			
			
		}	
		if($currentnot['type'] == "reply_post"){
			
			$post = post_text_from_post_id($currentnot['ref_id']);
			
			if(isset($post)){

				echo($post);
				
			}
						
		}	
		if($currentnot['type'] == "give_points"){
			
			$post = post_text_from_post_id($currentnot['ref_id']);
			
			if(isset($post)){

				echo($post);
				
			}
			
		}
		if($currentnot['type'] == "admin_message"){
			
			
		}		
		
		echo('</span>');
		
		echo('</span>');
		
		
		echo("<span class = 'col-xs-3 text-center'>");
		
		
		$time = $currentnot['second'];
	
	
		echo("<script>	var time = moment.unix(".$time.");"); 
		echo("document.write(time.from(moment()));</script>");
			
		echo('<br></span>');
		
		echo('</span>');
		

	}


?>

</span>