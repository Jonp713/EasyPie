
function judgement(post_id, judgement, span){	
	
    $.post("core/functions/ajax.php",{function: "judgement", post_id: post_id, judgement: judgement, community: getURLParameter('c'), service: getURLParameter('service')},function(data){
                
    		$(span).closest("#post"+post_id).fadeOut(300);
          
	    });     	
}


function sendto(post_id, span){
	
	towards = $('.send-to'+post_id).val();
		
    $.post("core/functions/ajax.php",{function: "send_to", post_id: post_id, towards: towards, community: getURLParameter('c'), service: getURLParameter('service')},function(data){
		
		$(span).closest("#post"+post_id).fadeOut(300);
			
	});
	
}


function addtodb(community, service, post_id, span){
	
	//var img_src = $(span).closest(".meme-image").attr('src');
		
    $.post("core/functions/ajax.php",{function: "addtodb", post_id: post_id, community: community, service: service},function(data){
		
	 	html = '<span class="alert alert-success" role="alert">Meme added, I think you made a good choice.</span>';
 	
		$("#topalert").html(html);

		$("#topalert").fadeIn("slow", function() { $(this).delay(7000).fadeOut("slow");
		 
		 });
		 
		 
	});
	
}

function delete_meme(pic_id){
    $.post("core/functions/ajax.php",{function: "delete_meme", pic_id: pic_id},function(data){
		
		
		$("#meme"+pic_id).fadeOut(300);
		

	});
	
}

function get_more_admin_posts(start, site, service, type){

	if(service == null){
		
		service = "all";
	}
	
	if(type == null){
		
		type = "queue";
	}
	
    $.post("core/functions/ajax.php",{function: "get_more_admin_posts", start: start, site: site, service: service, type: type}, function(data){
		
		$('#clickmore').replaceWith();
				
		$('#posts').append(data);    
				
		$(".changeme").each(function() {
  
  		  	var seconds = $(this).text();
		
			var time = moment.unix(seconds);
			
			$(this).replaceWith(time.from(moment()));
						
		});
		
		$(".changeme3").each(function() {
  
  		  	var seconds = $(this).text();
		
			var time = moment.unix(seconds);
			
			
			$(this).replaceWith('Ends ' + time.from(moment()));
						
		});
		
		$(".changeme2").each(function() {
  
  		  	var seconds = $(this).text();
		
			seconds = parseInt(seconds);
			
			$(this).replaceWith(moment.duration(seconds, 'seconds').humanize() + ' long');
						
						
		}); 
		
	});
			
}
