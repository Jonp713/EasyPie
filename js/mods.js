
function judgement(post_id, judgement, span){	
	
    $.post("core/functions/ajax.php",{function: "judgement", post_id: post_id, judgement: judgement},function(data){
                
    		$(span).closest("#post"+post_id).fadeOut(300);
          
	    });     	
}