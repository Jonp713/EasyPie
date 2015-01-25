<span class = "dashcontentmessages">


<?php

	$notifications = get_notifications($session_user_id, 0);
	
	
	
	if(count($notifications) <= 0){
		
		echo('<span class = "col-xs-12 text-center speaking">');
	
		echo("<h1>No notifications</h1><br><h5></h5>");
		
		echo('</span>');
		
	}
		
	foreach ($notifications as $currentnot) {
		
		notification_seen($currentnot['id'], $session_user_id);
		
		
		echo("<span class = 'col-xs-12 row anotification'>");
		
		echo("<span class = 'col-xs-3 message-icon text-center'>");
			
			
		if($currentnot['type'] == "saved_post"){
		
			echo('<span class="glyphicon glyphicon-star"></span><br>');
		
		}
		
		if($currentnot['type'] == "got_defranchised"){
			echo('<span class="glyphicon glyphicon-remove-sign"></span><br>');
			
		}	
	
		if($currentnot['type'] == "home_change"){
			echo('<span class="glyphicon glyphicon-home"></span><br>');
			
		}	
	
		if($currentnot['type'] == "new_post"){
			echo('<span class="glyphicon glyphicon-unchecked"></span><br>');
			
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
			echo('<span class="glyphicon glyphicon-chevron-up"></span><br>');
			
			
		}
		if($currentnot['type'] == "admin_message"){
			
			echo('<span class="glyphicon glyphicon-bullhorn"></span><br>');
			
		}	
		if($currentnot['type'] == "comment"){
			
			echo('<span class="glyphicon glyphicon-comment"></span><br>');
			
		}					
			
			
		echo('</span>');
		
		echo("<span class = 'col-xs-6'>");
		
		echo('<span class = "notificationtext">'.$currentnot['textin'].'</span>');
		
		echo('<span class = "extranottext">');
		
		if($currentnot['type'] == "new_post"){
			
			$service_name = service_name_from_post_id($currentnot['ref_id']);
			$community_name = community_name_from_post_id($currentnot['ref_id']);
			
			echo('<a class = "plzgoup" target = "_blank" href = "admin.php?c='.$community_name.'&service='.$service_name.'">');
			
			$post = post_text_from_post_id($currentnot['ref_id']);
			
			if(!empty($post)){

				echo($post);
				
			}else{
				
				echo('view');
				
			}
			
			echo('</a>');
						
		}	
		
		
		
		if($currentnot['type'] == "saved_post"){

						
		}
		if($currentnot['type'] == "admin_reply"){
			
		
						
		}
		
		
		if($currentnot['type'] == "post_approved"){
			
		
						
		}	
		
		
		if($currentnot['type'] == "reply_message"){
			
			
			
		}	
		if($currentnot['type'] == "reply_post"){
			
						
		}	
		
		
		if($currentnot['type'] == "give_points"){
		
			
		}
		
		
		if($currentnot['type'] == "comment"){
			

			
		}
		

		if($currentnot['type'] == "admin_message"){
			
			
		}	
		
		if($currentnot['type'] == "saved_post" || $currentnot['type'] == "admin_reply" || $currentnot['type'] == "post_approved" || $currentnot['type'] == "reply_post" || $currentnot['type'] == "give_points" || $currentnot['type'] == "comment"){
		
		
			$service_name = service_name_from_post_id($currentnot['ref_id']);
			$community_name = community_name_from_post_id($currentnot['ref_id']);
			
			if($service_name == "Hole"){
				
				echo('<a class = "plzgoup" target = "_blank" href = "hole.php?c='.$community_name.'&service='.$service_name.'&comment='.$currentnot['ref_id'].'">');
				
			}else{
				
			
			echo('<a class = "plzgoup" target = "_blank" href = "posts.php?c='.$community_name.'&service='.$service_name.'&share='.$currentnot['ref_id'].'">');
			
			}
			
			$post = post_text_from_post_id($currentnot['ref_id']);
			
			
			if(!empty($post)){

				echo($post);
				
			}else{
				
				echo('view');
				
			}
			
			echo('</a>');
		
		}	
		
		echo('</span>');
		
		echo('</span>');
		
		
		echo("<span class = 'col-xs-3 text-center light'>");
		
		
		$time = $currentnot['second'];
	
	
		echo("<script>	var time = moment.unix(".$time.");"); 
		echo("document.write(time.from(moment()));</script>");
			
		echo('<br></span>');
		
		echo('</span>');
		

	}


?>

</span>
