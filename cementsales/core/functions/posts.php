<?php

//need to santizie every variable for all of these functions
function judgement($post_id, $judgement, $admin_id){
	$post_id = sanitize($post_id);
	$judgement = sanitize($judgement);
	$admin_id = sanitize($admin_id);
	
	$time = time();
	
	if(check_admin_power($admin_id) > 0){
		
		$success = mysql_query("UPDATE `posts` SET `status` = '$judgement', `judged_by` = '$admin_id', `second_judged` = '$time' WHERE `id` = '$post_id'") or die(mysql_error());
		
	}else{

		$result = mysql_fetch_assoc(mysql_query("SELECT community FROM cementsalesmen WHERE id = '$admin_id' LIMIT 1"));
	
		$admin_site = $result['community'];
		
		$success = mysql_query("UPDATE `posts` SET `status` = '$judgement', `judged_by` = '$admin_id', `second_judged` = '$time' WHERE `id` = '$post_id' AND `site` = '$admin_site'") or die(mysql_error());	
	
	}
	
	if($success and $judgement == 1){
		
		$user_id = user_id_from_post_id($post_id);
		
		if($user_id !== 0 && $user_id !== null){
		
			create_notification($user_id, 'post_approved', 'Your post got approved!', $post_id);
		
		}
	
	}
	
	return $success;
	
}

function count_flags($admin_id){
	$admin_id = sanitize($admin_id);
		
	$result = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM posts WHERE judged_by = '$admin_id' AND flagged = 1 ORDER BY ID DESC"));
		
	return $result['total'];
}

function deflag($id, $admin_id){
	
	
}

function get_more_approved_posts_admin($start, $variable, $type){
	$start = sanitize($start);
	$variable = sanitize($variable);
	$type = sanitize($type);
	
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND site = '$variable' ORDER BY ID DESC LIMIT $start,30") or die(mysql_error());
	
	}
	
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND judged_by = '$variable' ORDER BY ID DESC LIMIT $start,30") or die(mysql_error());
	
	}

	$newposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$newposts[] = $number;		
   	}
	
	if(count($newposts) < 30){
		
		return array($newposts, false);
		
	}else{
		
		return array($newposts, true);
		
	}
}

function get_more_denied_posts_admin($start, $variable, $type){
	$start = sanitize($start);
	$variable = sanitize($variable);
	$type = sanitize($type);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM posts WHERE status = 2 AND site = '$variable' ORDER BY ID DESC LIMIT $start,30") or die(mysql_error());
	
	}
	
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM posts WHERE status = 2 AND judged_by = '$variable' ORDER BY ID DESC LIMIT $start,30") or die(mysql_error());
	
	}

	$newposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$newposts[] = $number;		
   	}
	
	if(count($newposts) < 30){
		
		return array($newposts, false);
		
	}else{
		
		return array($newposts, true);
		
	}
}

?>