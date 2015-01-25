

<?php
		
$posts = get_user_posts(1, $session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "speaking">');

	echo("<h1>Nothing to say?</h1><br><h4>Yeah...........</h4>");
	
	echo('</span>');
	
}
	
foreach ($posts as $currentpost) {
			
	create_display_set($currentpost['id'], 'submissions', 'load');
	
}


	
	
?>
