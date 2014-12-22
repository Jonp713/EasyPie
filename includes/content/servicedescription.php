<?php

if(isset($_GET['service'])){

	$desc = get_service_description_from_service_name($_GET['service']);	
	
	$newcolor = hex2rgb($colortouse);
	

	echo('<span style = "background-color:rgba('.implode($newcolor, ',').', .7);" class = "col-xs-12 service-desc">'.$desc.'</span>');

}else{	
	
	$community = $_GET['c'];

	$community = sanitize($community);

	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));
	
	$newcolor = hex2rgb($colortouse);	

	echo('<span style = "background-color:#444" class = "col-xs-12 service-desc">'.$result['description'].'</span>');
	
		
}

?>