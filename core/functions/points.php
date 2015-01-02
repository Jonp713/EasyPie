<?php
function give_point_comment($comment_id, $from_user_id){
	
	$comment_id = sanitize($comment_id);
	$from_user_id = sanitize($from_user_id);	
	
	$second = time();
	
	$community_name = community_name_from_comment_id($comment_id);
		
	$user_id = user_id_from_comment_id($comment_id);
	
	if(check_given_points($comment_id, $from_user_id) == false){
	
		mysql_query("INSERT INTO `points` (comment_id, user_id, amount, from_user_id, seconds, community_name) VALUES ('$comment_id', '$user_id', 1, '$from_user_id', '$second', '$community_name')");

		$user_id = user_id_from_comment_id($comment_id);
	
		create_notification($user_id, "give_points", "Someone one upvoted your comment and gave you 1 point", $comment_id);
		
		$upvotes = mysql_query("SELECT upvotes FROM comments WHERE comment_id = '$comment_id'");		
		
		$upvotes = $upvotes + 1;
		
		mysql_query("UPDATE comments SET upvotes = '$upvotes' WHERE id = '$comment_id'");	
		
	}else{
		
		return false;
	}
}

function take_point_comment($comment_id, $from_user_id){
	
	$comment_id = sanitize($comment_id);
	$from_user_id = sanitize($from_user_id);	
	
	$second = time();
	
	$community_name = community_name_from_comment_id($comment_id);
		
	$user_id = user_id_from_comment_id($comment_id);
	
	if(check_given_points($comment_id, $from_user_id) == false){
	
		mysql_query("INSERT INTO `points` (comment_id, user_id, amount, from_user_id, seconds, community_name) VALUES ('$comment_id', '$user_id', -1, '$from_user_id', '$second', '$community_name')");

		$user_id = user_id_from_comment_id($comment_id);
	
		create_notification($user_id, "give_points", "Someone one downvoted your comment and you lost 1 point", $comment_id);
		
		$upvotes = mysql_query("SELECT upvotes FROM comments WHERE comment_id = '$comment_id'");		
		
		$upvotes = $upvotes + 1;
		
		mysql_query("UPDATE comments SET upvotes = '$upvotes' WHERE id = '$comment_id'");	
		
	}else{
		
		return false;
	}
}


function give_point($post_id, $from_user_id){
	
	$post_id = sanitize($post_id);
	$from_user_id = sanitize($from_user_id);	
	
	$second = time();
	
	$community_name = community_name_from_post_id($post_id);
		
	$user_id = user_id_from_post_id($post_id);
	
	if(check_given_points($post_id, $from_user_id) == false){
	
		mysql_query("INSERT INTO `points` (post_id, user_id, amount, from_user_id, seconds, community_name) VALUES ('$post_id', '$user_id', 1, '$from_user_id', '$second', '$community_name')");

		$user_id = user_id_from_post_id($post_id);
	
		create_notification($user_id, "give_points", "Someone one upvoted your post and gave you 1 point", $post_id);
		
		mysql_query("UPDATE posts SET upvotes = upvotes + 1 WHERE id = '$post_id'");	
		
		if(service_name_from_post_id($post_id) == "Hole" || status_from_post_id($post_id) == 2){
			
			if(upvotes_from_post_id($post_id) > 20){
				
				mysql_query("UPDATE posts SET service = 'Pile' WHERE id = '$post_id'");	
				mysql_query("UPDATE posts SET status = 0 WHERE id = '$post_id'");	
				mysql_query("UPDATE posts SET is_home = 1 WHERE id = '$post_id'");	
				
				create_mod_notification('Pile', null, "new_post", "A new post awaits your moderation", $post_id);
				
			}
				
		}
		
		
	}else{
		
		return false;
		
	}
}

function count_post_points($post_id){
	
	$post_id = sanitize($post_id);

	$result = mysql_query("SELECT * FROM points WHERE post_id = '$post_id' ORDER BY ID DESC");
	
	$count = 0;
	
    while($number = mysql_fetch_assoc($result)) { 
	
		$count = $number['amount'] + $count;
	
	}
	
	return $count;
	
}

