function judgement(post_id, judgement){
	
    $.post("../admin/core/functions/ajax.php",{function: "judgement", post_id: post_id, judgement: judgement},function(data){
              			  
		if(judgement == 1){
			
			var spannumber = "." + post_id + "approve";
			
			var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Post Approved</span></div>';
			
		}  
		if(judgement == 2){
			
			var spannumber = "." + post_id + "deny";
			
			var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">Post Denied</span></div>';
			
			
		}
		if(judgement == 3){
			
			var spannumber = "." + post_id + "delete";
			
			var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">Post Deleted</span></div>';
		}
		
		$(spannumber).replaceWith(newhtml);       
    	
    }); 
}

function admin_reply(post_id){
	
	var spannumber = "." + post_id + "reply"
	
	var messageIn = $(spannumber).children('input').val();  	
	
    $.post("../admin/core/functions/ajax.php",{function: "admin_reply", post_id: post_id, message: messageIn},function(data){
              
		var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Admin Reply Sent</span></div>';
    
		$(spannumber).replaceWith(newhtml);       
		 
    }); 
}

function send_admin_message(user_id){
	
	var spannumber = "." + user_id + "send"
	
	var messageIn = $(spannumber).children('input').val();  	
	
    $.post("../admin/core/functions/ajax.php",{function: "send_admin_message", user_id: user_id, message: messageIn},function(data){
              
		var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Message Sent</span></div>';
    
		$(spannumber).replaceWith(newhtml);
		
	});     
}


function give_points(post_id, community_name){
	
	var spannumber = "." + post_id + "points";
	
	var amountIn = $(spannumber).children('input').val();  	
	
    $.post("../admin/core/functions/ajax.php",{function: "give_points", post_id: post_id, amount: amountIn, community_name: community_name},function(data){
				
		var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">'+ amountIn + ' Points Given</span></div>';
    
		$(spannumber).replaceWith(newhtml);
    
    }); 
}

function delete_admin_post(admin_post_id){
			
    $.post("../admin/core/functions/ajax.php",{function: "delete_admin_post", admin_post_id: admin_post_id},function(data){
				
		var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Admin Post is no longer live</span></div>';
    
		$("#admin_post" + admin_post_id).replaceWith(newhtml);
		
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

function ok_requests(id){
			
    $.post("../admin/core/functions/ajax.php",{function: "ok_requests", id: id}, function(data){
				
		alert(data); 
				    
    }); 
}