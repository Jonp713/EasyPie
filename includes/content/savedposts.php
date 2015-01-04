<?php
	
$posts = get_user_saved_posts($session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "text-center">');

	echo("<h1>Dont think anything here is worth saving?</h1><br><h4>Like we care.......</h4>");
	
	echo('</span>');
	
}
	

foreach ($posts as $currentpost){
	

	
		
	create_display_set($currentpost['id'], 'saved', 'load');
	
		
}


?>
