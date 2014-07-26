function judgement(post_id, judgement){
	
    $.post("../admin/core/functions/ajax.php",{function: "judgement", post_id: post_id, judgement: judgement},function(data){
                
		alert(data);  
    	
	
    }); 
}

function admin_reply(post_id){
	
	var spannumber = "#" + post_id + "reply"
	
	var messageIn = $(spannumber).children('#reply').val();  	
	
    $.post("../admin/core/functions/ajax.php",{function: "admin_reply", post_id: post_id, message: messageIn},function(data){
              
		alert(data);  
    
    }); 
}

function send_admin_message(user_id){
	
	var spannumber = "#" + user_id + "send"
	
	var messageIn = $(spannumber).children('#send').val();  	
	
    $.post("../admin/core/functions/ajax.php",{function: "send_admin_message", user_id: user_id, message: messageIn},function(data){
              
		alert(data);  
    
    }); 
}


function give_points(post_id, community_name){
	
	var spannumber = "#" + post_id + "points"
	
	var amountIn = $(spannumber).children('#points').val();  	
	
    $.post("../admin/core/functions/ajax.php",{function: "give_points", post_id: post_id, amount: amountIn, community_name: community_name},function(data){
				
		alert(data);  
    
    }); 
}

function delete_admin_post(admin_post_id){
			
    $.post("../admin/core/functions/ajax.php",{function: "delete_admin_post", admin_post_id: admin_post_id},function(data){
				
		alert(data);  
    
    }); 
}


function remove_pic(pic_id){
			
    $.post("../admin/core/functions/ajax.php",{function: "remove_pic", pic_id: pic_id}, function(data){
				
		alert(data);  
		    
    }); 
}

function blacklist(ip){
			
    $.post("../admin/core/functions/ajax.php",{function: "blacklist", ip: ip}, function(data){
				
		alert(data); 
				    
    }); 
}

function remove_blacklist(ip){
			
    $.post("../admin/core/functions/ajax.php",{function: "remove_blacklist", ip: ip}, function(data){
				
		alert(data); 
				    
    }); 
}