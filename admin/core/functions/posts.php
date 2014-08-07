<?php

//need to santizie every variable for all of these functions
function judgement($post_id, $judgement, $admin_id){
	$post_id = sanitize($post_id);
	$judgement = sanitize($judgement);
	$admin_id = sanitize($admin_id);
	
	if(check_admin_power($admin_id) > 0){
		
		$success = mysql_query("UPDATE `posts` SET `status` = '$judgement', `judged_by` = '$admin_id' WHERE `id` = '$post_id'") or die(mysql_error());
		
	}else{

		$result = mysql_fetch_assoc(mysql_query("SELECT community FROM cementsalesmen WHERE id = '$admin_id' LIMIT 1"));
	
		$admin_site = $result['community'];
		
		$success = mysql_query("UPDATE `posts` SET `status` = '$judgement', `judged_by` = '$admin_id' WHERE `id` = '$post_id' AND `site` = '$admin_site'") or die(mysql_error());	
	
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


?>