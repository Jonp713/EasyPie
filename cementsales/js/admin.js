function message_mod(service, type){
	
	var spannumber = "." + service + "message"
	
	var messageIn = $(spannumber).children('input').val();  	
	
    $.post("../cementsales/core/functions/ajax.php",{function: "message_mods", service: service, message: messageIn, type: type},function(data){
              
			var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Message Sent</span></div>';
    
			$(spannumber).replaceWith(newhtml);
						
		
	});     
}


function homeing(service_id, judgement){
	
    $.post("../cementsales/core/functions/ajax.php",{function: "homeing", service_id: service_id, judgement: judgement}, function(data){
              			  
						  
						  
		if(judgement == 0){
			
			var spannumber = "." + service_id + "dehome";
			
			var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">Removed from Home Feed</span></div>';
			
		}  
		if(judgement == 1){
			
			var spannumber = "." + service_id + "addhome";
			
			var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Added to Home Feed</span></div>';
			
			
		}
		$(spannumber).replaceWith(newhtml);       
    			
    }); 
}

function defranchise(service_id){
    $.post("../cementsales/core/functions/ajax.php",{function: "defranchise", service_id: service_id}, function(data){
		
		var spannumber = "." + service_id + "defranchise";
		
		var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">Board Defranchised</span></div>';
		
		$(spannumber).replaceWith(newhtml);      
				
	});


}

function delete_service(service_id){
    $.post("../cementsales/core/functions/ajax.php",{function: "delete_service", service_id: service_id}, function(data){
		
		var spannumber = "." + service_id + "delete";
		
		var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">Board deleted</span></div>';
		
		$(spannumber).replaceWith(newhtml);      
				
	});


}


function judgement(post_id, judgement){
	
    $.post("../cementsales/core/functions/ajax.php",{function: "judgement", post_id: post_id, judgement: judgement},function(data){
              			  
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

function change_service(post_id, judgement){
	
	var service = $("#post" + post_id + "-service-form").val();
		
    $.post("../cementsales/core/functions/ajax.php",{function: "change_service", post_id: post_id, service: service},function(data){
              			  
		var spannumber = ".post" + post_id + "service";
		
		var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Service Changed To '+service+'</span></div>';
	
		$(spannumber).replaceWith(newhtml);       
    	
    }); 
}


function admin_reply(post_id){
	
	var spannumber = "." + post_id + "reply"
	
	var messageIn = $(spannumber).children('input').val();  	
	
    $.post("../cementsales/core/functions/ajax.php",{function: "admin_reply", post_id: post_id, message: messageIn},function(data){
              
		if(data == true){
		
			var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Admin Reply Sent</span></div>';
    
			$(spannumber).replaceWith(newhtml);       
		 
		}else{
			
			var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">'+ data + '</span></div>';
    
			$(spannumber).replaceWith(newhtml);
		}
    }); 
}

function send_admin_message(user_id){
	
	var spannumber = "." + user_id + "send"
	
	var messageIn = $(spannumber).children('input').val();  	
	
    $.post("../cementsales/core/functions/ajax.php",{function: "send_admin_message", user_id: user_id, message: messageIn},function(data){
              
		if(data == true){
		
			var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Message Sent</span></div>';
    
			$(spannumber).replaceWith(newhtml);
		
		}else{
			
			var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">'+ data + '</span></div>';

			$(spannumber).replaceWith(newhtml);
		}
		
	});     
}


function give_points(post_id, community_name){
	
	var spannumber = "." + post_id + "points";
	
	var amountIn = $(spannumber).children('input').val();  	
	
    $.post("../cementsales/core/functions/ajax.php",{function: "give_points", post_id: post_id, amount: amountIn, community_name: community_name},function(data){
	
		if(data == true){
		
			var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">'+ amountIn + ' Points Given</span></div>';
    
			$(spannumber).replaceWith(newhtml);
			
		}else{
			
			var newhtml = '<div class="alert alert-danger" role="alert"><span class="alert-link">'+ data + '</span></div>';
    
			$(spannumber).replaceWith(newhtml);
			
		}
    
    }); 
}

function delete_admin_post(admin_post_id){
			
    $.post("../cementsales/core/functions/ajax.php",{function: "delete_admin_post", admin_post_id: admin_post_id},function(data){
				
		var newhtml = '<div class="alert alert-success" role="alert"><span class="alert-link">Admin Post is no longer live</span></div>';
    
		$("#admin_post" + admin_post_id).replaceWith(newhtml);
		
    }); 
}


function remove_pic(pic_id){
			
    $.post("../cementsales/core/functions/ajax.php",{function: "remove_pic", pic_id: pic_id}, function(data){
				
		alert(data);  
		    
    }); 
}

function blacklist(ip){
			
    $.post("../cementsales/core/functions/ajax.php",{function: "blacklist", ip: ip}, function(data){
				
		alert(data); 
				    
    }); 
}

function remove_blacklist(ip){
			
    $.post("../cementsales/core/functions/ajax.php",{function: "remove_blacklist", ip: ip}, function(data){
				
		alert(data); 
				    
    }); 
}

function ok_requests(id){
			
    $.post("../cementsales/core/functions/ajax.php",{function: "ok_requests", id: id}, function(data){
				
		alert(data); 
				    
    }); 
}

function get_more_denied_posts_admin(start, site, type){
	
    $.post("../cementsales/core/functions/ajax.php",{function: "get_more_denied_posts_admin", start: start, site: site, type: type}, function(data){
		
		$('#clickmore').replaceWith();       
				
		$('#posts').append(data);       
				    
    }); 
	
}

function get_more_approved_posts_admin(start, site, type){
	
    $.post("../cementsales/core/functions/ajax.php",{function: "get_more_approved_posts_admin", start: start, site: site, type: type}, function(data){
		
		$('#clickmore').replaceWith();       
				
		$('#posts').append(data);       
				    
    }); 
	
}