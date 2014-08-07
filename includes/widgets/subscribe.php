<?php
	
if(logged_in() == true){
	
	if(user_subscribed($user_data['user_id'], $community_in) == false){

		echo('<span class = "subscribe_community_button" onclick="subscribe_community(\''.$community_in.'\','.$user_data['user_id'].')"><p>Subscribe to this community</p></span><br><br>');
	

	}else{
		
		echo("<span class = 'you_are_subscribed'>You are subscribed to this community</span><br>");
		echo('<span class = "delete_subscription_button" onclick="delete_subscription(\''.$community_in.'\','.$session_user_id.')">Unsubscribe</span><br><br>');
		
		
	}
	
	
}else{
	
	
	echo('Log In to subscribe to this community');
	
}
	
?>

