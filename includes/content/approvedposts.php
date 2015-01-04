

<?php
		
$posts = get_user_posts(1, $session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "text-center">');

	echo("<h1>Haven't submitted anything?</h1><br><h4>Get on it or ill delete ur account you lil fucker</h4>");
	
	echo('</span>');
	
}
	
foreach ($posts as $currentpost) {
			
	create_display_set($currentpost['id'], 'submissions', 'load');
	
}


	
	
?>
