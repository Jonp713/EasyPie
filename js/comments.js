function open_comments(post_id, span){
	
	var tooltip = "";
	
	if(logged_in == true){
		
		tooltip = 'data-toggle="tooltip" title="Your username will appear next to your comment"  data-placement="bottom"';
		
	}
				
    $.post("core/functions/ajax.php",{function: "get_comments", post_id: post_id},function(data){
			
		$("#hole-comments-section").fadeIn();
		$("#actual-comments").html('<div id = "actual-comments"><span class = "col-xs-12 no-padding"><span onclick = "close_comments(1, null)" class = "glyphicon pull-left glyphicon-remove comment-x"></span></span><textarea rows = "3" placeholder = "Write a comment..." class = "form-control" name ="comment" id = "commenttoget"></textarea><button '+tooltip+' class = "btn btn-info btn-block comment_submit" onclick = "submit_comment(' + post_id + ', this, 1)">COMMENT</button><span id = "comments">' + data + '</span></div>');
		
		$('[data-toggle="tooltip"]').tooltip();
		
		
		
	});
			
			
	
	
}


function show_comments(post_id, span){
	
	var tooltip = "";
	
	if(logged_in == true){
		
		
		tooltip = 'data-toggle="tooltip" title="Your username will appear next to your comment"  data-placement="bottom"';
		
	}

    $.post("core/functions/ajax.php",{function: "get_comments", post_id: post_id},function(data){
			
		$("#post"+post_id+"-bottom").html('<div class = "col-xs-12" id = "actual-comments"><span class = "no-padding"><span onclick = "close_comments(2, '+post_id+')" class = "glyphicon pull-left glyphicon-remove comment-x"></span></span><textarea rows = "2" placeholder = "Write a comment..." class = "form-control" name ="comment" id = "commenttoget'+post_id+'"></textarea><button  '+tooltip+' class = "btn btn-info pull-right comment_submit" onclick = "submit_comment(' + post_id + ', this, 2)">COMMENT</button><br><br><span id = "comments'+post_id+'">' + data + '</span></div>');
		
		$('[data-toggle="tooltip"]').tooltip();
		
		$("#post"+post_id+"-bottom").show();	
		
	});
	
	
}


function open_comments_share(post_id, span){
	
	var tooltip = "";
	
	if(logged_in == true){
		
		
		tooltip = 'data-toggle="tooltip" title="Your username will appear next to your comment"  data-placement="bottom"';
		
	}
	
    $.post("core/functions/ajax.php",{function: "get_comments", post_id: post_id},function(data){
			
		$("#post"+post_id+"-bottom-share").html('<div class = "col-xs-12" id = "actual-comments"><span class = "no-padding"><span onclick = "close_comments(2, '+post_id+')" class = "glyphicon pull-right glyphicon-remove comment-x"></span></span><textarea rows = "2" placeholder = "Write a comment..." class = "form-control" name ="comment" id = "commenttoget'+post_id+'"></textarea><button  '+tooltip+' class = "btn btn-info pull-right comment_submit" onclick = "submit_comment(' + post_id + ', this, 2)">COMMENT</button><br><br><span id = "comments'+post_id+'">' + data + '</span></div>');
		$('[data-toggle="tooltip"]').tooltip();
		
		$("#post"+post_id+"-bottom-share").show();
		
	});
	
	
	
	

}


function close_comments(type, post_id){
	
	if(type == 1){
		
		$("#hole-comments-section").fadeOut();
		
	}
	if(type == 2){
		
		$("#post"+post_id+"-bottom").html('');
		$("#post"+post_id+"-bottom").hide();
		
	}
	
	
}


function submit_comment(post_id, span, type){
	
	var comment = "";
	
	if(type == 1){
		
		comment = $('#commenttoget').val();
		
	}
	if(type == 2){
		
		comment = $('#commenttoget' + post_id).val();
		
	}
	
	
	
	if(comment == ""){
		
		$('#topalert').html('<span class="alert alert-danger" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;Your comment cannot be blank</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow"); });
				
	}else{
	
	
    $.post("core/functions/ajax.php",{function: "submit_comment", post_id: post_id, comment: comment},function(data){
                				
		$('#topalert').html('<span class="alert alert-success" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;Commented</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow");
		
		
			if(type == 1){
		
				$('#commenttoget').val('');
			
				$('#comments').prepend('<span class = "col-xs-12 a-comment"><span class = "atext no-padding col-xs-12">' + comment + '<br><br></span><span class = "comment-username">Me</span></span>');
		
			}
			if(type == 2){
				
		
				$('#commenttoget' + post_id).val('');
			
				$('#comments' + post_id).prepend('<span class = "col-xs-12 a-comment"><span class = "atext no-padding col-xs-12">' + comment + '<br><br></span><span class = "comment-username">Me</span></span>');
	
			
			}
			
			
		 });
    
	 });
	 
 	}
	
	
}

function reply_message(message_id){
	
	var spannumber = "#messagereply_submit" + message_id;
		
	var message = $(spannumber).val();  
		
	
		
    $.post("core/functions/ajax.php",{function: "reply_message", message_id: message_id, message: message},function(data){
                		
		$('#messagebutton'+message_id).replaceWith('');
		
		$('#topalert').html('<span class="alert alert-success" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;Your Message Has Been Sent</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow");
	
		 });
    
	 });
	
}