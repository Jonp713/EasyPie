<?php

	
	$admin_posts = admin_posts($_GET['c']);
	

	foreach ($admin_posts as $currentpost) {
		
		echo('<span class = "hidden-xs">');
				
		echo("<span class = 'glyphicon glyphicon-bullhorn'></span>&nbsp;&nbsp;");
		
		$time = $currentpost['second'];
		
		echo("<script>	var time = moment.unix(".$time.");"); 
		echo("document.write(time.from(moment()));</script>");
		
		echo('<br><span class = "adminpost"><h3>');
		
		echo($currentpost['message'] . '<br>');
		
		echo('</h3>');
		
		$id = $currentpost['admin_id'];
				
		$codename = mysql_result(mysql_query("SELECT `initials` FROM `cementsalesmen` WHERE `id` = '$id'"), 0, 'initials');
		
		echo("-".$codename);
		
		echo('</span><br><br>');
		
		echo('</span>');
		
		
	}
	
	

	echo('<br>');
?>