<span class = "dashcontentmessages">

<?php

	$gotmessages = true;
	$sentmessages = true;

	$messages = get_user_messages($session_user_id, 0, 0);
	
	if(count($messages) <= 0){
		
		$gotmessages = false;
	}
		
	foreach ($messages as $currentmessage) {
		
		if($currentmessage['from_post'] > 2){			
			
			echo('<span class = "messagerow">');
			
		}else{
		
			echo('<span class = "messagerow">');
		
		}
		
		
		echo("<span class = 'col-xs-4 text-center'>");
		
		
		if($currentmessage['from_post'] < 3){
			
			if($currentmessage['from_post'] == 1 ){
				
				echo('<span class="glyphicon glyphicon-envelope"></span><br>');
				
			
			}else{
				
				echo('<span class="glyphicon glyphicon-comment"></span><br>');
			
			}
		
		}else{
			
			
			echo('<span class="glyphicon glyphicon-bullhorn"></span><br>');
			
		}
		
		$time = $currentmessage['second'];
	
	
		echo("<script>	var time = moment.unix(".$time.");"); 
		echo("document.write('Recieved ' + time.from(moment()));</script><br>");
		
		
		if($currentmessage['from_post'] < 3){
		
				
			if(time() > ($currentmessage['second'] + 604800)){
			
				echo("Deleting after this");
		
			}else{
		
				$delete_time = $time + 604800;
	
				echo("<script>	var delete_time = moment.unix(".$delete_time.");"); 
				echo("document.write('Deleting ' + delete_time.fromNow());</script>");
			
		
			}
		}
		
		echo('</span>');
		
		
		echo("<span class = 'col-xs-6 message".$currentmessage['id']."'>");
		
		echo('<span class = "bigmessage">'.$currentmessage['message'].'</span><br>');
		
		if($currentmessage['from_post'] > 2){	
			
			$initials = admin_initials_from_admin_id($currentmessage['admin_id']);		
			
			echo('-'.$initials.'<br>');
			
		}
		
		echo('<br>');		
		
		
		
		if($currentmessage['from_post'] !== 4){
			
			if($currentmessage['from_post'] == 1 || $currentmessage['from_post'] == 3){
		
				echo('<i class = "smallmessage">'. $currentmessage['prev_message'] . '</i><br>');
		
			
			}
			if($currentmessage['from_post'] == 0){
		
				echo('<i class = "smallmessage">'. $currentmessage['prev_message'] . '</i><br>');
		
			
			}
		
		}
		

			
			
		
		echo('</span>');
		
		
		echo("<span class = 'col-xs-2 text-center messagefunctions'>");
		
		if($currentmessage['from_post'] < 3){
			
			echo('<span class = "hoverer start_reply" onclick="start_messagereply('.$currentmessage['id'].', this)">REPLY</span>&nbsp;&nbsp;&nbsp;');
			
		//echo('<span id = "messagebutton'.$currentmessage['id'].'"><input type = "text" id = "reply">&nbsp;<span onclick="reply_message('.$currentmessage['id'].')">Reply</span></span><br>');
		
		}
		
		echo('<span class = "hoverer" onclick="delete_message('.$currentmessage['id'].', 0, this)">DELETE</span><br><br>');
		
		echo('</span>');
		
		echo('<br><hr class = "col-xs-10 col-xs-offset-1 messagehr"><br></span>');
		
		


	}


?>

<?php

	$messages = get_user_messages($session_user_id, 0, 1);
	
	if(count($messages) <= 0){
		
		$sentmessages = false;
	}
		
	foreach ($messages as $currentmessage) {
		
		echo('<span class = "messagerow">');
		
		
		echo("<span class = 'col-xs-4 text-center'>");
		
			
			echo('<span class="	glyphicon glyphicon-send"></span><br>');

		
			$time = $currentmessage['second'];
	
	
		$time = $currentmessage['second'];		
		
		echo("<script>	var time = moment.unix(".$time.");"); 	
		
		echo("document.write('Sent ' + time.from(moment()));</script><br>");	
					
		$delete_time = $time + 604800;	
		
		if(time() > ($currentmessage['second'] + 604800)){
			
			echo('Deleting when they see it');
			
		}else{	
										
			echo("<script>	var delete_time = moment.unix(".$delete_time.");"); 		
											
			echo("document.write('Deleting ' + delete_time.fromNow());</script>");
		
		}
			
			
		echo('</span>');
		
			echo("<span class = 'col-xs-6'>");
			
			echo('<i>'.$currentmessage['message'] . '</i><br><br>');		
								
			echo($currentmessage['prev_message'] . '<br><br>');
			
		
		echo('</span>');
		
		echo("<span class = 'col-xs-2 text-center messagefunctions'>");
		
			echo('<span class = "hoverer" onclick="delete_message('.$currentmessage['id'].', 1, this)">DELETE</span><br><br>');
		
		echo('</span>');
		
		echo('<br><hr class = "col-xs-10 col-xs-offset-1 messagehr"><br></span>');
		

	}
	
	if($sentmessages == false && $gotmessages == false){
		
		echo('<span class = "col-xs-8 col-sm-offset-2 text-center">');
	
		echo("<h1>You must be lonely...</h1><br><h4>You don't have any messages, you should submit some posts or send some messages yourself</h4>");
		
		echo('</span>');
		
	}


?>

</span>