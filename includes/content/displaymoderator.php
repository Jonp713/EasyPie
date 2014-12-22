<?php




if(isset($_GET['service'])){

	$service = $_GET['service'];

	$service = sanitize($service);

	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM services WHERE name = '$service'"));
	
	$url = get_logo_picture_url_from_character_id($result['character_id']);	
	
	$name = get_character_name_from_character_id($result['character_id']);
	
	$quote = get_random_quote_from_character_id($result['character_id'], $_GET['c'], $_GET['service']);
		
	echo '<img class = "col-xs-6 col-sm-12 img-responsive" src="'. $url . '"><br>';

	echo('<span class = "modname"><strong>'.$name.'</strong> Says:</span>');

	$newcolor = hex2rgb($colortouse);

	echo('<span class = "modquote-wrapper col-xs-12" style = "background-color:rgba('.implode($newcolor, ',').', .8);"><span class = "modquote">'.$quote.'</span></span>');	

}else{
	
	
	
}



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