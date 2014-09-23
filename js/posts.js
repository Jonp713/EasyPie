function save_post(post_id, span){
	
    $.post("core/functions/ajax.php",{function: "save_post", post_id: post_id},function(data){
                
		$(span).addClass( "selected" );		
		
		$(span).removeClass( "hoverer" );
		
    
    }); 
}

function unsave_post(post_id, span){
	
    $.post("core/functions/ajax.php",{function: "unsave_post", post_id: post_id},function(data){
                
    	$(span).closest("#post"+post_id).fadeOut(300);
	
    }); 
}

function delete_post(post_id, span){
	
    $.post("core/functions/ajax.php",{function: "delete_post", post_id: post_id},function(data){
                
    	$(span).closest("#post"+post_id).fadeOut(300);
    	
    }); 
}

function set_reply(post_id, status_in, span){
	
    $.post("core/functions/ajax.php",{function: "set_reply", post_id: post_id, status_in: status_in},function(data){
                
		if(status_in == 0){
		
			data = ('<span class = "hoverer add_reply'+post_id+'" onclick="set_reply('+post_id+', 1, this)">ENABLE-REPLY&nbsp;&nbsp;&nbsp;</span>');
		
		}
		if(status_in == 1){
		
			data = ('<span class = "hoverer remove_reply'+post_id+'" onclick="set_reply('+post_id+', 0, this)">DISABLE-REPLY&nbsp;&nbsp;&nbsp;</span>');
		
		}
		
		$(span).replaceWith(data);
		
    }); 
}

function flag(post_id, span){
	
    $.post("core/functions/ajax.php",{function: "flag", post_id: post_id},function(data){
                
		$(span).addClass( "selected" );
		
		$(span).removeClass( "hoverer" );
				    	
    }); 
}

function reply_post(post_id){
	
	var spannumber = "#reply_submit" + post_id;
	
	var message = $(spannumber).val();  	
	
	if(message == ""){
		
		$('#topalert').html('<span class="alert alert-danger" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;You cannot send a blank message</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow");
 		});
		
		
		exit();
		
	}
	
    $.post("core/functions/ajax.php",{function: "reply_post", post_id: post_id, message: message},function(data){
                
		$('#replygroup'+post_id).replaceWith('');
		
		$('#topalert').html('<span class="alert alert-success" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;Your Message Has Been Sent</span>');
   
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow"); });
    
	   });
	
	
}


function set_hole_posts(statusIn, siteIn){
			
    $.post("core/functions/ajax.php",{function: "set_hole_posts", status: statusIn, site: siteIn}, function(data){
    	
		alert(data);
		
		
    }); 
		
}


function get_more_approved_posts(start, site){
	
    $.post("core/functions/ajax.php",{function: "get_more_approved_posts", start: start, site: site}, function(data){
		
		$('#clickmore').replaceWith();       
				
		$('#posts').append(data);    
		
		$(".changeme").each(function() {
  
  		  	var seconds = $(this).text();
		
			var time = moment.unix(seconds);
			
			$(this).replaceWith(time.from(moment()));
						
		});
		
	});
			
}

function start_reply(span, id){
	
	span.onclick = '';
	
	$(span).addClass( "selected" );
	
	$(span).removeClass( "hoverer" );
		
	data = '<span class = "form-group col-xs-12" id = "replygroup'+id+'"><textarea class = "form-control col-xs-2" id = "reply_submit'+id+'" placeholder = "ICU2..."></textarea><span class = "col-xs-1 replysendbutton pull-right btn-info btn-sm" onclick="reply_post('+id+')">SEND</span></span>';
	
	$("#post"+id).append(data);
	
}


function get_more_feed_posts(start){
	
	
    $.post("core/functions/ajax.php",{function: "get_more_feed_posts", start: start}, function(data){
		
		$('#clickmore').replaceWith();       
						
		$('#posts').append(data);    
		
		$(".changeme").each(function() {
  
  		  	var seconds = $(this).text();
		
			var time = moment.unix(seconds);
			
			$(this).replaceWith(time.from(moment()));
						
		});   
				    
    }); 
	
}


