<?php

$community = $_GET['c'];

$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));

if($result['status'] == 1){
	
	echo('<h1>Moderator</h1>');

	if($result['needs_moderator'] == 0){
			
		$id = $result['head_admin_id'];
	
		$admin = mysql_fetch_assoc(mysql_query("SELECT profile, initials FROM cementsalesmen WHERE id = '$id'"));
		
		echo('Your moderator is: '.$admin['initials'].'<br><br>');
		
		$url = get_mods_picurl($id);
		
		echo '<img width = "200px" height = "200px" src="'. $url . '"><br><br>';
	
	}
	
	echo('<h1>Community Description</h1>');
	
	echo($result['description'].'<br><br>');

}else{
	
	header("Location: explore.php");
	
}

?>