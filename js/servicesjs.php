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




function validate_date(nameIn) {
	
	ysel = document.getElementById(nameIn+"_year");
    msel = document.getElementById(nameIn+"_month");
    dsel = document.getElementById(nameIn+"_day");
	
    var y = +ysel.value, m = msel.value, d = dsel.value;
    if (m === "2")
        var mlength = 28 + (!(y & 3) && ((y % 100)!==0 || !(y & 15)));
    else var mlength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][m - 1];
    dsel.length = 0;
    for (var i = 1; i <= mlength; i++) {
        var opt = new Option();
		if(i < 10){
	
			opt.value = opt.text = ("0" + i);
	
	
		}else{

        	opt.value = opt.text = i;

		}
        if (i == d) opt.selected = true;
        dsel.add(opt);
    }
}


function recurring(nameIn){
		
	value = $('#recurring_'+nameIn).val();
	
	if(value == "Not"){
		
		$('#recurring_end_'+nameIn).hide();
	
		$('#recurring_end_'+nameIn).fadeOut();
	
		
	}else{		
		
		$('#recurring_end_'+nameIn).show();
		
		$('#recurring_end_'+nameIn).fadeIn();
		
	}
}


//hidenshowrecurring('LICK');


</script>

