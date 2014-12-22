function start_messagereply(message_id, span){
		
	//data = '<span id = "messagebutton'+message_id+'"><hr class = "replysharehr"><span class = "form-group col-xs-12"><span class = "no-padding"><span onclick = "close_reply(2, '+id+')" class = "glyphicon pull-right glyphicon-remove comment-x"></span><textarea class = "form-control col-xs-2" placeholder = "Send a message..." id = "messagereply_submit'+message_id+'"></textarea><span class = "replysendbutton pull-right btn-info btn messagereplysendbutton" onclick="reply_message('+message_id+')">SEND</span></span></span>';
	
	
	data = '<span class = "form-group" id = "messagebutton'+message_id+'"><br><textarea class = "form-control" id = "messagereply_submit'+message_id+'"></textarea><span class = " messagereplysendbutton pull-right btn-info btn-sm" onclick="reply_message('+message_id+')">SEND</span><br></span>';
		
	$(".message"+message_id+"-bottom").css('display', 'block');
	
	$(".message"+message_id+"-bottom").html(data);
	
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
                		

		$('#topalert').html('<span class="alert alert-success" role="alert"><span class = "glyphicon"></span> &nbsp;&nbsp;Your Message Has Been Sent</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(2000).fadeOut("slow");
		

	
		 });
		 
	

    
	 });
	 
	$(".message"+message_id+"-bottom").html('');
 	$(".message"+message_id+"-bottom").hide();

	
}


function delete_message(message_id, type, span){
			
    $.post("core/functions/ajax.php",{function: "delete_message", message_id: message_id, type: type},function(data){
                
    	$(span).parent('.messagefunctions').parent('.messagerow').fadeOut(300);
	
    }); 
}