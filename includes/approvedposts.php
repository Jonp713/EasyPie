<h1>Submitted Posts</h1>
<?php
	
$posts = get_user_posts(1, $session_user_id);

foreach ($posts as $currentpost) {
	
	echo($currentpost['post'] . '<br>');
	echo($currentpost['site'] . '<br>');
	
	$points = get_points(2, $currentpost['id'], null);
	
	if(isset($points['amount'])){
	
		echo('Points Awarded: '. $points['amount'] . '<br>');
	
	}
	
	echo($currentpost['display_time'] . '<br>');
	echo('<span onclick="delete_post('.$currentpost['id'].')">Delete Post</span><br>');
	
	
	if($currentpost['reply_on'] == 1){
	
		echo('<span onclick="set_reply('.$currentpost['id'].', 0)">Remove Reply</span><br><br>');
	
	}
	if($currentpost['reply_on'] == 0){
	
		echo('<span onclick="set_reply('.$currentpost['id'].', 1)">Add Reply</span><br><br>');
	
	}

}
	
	
?>