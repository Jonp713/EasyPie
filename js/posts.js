function save_post(post_id){
	
    $.post("../rl/core/functions/ajax.php",{function: "save_post", post_id: post_id},function(data){
                
		alert(data);
    
    }); 
}

function unsave_post(post_id){
	
    $.post("../rl/core/functions/ajax.php",{function: "unsave_post", post_id: post_id},function(data){
                
		alert(data);
    
    }); 
}

function delete_post(post_id){
	
    $.post("../rl/core/functions/ajax.php",{function: "delete_post", post_id: post_id},function(data){
                
		alert(data);
    	
    }); 
}

function set_reply(post_id, status_in){
	
    $.post("../rl/core/functions/ajax.php",{function: "set_reply", post_id: post_id, status_in: status_in},function(data){
                
		alert(data);
    	
    }); 
}

function flag(post_id){
	
    $.post("../rl/core/functions/ajax.php",{function: "flag", post_id: post_id},function(data){
                
		alert(data);
    	
    }); 
}

function reply_post(post_id){
	
	var spannumber = "#" + post_id
	
	var message = $(spannumber).children('#reply').val();  	
	
    $.post("../rl/core/functions/ajax.php",{function: "reply_post", post_id: post_id, message: message},function(data){
                
		alert(data);
    
    }); 
}


function set_hole_posts(statusIn, siteIn){
			
    $.post("../rl/core/functions/ajax.php",{function: "set_hole_posts", status: statusIn, site: siteIn}, function(data){
    	
		alert(data);
    }); 
		
}

function get_more_approved_posts(start, site){
	
    $.post("../rl/core/functions/ajax.php",{function: "get_more_approved_posts", start: start, site: site}, function(data){
		
		$('#clickmore').replaceWith();       
				
		$('#posts').append(data);       
				    
    }); 
	
}

function get_more_feed_posts(start){
	
    $.post("../rl/core/functions/ajax.php",{function: "get_more_feed_posts", start: start}, function(data){
		
		$('#clickmore').replaceWith();       
						
		$('#posts').append(data);       
				    
    }); 
	
}
