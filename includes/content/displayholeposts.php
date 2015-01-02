


<?php

if($_GET['service'] == "Hole"){
	
	echo('<div id = "posts">');

	$posts = get_posts(2, $community_in, null, false, 'Hole');

	foreach ($posts[0] as $currentpost) {
		
		echo('<span class = "hole-post col-xs-12 no-padding">');
		
		display_hole_post($currentpost['id'], 'post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
		
		echo('</span><br>');
	}
	
	if($posts[1]){
		
		$start = 5;
		
		echo('<span class = "btn btn-hole btn-lg" id = "clickmore" onclick = "get_more_approved_posts('.$start.',\''.$community_in.'\',\''.$service_in.'\')">Go Deeper</span>');
	
	
	}
	
	echo('</div>');
	
	
}

?>


