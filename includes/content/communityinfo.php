<?php

$community = $_GET['c'];

$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));

if($result['status'] == 1){
	
	$name = strtoupper($result['name']);
	
	
	echo('<span class ="communityname">ICU<font color = "#aab341">'.$name.'</font></span><br>');
	
	echo('<span class = "communityinfo">');
	
	echo($result['description'].'<br><br>');
	
	echo("</span>");

}else{
	
	header("Location: explore.php");
	
}

?>