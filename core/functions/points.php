<?php

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