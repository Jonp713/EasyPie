<?php
	

if(logged_in() == true){
	
	echo('<span style = "padding:0px;">');	
	
	
	
	if(user_subscribed($user_data['user_id'], $community_in) == false){

		echo('<button class="btn btn-warning btn-lg btn-block subscribe_community_button col-xs-12" onclick="subscribe_community(\''.$community_in.'\',this,2)">ADD TO FEED</button>');
		
	}else{
		
		echo('<button class="btn btn-danger btn-lg btn-block col-xs-12 delete_subscription_button" onclick="delete_subscription(\''.$community_in.'\',this,2)">REMOVE FROM FEED</button>');
	}
	
	echo('</span><br><br><br>');
	
	
}else{
	
	
	//echo('Log In to subscribe to this community');
	
}
	
?>

