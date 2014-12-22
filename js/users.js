function user_enter(service, community){
	
    $.post("core/functions/ajax.php",{function: "user_enter", service: service, community: community},function(data){
                		
    }); 
}

function user_leave(service, community){
	
    $.post("core/functions/ajax.php",{function: "user_leave", service: service, community: community},function(data){
                		
    }); 
	
}


if(location.pathname.substring(location.pathname.lastIndexOf("/") + 1) == 'zombledon.php'){

	window.onbeforeunload = function () {
	
		if(wasAvailable){
		
			message = user_leave(getURLParameter('service'), getURLParameter('c'));
		
		}
	}

}