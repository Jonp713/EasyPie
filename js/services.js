
var sf = [

	{id: '#sf-ICU'},
	{id: '#sf-Bone'}
	
];


for(i=0; i < sf.length; i++){
			
	var sfactive = $(sf[i].id).attr('data-active');

	if(sfactive == "notactive"){
		
		$(sf[i].id).hide();
			
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



