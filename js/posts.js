function save_post(postid){
	
    $.post("../rl/core/functions/ajax.php",{function: "save_post", post_id: postid},function(data){
                
		alert(data);
    
    }); 
}

function reply_post(postid, user_id){
	
	var spannumber = "#" + postid
	
	var message = $(spannumber).children('#reply').val();  	
	
    $.post("../rl/core/functions/ajax.php",{function: "reply_post", post_id: postid, message: message, user_id: user_id},function(data){
                
		alert(data);
    
    }); 
}


function set_hole_posts(statusIn, siteIn){
			
    $.post("../rl/core/functions/ajax.php",{function: "set_hole_posts", status: statusIn, site: siteIn}, function(data){
    	
		alert(data);
    }); 
		
}