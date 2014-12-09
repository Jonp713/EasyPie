<?php

$community = $_GET['c'];

$community = sanitize($community);

$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));

if($result['status'] <= 1){
	
	$name = strtoupper($result['name']);
	
	echo('<span class ="communityname">ICU<font color = "'.$result['color'].'">'.$name.'</font></span><br>');
	
	echo('<span class = "communityinfo">');
	
	echo($result['description'].'<br><br>');
	
	echo("</span>");
	
	if($_GET['c'] == "Amherst"){

			echo('<a href="intro.php" target = "_blank" style = "background-color:'.$result['color'].'" class="btn btn-custom2 btn-lg btn-block">WHAT IS ICU?</a><br>');
		
	}
	


}else{
	
	header("Location: explore.php");
	
}

?>