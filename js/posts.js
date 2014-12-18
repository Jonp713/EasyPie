function view_unsorted_posts(){
	$('#unapproved-posts').show(1000, function(){
				
	});
	$('.unsorted-posts-button').fadeOut(1000, function(){
		
		$(this).hide();
		
	});
	
}


function toggle_post_picture(){
	$('#post-pic-form').toggleClass( "picture-disabled" );		
	
	
}

function save_post(post_id, span){
	
    $.post("core/functions/ajax.php",{function: "save_post", post_id: post_id},function(data){
                
		$(span).addClass( "selected" );		
		
		$(span).removeClass( "hoverer" );
		
		$(span).attr("onclick","unsave_post("+post_id+", this, 2)");
    
    }); 
}

function unsave_post(post_id, span, type){
	
	if(type == 1){
	
	    $.post("core/functions/ajax.php",{function: "unsave_post", post_id: post_id},function(data){
                
	    	$(span).closest("#post"+post_id).fadeOut(300);
	
	    }); 
	
	}
	if(type == 2){
		
	    $.post("core/functions/ajax.php",{function: "unsave_post", post_id: post_id},function(data){
                
			$(span).removeClass( "selected" );		
		
			$(span).addClass( "hoverer" );	
			
			$(span).attr("onclick","save_post("+post_id+", this)");
	    }); 
	}
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


function get_more_approved_posts(start, site, service){
	
	var isHole = false;
	
	if(service === "Hole"){
		
		isHole = true;
	}
	
    $.post("core/functions/ajax.php",{function: "get_more_approved_posts", start: start, site: site, service: service, isHole: isHole}, function(data){
		
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
		
	data = '<span id = "replygroup'+id+'"><hr class = "replysharehr"><span class = "form-group col-xs-12"><span class = "no-padding"><span onclick = "close_reply(2, '+id+')" class = "glyphicon pull-right glyphicon-remove comment-x"></span><textarea class = "form-control col-xs-2" placeholder = "Send a message..." id = "reply_submit'+id+'"></textarea><span class = "replysendbutton pull-right btn-info btn" onclick="reply_post('+id+')">SEND</span></span></span>';
	
	$("#post"+id+"-bottom").html(data);
	
}

function close_reply(type, post_id){
	
	$('#post'+post_id+'-bottom').html('');
	
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

$('.hole-post-overlay-image').mousedown(function(e){ 
  
	 $('.Hole-post').css('z-index', '-1');
  
});


$(document).mouseup(function(e){ 

	$('.Hole-post').css('z-index', '2');

});




function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}

var currentpostnumber = 30;

$(window).scroll(function() {
	
    if ($(window).scrollTop() > $(document).height() - 800)
    {
		
		if(location.pathname.substring(location.pathname.lastIndexOf("/") + 1) == 'posts.php'){
			get_more_approved_posts(currentpostnumber, getURLParameter('c'), getURLParameter('service'));

			currentpostnumber += 30;
			
			//alert(currentpostnumber);
		}
		
		if(location.pathname.substring(location.pathname.lastIndexOf("/") + 1) == 'feed.php'){
			get_more_feed_posts(currentpostnumber);

			currentpostnumber += 30;
			
			//alert(currentpostnumber);
		}

    }
});


