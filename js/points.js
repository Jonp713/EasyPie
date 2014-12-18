function give_point(post_id, span){
	
    $.post("core/functions/ajax.php",{function: "give_point", post_id: post_id},function(data){
                
		$(span).addClass( "icon-selected" );		
		
		$(span).removeClass( "hoverer-icon" );
				
		$(span).attr("onclick","");
		
		var value = $('#point-count' + post_id).text();
		
		value = parseInt(value);
		
		value = value + 1;
    
		$('#point-count' + post_id).text(value);
		
    }); 
}