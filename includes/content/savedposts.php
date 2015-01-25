<?php
	
$posts = get_user_saved_posts($session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "speaking">');

	echo("<h1>Save while you are young</h1><br><h4>.......lol</h4>");
	
	echo('</span>');
	
}
	

foreach ($posts as $currentpost){
	

	
		
	create_display_set($currentpost['id'], 'saved', 'load');
	
		
}


?>
