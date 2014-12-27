<span class = "dashcontentmessages">

<?php
$sentmessages = true;


	$messages = get_user_messages($session_user_id, 0, 1);
	
	if(count($messages) <= 0){
		
		$sentmessages = false;
	}
		
	foreach ($messages as $currentmessage) {
				
		echo('<span class = "messagerow amessage col-xs-12">');
				
		echo("<span class = 'col-xs-4 message-icon text-center'>");
		
			
			echo('<span class="glyphicon glyphicon-send"></span><br>');

		
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
			
			echo('<span class = "bigmessage"><i>'.$currentmessage['message'] . '</i></span><br><br>');		
								
			echo('<span class = "smallmessage">'.$currentmessage['prev_message'] . '</span><br>');
			
		
		echo('</span>');
		
		echo("<span class = 'col-xs-2 text-center messagefunctions'>");
		
			echo('<span class = "hoverer" onclick="delete_message('.$currentmessage['id'].', 1, this)">DELETE</span><br><br>');
		
		echo('</span>');
		echo('</span>');
		
		echo('<span class = "col-xs-12 anymessage-bottom message'.$currentmessage['id'].'-bottom"></span>');
		
				
      
	}
	
	if($sentmessages == false){
		
		echo('<span class = "text-center">');
	
		echo("<h1>Are you anti-social or something?</h1><br><h4>Send some messages to keep this world moving...</h4>");
		
		echo('</span>');
		
	}
	
?>

</span>
	
	