function check_given_points($post_id, $from_user_id){
	
		$post_id = sanitize($post_id);
		
		$from_user_id = sanitize($from_user_id);
				
		return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `points` WHERE `from_user_id` = $from_user_id AND `post_id` = $post_id"), 0) >= 1) ? true : false;

}


function get_points($type, $variable, $variable2){
	
	$type = sanitize($type);
	$variable = sanitize($variable);
	$variable2 = sanitize($variable2);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM points WHERE admin_id = '$variable' ORDER BY ID DESC");
		
	}
	if($type == 1){
	
		$result = mysql_query("SELECT * FROM points WHERE user_id = '$variable' ORDER BY ID DESC");
		
	}
	if($type == 2){
	
		$result = mysql_query("SELECT * FROM points WHERE post_id = '$variable' ORDER BY ID DESC");
		
	}
	if($type == 3){
	
		$result = mysql_query("SELECT * FROM points WHERE community_name = '$variable' ORDER BY ID DESC");
		
	}
	if($type == 4){
	
		$result = mysql_query("SELECT * FROM points WHERE user_id = '$variable' AND community_name = '$variable2' ORDER BY ID DESC");
		
	}
	
	if($type == 2){
		
		return mysql_fetch_assoc($result);
		
		
	}else{
		
		$allposts = array();
	
	    while($number = mysql_fetch_assoc($result)) { 
			$allposts[] = $number;		
	   	}
	
		return $allposts;
		
	}


}

function count_user_posts($user_id, $community_name){
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
		
	$result = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM posts WHERE user_id = '$user_id' AND site = '$community_name' ORDER BY ID DESC"));
		
	return $result;
	
}


function count_user_points($user_id, $type, $community_name){
	
	$user_id = sanitize($user_id);
	$community_name = sanitize($community_name);
	
	
	$count = 0;
	
	if($type == 0){
	
		$result = mysql_query("SELECT amount FROM points WHERE user_id = '$user_id' ORDER BY ID DESC");
	
	}
	
	if($type == 1){
	
		$result = mysql_query("SELECT amount FROM points WHERE user_id = '$user_id' AND community_name = '$community_name' ORDER BY ID DESC");
	
	}
	
	
    while($number = mysql_fetch_assoc($result)) { 
	
		$count = $number['amount'] + $count;
	
	}
	
	return $count;
}

function highest_points($community_name, $place){
	
	$community_name = sanitize($community_name);
	$place = sanitize($place);
	
	
	$userswpoints = array();
	
	$users = mysql_query("SELECT user_id FROM subscriptions WHERE community_name = '$community_name' ORDER BY ID DESC");
	
    while($currentuser = mysql_fetch_assoc($users)) { 
	
		$count = count_user_points($currentuser['user_id'], 1, $community_name);
		
		$new = array(
			'totalpoints' 	=> $count,
			'id'		=> $currentuser['user_id']
		);	
	
		array_push($userswpoints, $new);
	}
	
	$highest = 0;
	$index = 0;
	$alreadyindexed = array();
	$high_scores = array();
	
	for($j=0; $j<$place; $j++){
		for ($i=0; $i< count($userswpoints); $i++){
			
			$continue = true;
			for ($t=0; $t< count($alreadyindexed); $t++){
				
				if($userswpoints[$i]['id'] == $alreadyindexed[$t]){
										
					$continue = false;
					
				}
				
			}
		
			if($userswpoints[$i]['totalpoints'] > $highest && $continue === true){
								
				$highest = $userswpoints[$i]['totalpoints'];
				$index = $i;
							
			}
						
		} 
		array_push($high_scores, $userswpoints[$index]);
		array_push($alreadyindexed, $userswpoints[$index]['id']);
		$highest = 0;
		
				
	}
		
	return $high_scores;
	
	
	
}



?>