<script>

///set posts
<?php if (isset($community_in)){ $services = get_services_ajax($community_in);?>

//display posts
var services = <?php echo json_encode($services); ?>;

var sf = [];


for(i=0; i < services.length; i++){
	
	sf.push({id: '#sf-' + services[i]});

}

for(i=0; i < sf.length; i++){
			
	var sfactive = $(sf[i].id).attr('data-active');

	if(sfactive == "notactive"){
		
		$(sf[i].id).hide();
		
			
	}else{
		
		$(sf[i].id + '-icon').addClass('active');
		
	}

}

$( ".service-submit-button" ).click(function() {
	    
	var sfnumber = this.getAttribute('data-target');
	
	$('.service-submit-button').removeClass('active');
	
	$(this).addClass('active');
	
	for(i=0; i< sf.length; i++){
		
		if(sf[i].id == sfnumber){
		
			$(sf[i].id).show();
			
		
		
		}else{
		
			$(sf[i].id).hide();
	
		
		
		}
		
	}

});


$('#recurring').change(function (){
	
	
	value = $('#recurring').val();
	
	if(value == "Not"){
		
		$('#recurring_end').hide();
	
		$('#recurring_end').fadeOut();
	
		
	}else{		
		
		$('#recurring_end').show();
		
		$('#recurring_end').fadeIn();
		
	}
	
});

<?php } ?>

function youtube_parser(url, service){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match&&match[7].length==11){

        $('#vurl_' + service).val(match[7]);
 
    }else{
        alert("Url incorrect");
    }
}

function toggle_post_video(service){
	$('#post-vid-form-'+service).toggleClass( "picture-disabled" );		
	
	
}


function toggle_post_picture(service){
	$('#post-pic-form-'+service).toggleClass( "picture-disabled" );		
	
	
}

function toggle_post_web(service){
	$('#post-web-form-'+service).toggleClass( "picture-disabled" );		
	
	
}


function toggle_create_service_logo(switchx){
		

	if(switchx == "off"){
		
		$('.logo_pic').addClass( "picture-disabled" );
	
		$('.character-forms').hide();		
	
	}else{
		
		$('.logo_pic').removeClass( "picture-disabled" );		
	
		$('.character-forms').show();		
	
	}
	
		
}

</script>

