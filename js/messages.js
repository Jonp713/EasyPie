function reply_message(message_id){
	
	var spannumber = "#" + message_id;
	
	var message = $(spannumber).children('#reply').val();  	
	
    $.post("../rl/core/functions/ajax.php",{function: "reply_message", message_id: message_id, message: message},function(data){
                
		alert(data);
    
    }); 
}


function delete_message(message_id, type){
			
    $.post("../rl/core/functions/ajax.php",{function: "delete_message", message_id: message_id, type: type},function(data){
                
		alert(data);
    
    }); 
}