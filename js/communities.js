function subscribe_community(community_name){
	
    $.post("../rl/core/functions/ajax.php",{function: "subscribe_community", community_name: community_name},function(data){
                
		alert(data);
    
    }); 
}

function delete_subscription(community_name){
	
    $.post("../rl/core/functions/ajax.php",{function: "delete_subscription", community_name: community_name},function(data){
                
		alert(data);
    
    }); 
}