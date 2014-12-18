
var sf = [

	{id: '#sf-ICU'},
	{id: '#sf-Bone'},
	{id: '#sf-Hole'}
	
	
];


for(i=0; i < sf.length; i++){
			
	var sfactive = $(sf[i].id).attr('data-active');

	if(sfactive == "notactive"){
		
		$(sf[i].id).hide();
				
		$(sf[i].id + '-textarea').attr("disabled", true);
		$(sf[i].id + '-service').attr("disabled", true);
		$(sf[i].id + '-comments').attr("disabled", true);
		
			
	}

}

$( ".service-submit-button" ).click(function() {
	    
	var sfnumber = this.getAttribute('data-target');
	
	$(this).addClass('active').siblings().removeClass('active');	
	
	for(i=0; i< sf.length; i++){
		
		if(sf[i].id == sfnumber){
		
			$(sf[i].id).show();
			$(sf[i].id + '-textarea').attr("disabled", false);
			$(sf[i].id + '-service').attr("disabled", false);
			$(sf[i].id + '-comments').attr("disabled", false);
		
		
		}else{
		
			$(sf[i].id).hide();
			$(sf[i].id + '-textarea').attr("disabled", true);
			$(sf[i].id + '-service').attr("disabled", true);
			$(sf[i].id + '-comments').attr("disabled", true);
		
		}
		
	}

});



