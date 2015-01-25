function subscribe_community(community_name, service, span, graphic_type){
	
    $.post("core/functions/ajax.php",{function: "subscribe_community", community_name: community_name, service: service},function(data){
                
		if(graphic_type == 1){
			
			newhtml = '<button class="btn btn-danger btn-lg btn-block col-xs-12 delete_subscription_button" onclick="delete_subscription(\''+community_name+'\',\''+service+'\',this,2, 1)">REMOVE FROM FEED</button>';	
			
		}
		if(graphic_type == 2){
			
			newhtml = '<button class="btn btn-danger btn-me delete_subscription_button" onclick="delete_subscription(\''+community_name+'\',\''+service+'\',this,2, 2)">REMOVE FROM FEED</button>';	
			
		}	
				
	
		$(span).replaceWith(newhtml);
		    
    }); 
}

function delete_subscription(community_name, service, span, type, graphic_type){
	
    $.post("core/functions/ajax.php",{function: "delete_subscription", community_name: community_name, service: service},function(data){
                
		if(type == 1){		
				
			$(span).parent('.col-xs-12').parent('.subscription').fadeOut(100);
		
		}
		if(type == 2){
			
			if(graphic_type == 1){
			
				newhtml = '<button class="btn btn-warning btn-lg btn-block subscribe_community_button col-xs-12" onclick="subscribe_community(\''+community_name+'\',\''+service+'\',this,1)">ADD TO FEED</button>';
			
			}
			if(graphic_type == 2){
			
			
				newhtml = '<button class="btn btn-warning btn-md subscribe_community_button" onclick="subscribe_community(\''+community_name+'\',\''+service+'\',this,2)">ADD TO FEED</button>';
			
			}
			
			$(span).replaceWith(newhtml);
			
		}
    
    }); 
}

function selecthome(community_name){
    $.post("core/functions/ajax.php",{function: "select_home", community_name: community_name},function(data){
	
	
	});
	
	
}