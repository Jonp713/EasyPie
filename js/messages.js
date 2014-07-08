function reply_message(message_id, user_id){
	
	var spannumber = "#" + message_id;
	
	var message = $(spannumber).children('#reply').val();  	
	
    $.post("../rl/core/functions/ajax.php",{function: "reply_message", message_id: message_id, message: message, user_id: user_id},function(data){
                
		alert(data);
    
    }); 
}
