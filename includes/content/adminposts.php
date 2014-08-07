<?php

echo("<h1>Admin Posts</h1>");
	
	$admin_posts = admin_posts($_GET['c']);

	foreach ($admin_posts as $currentpost) {
		
		//$codename = admin_data($currentpost['admin_id'], 'initials');

		echo($currentpost['message'] . '<br>');

	}

	echo('<br>')
?>