<?php

if(isset($_GET['service'])){

	$service = $_GET['service'];

	$service = sanitize($service);

	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM services WHERE name = '$service'"));
	
	$url = get_logo_picture_url_from_service_name($_GET['service']);	

}else{
	
	$url = 'images/logonotext.png';
}

echo '<img class = "col-xs-6 col-sm-12 img-responsive" src="'. $url . '"><br>';

echo('<span class = "modname"><strong>NG</strong> Says:</span>');

echo('<span class = "modquote-wrapper col-xs-12" style = "background-color:'.$colortouse.'"><span class = "modquote">Im talking here!!!</span></span>');	

/*
//old moderator bullshit
if($result['needs_moderator'] == 0){
	
	echo('<span class = "hidden-xs">');
	
	$id = $result['head_admin_id'];
	
	$admin = mysql_fetch_assoc(mysql_query("SELECT profile, initials FROM cementsalesmen WHERE id = '$id'"));
	
	echo('<span class = "modtitle">Moderator '.$admin['initials'].'</span><br><br>');
	
	$url = get_mods_picurl($id);
	
	echo '<img class = "col-xs-6 col-sm-12 img-responsive" src="'. $url . '"><br><br>';
	
	echo('</span>');
				
}

*/

	
?>