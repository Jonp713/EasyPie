<?php

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	echo("<h1>Live Posts</h1>");
	
	$admin_posts = get_admin_post($_GET['community'], $session_admin_id, 0, 1);

	foreach ($admin_posts as $currentpost) {
		echo('<span class = "row">');
		echo('<span class = "well well-sm col-xs-6">');
		echo('<span id = "admin_post'.$currentpost['id'].'">');
		
		$codename = admin_data($currentpost['admin_id'], 'codename');

		echo($currentpost['message'] . '<br>');
		echo('Submitted by: <i>'.$codename["codename"].'</i><br>');
		echo('<span class = "btn btn-default btn-sm" onclick="delete_admin_post('.$currentpost['id'].')"><span class="glyphicon glyphicon-arrow-down"></span>Take Down</span>');
		
		echo('<br></span></span></span><br>');

	}

}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	echo("<h1>".$_GET['codename']." Admin Posts</h1>");
	
	$admin_posts = get_admin_post(null, admin_id_from_codename($_GET['codename']), 0, 2);

	foreach ($admin_posts as $currentpost) {
		
		echo('<span class = "row">');
		echo('<span class = "well well-sm col-xs-6">');
		echo('<span id = "admin_post'.$currentpost['id'].'">');

		echo($currentpost['message'] . '<br>');
		
		if($currentpost['status'] == 0){
			
			echo('<span class = "btn btn-default btn-sm" onclick="delete_admin_post('.$currentpost['id'].')"><span class="glyphicon glyphicon-arrow-down"></span>Take Down</span>');
		
			echo('<br></span></span></span><br>');
		
		}else{
			
			echo('</span></span></span>');
		}


	}
	
}

if(isset($_GET['codename']) == false && isset($_GET['community']) == false){
	
	echo("<h1>Live Posts</h1>");

	$admin_posts = get_admin_post($admin_data['community'], $session_admin_id, 0, 0);

	foreach ($admin_posts as $currentpost) {
		echo('<span class = "row">');
		echo('<span class = "well well-sm col-md-6">');
		echo('<span id = "admin_post'.$currentpost['id'].'">');

		echo($currentpost['message'] . '<br>');
		
		echo('<span class = "btn btn-default btn-sm" onclick="delete_admin_post('.$currentpost['id'].')"><span class="glyphicon glyphicon-arrow-down"></span>Take Down</span>');
		
		echo('<br></span></span></span><br>');


	}

}


?>