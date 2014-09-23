

<?php
		
$posts = get_user_posts(1, $session_user_id);

if(count($posts) <= 0){
	
	echo('<span class = "col-xs-8 col-sm-offset-2 text-center">');

	echo("<h1>Haven't submitted anything?</h1><br><h4>You've got to have a crush on SOMEBODY, post about it!</h4>");
	
	echo('</span>');
	
}
	

foreach ($posts as $currentpost) {
	
	display_post($currentpost['id'], 'post', 'site', 'share_post', 'display_time', 'points_awarded', 'reply_toggle', 'delete_post-user');	
	
}
	
	
?>

</span>