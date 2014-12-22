
var sf = [

	{id: '#sf-ICU'},
	{id: '#sf-Bone'},
	{id: '#sf-Hole'},
	{id: '#sf-Events'},
	
	
];


for(i=0; i < sf.length; i++){
			
	var sfactive = $(sf[i].id).attr('data-active');

	if(sfactive == "notactive"){
		
		$(sf[i].id).hide();
				
		$(sf[i].id + '-textarea').attr("disabled", true);
		$(sf[i].id + '-service').attr("disabled", true);
		$(sf[i].id + '-comments').attr("disabled", true);
		$(sf[i].id + '-is_image').attr("disabled", true);
		$(sf[i].id + '-image').attr("disabled", true);
		$(sf[i].id + '-reply').attr("disabled", true);
		
			
	}else{
		
		$(sf[i].id + '-icon').addClass('active');
		
	}

}

$( ".service-submit-button" ).click(function() {
	    
	var sfnumber = this.getAttribute('data-target');
	
	$(this).addClass('active').siblings().removeClass('active');
	
	if(sfnumber == "#sf-Bone" && logged_in == false){
		
		$('.post-submit-button').attr("disabled", true);
	}else{
		$('.post-submit-button').attr("disabled", false);
		
		
	}
	
	for(i=0; i< sf.length; i++){
		
		if(sf[i].id == sfnumber){
		
			$(sf[i].id).show();
			$(sf[i].id + '-textarea').attr("disabled", false);
			$(sf[i].id + '-service').attr("disabled", false);
			$(sf[i].id + '-comments').attr("disabled", false);
			$(sf[i].id + '-is-image').attr("disabled", false);
			$(sf[i].id + '-reply').attr("disabled", false);
		
		
		}else{
		
			$(sf[i].id).hide();
			$(sf[i].id + '-textarea').attr("disabled", true);
			$(sf[i].id + '-service').attr("disabled", true);
			$(sf[i].id + '-comments').attr("disabled", true);
			$(sf[i].id + '-is-image').attr("disabled", true);
			$(sf[i].id + '-image').attr("disabled", false);
			$(sf[i].id + '-reply').attr("disabled", false);
		
		
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

