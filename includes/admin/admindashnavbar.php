<?php

if(isset($_GET['service']) == true && isset($_GET['c']) == true){
	
	$p_links = ['Queue', 'Approved', 'Options'];

	foreach ($p_links as $currentlink) {
		
		if((isset($_GET['p']) && $_GET['p'] == $currentlink) || (isset($_GET['p']) == false && $currentlink == "Queue")){
	
			echo('<span class = "col-sm-12 no-padding currentlink">');
	
			echo('<span class = " dashlink ">');
	
		}else{
	
	
			echo('<span class = "col-sm-12 no-padding adashlink">');
	
			echo('<span class = " dashlink">');
	
		}
	

		echo("<a href = 'admin.php?service=".$_GET['service']."&c=".$_GET['c']."&p=".$currentlink."'>".$currentlink."</a>");

		echo('</span></span>');
		
	}
	
}


if(isset($_GET['service']) == true && isset($_GET['c']) == false){
	
	$p_links = ['Update', 'Options'];
	
	foreach ($p_links as $currentlink) {
		
		if((isset($_GET['p']) && $_GET['p'] == $currentlink) || (isset($_GET['p']) == false && $currentlink == "Update")){
	
			echo('<span class = "col-sm-12 no-padding currentlink">');
	
			echo('<span class = " dashlink ">');
	
		}else{
	
	
			echo('<span class = "col-sm-12 no-padding adashlink">');
	
			echo('<span class = " dashlink">');
	
		}
	

		echo("<a href = 'admin.php?service=".$_GET['service']."&p=".$currentlink."'>".$currentlink."</a>");

		echo('</span></span>');
		
	}


}

if(isset($_GET['service']) == false && isset($_GET['c']) == true){

	$p_links = ['Services', 'Info', 'Announcements', 'Options'];
	
	foreach ($p_links as $currentlink) {
		
		if((isset($_GET['p']) && $_GET['p'] == $currentlink) || (isset($_GET['p']) == false && $currentlink == "Services")){
	
			echo('<span class = "col-sm-12 no-padding currentlink">');
	
			echo('<span class = " dashlink ">');
	
		}else{
	
	
			echo('<span class = "col-sm-12 no-padding adashlink">');
	
			echo('<span class = " dashlink">');
	
		}
	
		echo("<a href = 'admin.php?c=".$_GET['c']."&p=".$currentlink."'>".$currentlink."</a>");

		echo('</span></span>');
		
	}


}

?>



