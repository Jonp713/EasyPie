<?php
	
if(logged_in() == true){
	if(user_subscribed($user_data['user_id'], $community_in) == false){

		echo('<span class = "subscribe_community" onclick="subscribe_community(\''.$community_in.'\','.$user_data['user_id'].')">Subscribe to this community</span><br><br>');
	

	}else{
		
		echo("You are subscribed to this community<br><br>");
		
	}
	
	
}else{
	
	
	echo('Log In to subscribe to this community<br><br>');
	
}
	
?>

