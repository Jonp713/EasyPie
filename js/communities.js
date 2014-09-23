function subscribe_community(community_name, span){
	
    $.post("core/functions/ajax.php",{function: "subscribe_community", community_name: community_name},function(data){
                
		newhtml = '<button class="btn btn-danger btn-lg btn-block col-xs-12 delete_subscription_button" onclick="delete_subscription(\''+community_name+'\',this,2)">UNSUBSCRIBE</button>';	
	
		$(span).replaceWith(newhtml);
		    
    }); 
}

function delete_subscription(community_name, span, type){
	
    $.post("core/functions/ajax.php",{function: "delete_subscription", community_name: community_name},function(data){
                
		if(type == 1){		
				
			$(span).parent('.subscription').fadeOut(100);
		
		}
		if(type == 2){
			
			newhtml = '<button class="btn btn-warning btn-lg btn-block subscribe_community_button col-xs-12" onclick="subscribe_community(\''+community_name+'\',this,2)">SUBSCRIBE TO THIS COMMUNITY</button>';
			
			$(span).replaceWith(newhtml);
			
		}
    
    }); 
}