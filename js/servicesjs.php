<script>

///set posts
<?php $services = get_services_ajax($community_in);?>

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
	
	$(this).addClass('active').siblings().removeClass('active');
	
	
	
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


function toggle_create_service_logo(switchx){
		

	if(switchx == "off"){
	$('.logo_pic').addClass( "picture-disabled" );		
	
	}else{
		$('.logo_pic').removeClass( "picture-disabled" );		
	
	
	}
	
		
}

</script>

