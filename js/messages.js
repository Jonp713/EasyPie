function start_messagereply(message_id, span){
	
	span.onclick = '';
	
	$(span).addClass( "selected" );
	
	$(span).removeClass( "hoverer" );
	
	data = '<br><span class = "form-group col-xs-12" id = "messagebutton'+message_id+'"><textarea class = "form-control col-xs-2" id = "messagereply_submit'+message_id+'"></textarea><span class = "col-xs-4 col-sm-2 messagereplysendbutton pull-right btn-info btn-sm" onclick="reply_message('+message_id+')">SEND</span></span>';
		
	$(".message"+message_id).append(data);
	
}

function reply_message(message_id){
	
	var spannumber = "#messagereply_submit" + message_id;
		
	var message = $(spannumber).val();  
		
	if(message == ""){
		
		$('#topalert').html('<span class="alert alert-danger" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;You cannot send a blank message</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow");
 		});
		
		
		exit();
		
	}
		
    $.post("core/functions/ajax.php",{function: "reply_message", message_id: message_id, message: message},function(data){
                		
		$('#messagebutton'+message_id).replaceWith('');
		
		$('#topalert').html('<span class="alert alert-success" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;Your Message Has Been Sent</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow");
	
		 });
    
	 });
	
}


function delete_message(message_id, type, span){
			
    $.post("core/functions/ajax.php",{function: "delete_message", message_id: message_id, type: type},function(data){
                
    	$(span).parent('.messagefunctions').parent('.messagerow').fadeOut(300);
	
    }); 
}