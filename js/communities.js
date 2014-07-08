function subscribe_community(community_name, user_id){
	
    $.post("../rl/core/functions/ajax.php",{function: "subscribe_community", community_name: community_name, user_id: user_id},function(data){
                
		alert(data);
    
    }); 
}