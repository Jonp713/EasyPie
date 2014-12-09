<?php

$community = $_GET['c'];

$community = sanitize($community);

$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));

if($result['status'] <= 1){
	
	if($result['needs_moderator'] == 0){
		
		echo('<span class = "hidden-xs">');
		
		$id = $result['head_admin_id'];
		
		$admin = mysql_fetch_assoc(mysql_query("SELECT profile, initials FROM cementsalesmen WHERE id = '$id'"));
		
		echo('<span class = "modtitle">Moderator '.$admin['initials'].'</span><br><br>');
		
		$url = get_mods_picurl($id);
		
		echo '<img class = "col-xs-6 col-sm-12 img-responsive" src="'. $url . '"><br><br>';
		
		echo('</span>');
					
	}

}
	
?>