<?php

function count_replies($post_id, $type){
	$post_id = sanitize($post_id);	
	
	//direct
	if($type == 0){
	
		$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM messages WHERE post_id = '$post_id' AND from_post = 1"));
	
	}
	if($type == 1){
	
		$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM messages WHERE post_id = '$post_id' AND from_post = 0"));
	
	}
	
	return ($count['total']);
}

function count_saved($post_id){
	
	$post_id = sanitize($post_id);	
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS total FROM saved_posts WHERE post_id = '$post_id'"));
	
	return ($count['total']);
		
}

function random_post($community_name){
	
	$community_name = sanitize($community_name);	
	
	$id = mysql_fetch_assoc(mysql_query("SELECT id FROM posts WHERE site = '$community_name' AND status = 1 ORDER BY RAND() LIMIT 1"));
	
	return $id['id'];
}

function submit_post($post_data){

	array_walk($post_data, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($post_data)) . '`';
	$data = '\'' . implode('\', \'', $post_data) . '\'';
	
	save_suspicious_request('submit_post');
	
	return mysql_query("INSERT INTO `posts` ($fields) VALUES ($data)");
	
	
}


function get_user_posts($status, $user_id){
	
	$status = sanitize($status);
	$user_id = sanitize($user_id);
	
	$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND user_id = '$user_id' ORDER BY ID DESC");
	
	$all_posts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_posts[] = $number;		
   	}
	
	return $all_posts;
}


function save_post($user_id, $post_id){
	
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$user_for_not = user_id_from_post_id($post_id);
	
	create_notification($user_for_not, "saved_post", "Someone saved your post!", $post_id);
	
	$time = time();
	
	$success = mysql_query("INSERT INTO saved_posts (user_id, post_id, second) VALUES ('$user_id', '$post_id', '$time')");
	

	return $success;
}

function unsave_post($user_id, $post_id){
	
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("DELETE FROM `saved_posts` WHERE `user_id` = '$user_id' AND `post_id` = '$post_id'");
	
	return $success;
}

function delete_post($user_id, $post_id){
	
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("DELETE FROM `posts` WHERE `user_id` = '$user_id' AND `id` = '$post_id'");
	
	return $success;
}

function post_text_from_post_id($post_id){
	$post_id = sanitize($post_id);
	
		
	return mysql_result(mysql_query("SELECT `post` FROM `posts` WHERE `id` = '$post_id'"), 0, 'post');
	
}


function get_user_saved_posts($user_id){
	
	$user_id = sanitize($user_id);
	
	$result_saved = mysql_query("SELECT * FROM saved_posts WHERE user_id = '$user_id'");
	
	$all_ids = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_ids[] = $number['post_id'];		
		
   	}
	
	if(count($all_ids) < 1){
		
		return array();
	}
	
	$all_ids = implode(",",$all_ids);
		
	$result_posts = mysql_query("SELECT * FROM posts WHERE id IN ($all_ids)");
	
	$all_posts = array();
		
    while($number = mysql_fetch_assoc($result_posts)) { 
		$all_posts[] = $number;	
   	}
	
	return $all_posts;

}



function get_user_feed($user_id, $start){
	
	$user_id = sanitize($user_id);
	$start = sanitize($start);
	
	$result_saved = mysql_query("SELECT * FROM subscriptions WHERE user_id = '$user_id'");
	
	$all_names = array();
	
    while($number = mysql_fetch_assoc($result_saved)) { 
		
		$all_names[] = $number['community_name'];		
		
   	}
	
	if(count($all_names) < 1){
		
		return array();
	}
		
	$all_names2 = "'" . implode("','", $all_names) . "'";
		
	$result_posts = mysql_query("SELECT * FROM posts WHERE site IN ($all_names2) AND status = 1 ORDER BY id DESC LIMIT $start,30");
		
	$all_posts = array();
		
    while($number = mysql_fetch_assoc($result_posts)) { 
		$all_posts[] = $number;	
   	}
	
	if(count($all_posts) < 30){
		
		return array($all_posts, false);
		
	}else{
		
		return array($all_posts, true);
		
	}
	

}

function get_more_approved_posts($start, $site, $service){
	
	$start = sanitize($start);
	$site = sanitize($site);
	
	if($service = 'all'){
		
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND site = '$site' ORDER BY ID DESC LIMIT $start,30");
		
	}else{
	
		$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND site = '$site' AND service = '$service' ORDER BY ID DESC LIMIT $start,30");
		
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

function get_posts($status, $site, $type, $admin_id, $service){
	
	$admin_id = sanitize($admin_id);
	$status = sanitize($status);
	$site = sanitize($site);
	$service = sanitize($service);
	
	if($service != 'all'){
		//shit with services
		
		if($type == -1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND service = '$service' ORDER BY ID DESC LIMIT 0, 30");
		
		}
		
		if($type == 0){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' AND service = '$service' ORDER BY ID DESC");
		
		}
	
		if($service == 'hole'){
	
			$result = mysql_query("SELECT post FROM posts WHERE status = 2 AND site = '$site' ORDER BY ID DESC LIMIT 30");
	
		}
		
	}else{
		
		//old shit?
	
		if($type == -2){
		
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND judged_by = '$admin_id' ORDER BY ID DESC LIMIT 0, 30");
		
		}
	
		if($type == -1){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC LIMIT 0, 30");
		
		}
	
		if($type == 0){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");
		
		}
	
		if($type == 1){
	
			$result = mysql_query("SELECT post FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC LIMIT 30");
	
		}
	
		if($type == 2){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = '$status' AND judged_by = '$admin_id' ORDER BY ID DESC");
		
		}
		if($type == 3){
	
			$result = mysql_query("SELECT post FROM posts WHERE status = '$status' AND site = '$site' ORDER BY ID DESC");		
		
		}
		if($type == 4){
	
			$result = mysql_query("SELECT * FROM posts WHERE status = 1 AND flagged = 1 AND judged_by = '$admin_id' ORDER BY ID DESC");
		
		}
	
	}
	
	$allposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allposts[] = $number;		
   	}
	
	if($type == 1){
	
		return $allposts;
	}
	
	if(count($allposts) < 30){
		
		return array($allposts, false);
		
	}else{
		
		return array($allposts, true);
		
	}
}

function reply_post($user_id, $post_id, $message){
	
	$message = sanitize($message);
	$post_id = sanitize($post_id);
	$user_id = sanitize($user_id);
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$post_id' LIMIT 1"));
	
    $second = time();
		
	$reciever = $result['user_id'];
		
	$post = $result['post'];
	
	$post = sanitize($post);
	
	save_suspicious_request('reply_post');
	
	$success = mysql_query("INSERT INTO messages (recieve_id, send_id, message, prev_message, second, post_id, from_post) VALUES ('$reciever', '$user_id', '$message', '$post', '$second', '$post_id', 1)");
	
	$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM messages WHERE recieve_id = '$reciever'"));
	
	create_notification($reciever, 'reply_post', 'You have a new message!', $post_id);
	
	return $success;
	
}

function set_reply($post_id, $status_in, $user_id){
	
	$post_id = sanitize($post_id);
	$status_in = sanitize($status_in);
	$user_id = sanitize($user_id);
	
	$success = mysql_query("UPDATE `posts` SET `reply_on` = '$status_in' WHERE `id` = '$post_id' and `user_id` = '$user_id'");	
	
	return $success;	
	
}

function flag($post_id){
	
	$post_id = sanitize($post_id);
	
	$success = mysql_query("UPDATE `posts` SET flagged = 1 WHERE id = '$post_id'");
	
	return $success;
}

function clear_old_posts($community){
	$community = sanitize($community);
	
	$results = mysql_query("SELECT * FROM `posts` WHERE status = 2 AND expired = 0 AND site = '$community'");
    
	while($number = mysql_fetch_assoc($results)) { 
		
		if(empty($number['second_judged']) == false){
		
			if(time() > ($number['second_judged'] + 86400)){
		
				$all_ids[] = $number['id'];		
		
			}
		
		}
   	}
	
	if(!isset($all_ids)){
		
		return false;
	}
	
	$all_ids = "'" . implode("','",$all_ids) . "'";
			
	$result_communities = mysql_query("UPDATE `posts` SET expired = 1 WHERE id IN ($all_ids)");
	
	return true;
	
}


function display_post_admin($post_id){
	$post_id = sanitize($post_id);
	
	$update = array();
	
	$num_args = func_num_args();
	$fields = func_get_args();
	array_walk($fields, 'array_sanitize');
	
	if ($num_args > 1) {
		unset($fields[0]);
	}
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$post_id'"));
	
	echo('<span class = "row" id = "post'.$post_id.'">');
	echo('<span class = "well well-sm col-xs-10 col-sm-6" col-md-6>');
	
	
	if(in_array('post', $fields)){
	
		echo($data['post'] . '<br>');
	
	}
	if(in_array('display_time', $fields)){
	
	
		echo($data['display_time'] . '<br>');
	
	}
	
	if(in_array('site', $fields)){
		
		echo($data['site'] . '<br>');
		
	}
	
	if(in_array('saved_count', $fields)){
	
		$savedcount = count_saved($data['id'], 1);
	
		echo("Times Saved: " . $savedcount . "<br>");
	
	}
	
	if(isset($data['user_id'])){
		
		if(in_array('username', $fields)){

			$current_post_user_data = user_data($data['user_id'], 'username');
	
			echo("Submitted by:<i> " . $current_post_user_data['username'] . "</i><br>");
		
		}
	
		if($data['reply_on'] == 1){
			
			if(in_array('direct_replies', $fields)){
			
				$directreplies = count_replies($data['id'], 0);
				
				echo("Direct Replies: " . $directreplies . "<br>");
			
			}
			
			if(in_array('sustained_replies', $fields)){
				
				$sustainedreplies = count_replies($data['id'], 1);
			
				echo("Sustained Replies: " . $sustainedreplies . "<br>");
			
			}
			
		}
		
		if(in_array('admin_reply', $fields)){
	
			echo('<span class = "'.$data['id'].'reply"><input type = "text" class = "reply">&nbsp;<span onclick="admin_reply('.$data['id'].', 1)"><span class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span> Admin Reply</span></span><br></span>');
		
		}
		
		if(in_array('points_awarded', $fields)){
			
			$points = get_points(2, $data['id'], null);
			
			if(isset($points['amount'])){
			
				echo('Points Awarded: '. $points['amount'] . '<br>');

			}
	
		}
		
		if(in_array('give_points', $fields)){
		
		echo('<span class = "'.$data['id'].'points"><input type = "text" class = "points">&nbsp;<span onclick="give_points('.$data['id'].',\''.$data['site'].'\')"><span class="btn btn-default btn-xs"><span class="glyphicon glyphicon-certificate"></span> Dish Points</span></span><br></span>');
		
		}
	
	
	}
	
	if(in_array('approve', $fields)){
	
		echo('<span class = "'.$data['id'].'approve"><span onclick="judgement('.$data['id'].', 1)"><span class="btn btn-default btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Approve</span></span><br></span>');
	
	}
	if(in_array('deny', $fields)){
	
		echo('<span class = "'.$data['id'].'deny"><span onclick="judgement('.$data['id'].', 2)"><span class="btn btn-default btn-xs"><span class="glyphicon glyphicon-thumbs-down"></span> Deny</span></span><br></span>');
	
	}
	if(in_array('delete', $fields)){
	
		echo('<span class = "'.$data['id'].'delete"><span onclick="judgement('.$data['id'].', 3)"><span class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span> Delete</span></span><br></span>');
		
	}
	
	
	if(in_array('save_post', $fields) || in_array('reply_post', $fields)){
	
	
		if(logged_in() == false){
		
			echo("If you want to reply or save a post, you need to log in<br>");

		}else{
		
			if(in_array('save_post', $fields)){
		
				echo('<span class = "save_post" onclick="save_post('.$data['id'].')">Save Post<br></span>');
				
			}
		
			if(in_array('reply', $fields) && $data['reply_on'] == 1){
			
				echo('<span id = "'.$data['id'].'"><input type = "text" id = "reply">&nbsp;<span onclick="reply_post('.$data['id'].')">Reply</span><br></span>');
			
	
			}
		}
	

	}

	if(in_array('flag', $fields)){

		echo('<span class = "flag" onclick="flag('.$data['id'].')">Flag Post</span><br>');
	
	}
	
	if(in_array('unsave_post', $fields)){
	
		echo('<span class = "unsave_post" onclick="unsave_post('.$data['id'].')">Unsave Post<br></span>');
		
	}
	
	if(in_array('reply_toggle', $fields)){
		
		if($data['reply_on'] == 1){
	
			echo('<span onclick="set_reply('.$data['id'].', 0)">Remove Reply<br></span>');
	
		}
		if($data['reply_on'] == 0){
	
			echo('<span onclick="set_reply('.$data['id'].', 1)">Add Reply<br></span>');
	
		}
		
	}
	
	if(in_array('delete_post-user', $fields)){
	
		echo('<span onclick="delete_post('.$data['id'].')">Delete Post<br></span>');
		
	}
	
	echo('</span>');
	echo('</span>');
	
	
}


function display_post($post_id){
	$post_id = sanitize($post_id);
	
	$totalspan = 0;
	
	$update = array();
	
	$num_args = func_num_args();
	$fields = func_get_args();
	array_walk($fields, 'array_sanitize');
	
	if ($num_args > 1) {
		unset($fields[0]);
	}
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$post_id'"));
	
	echo('<span class = "row" id = "post'.$post_id.'">');
	echo('<span class = "col-xs-12">');
	
	//functions
	echo('<span class = "row posttop">');
	
	echo('<span style = "padding:0px;" class = "pull-left text-left col-xs-12 col-sm-4">');
	
	if(in_array('display_time', $fields)){
		
		$time = $data['second'];
		
		echo("<script>	var time = moment.unix(".$time.");"); 
		echo("document.write(time.from(moment()));</script>");
		
		echo('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
	}
	
	if(in_array('change_time', $fields)){
			
		$time = $data['second'];
		
		echo('<span class = "changeme">'.$time.'</span>');
		
		echo('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		
	}
	
	if(in_array('site', $fields)){
		
		echo('<span class = "postsite communityonpost">');
		
		$color = get_community_color_from_community_name($data['site']);
				
		echo('<a style = "color:'.$color.';" href = "posts.php?c='.$data['site'].'">'.$data['site'].'</a>');
				
		echo('</span>');
		
	}
	echo('</span>');
	
	echo('<span style = "padding:0px;" class = "pull-right col-xs-8 text-right">');

	if(in_array('save_post', $fields) || in_array('reply_post', $fields)){
	
		if(logged_in() == false){
		
			//echo("If you want to reply or save a post, you need to log in<br>");

		}else{
			
			if(in_array('reply', $fields) && $data['reply_on'] == 1){
								
				echo('<span data-toggle="tooltip" title="Your username will not appear
"  data-placement="bottom" class = "hoverer reply reply'.$post_id.'" id = "'.$data['id'].'" onclick = "start_reply(this,'.$data['id'].')">REPLY&nbsp;&nbsp;&nbsp;</span>');
			
			}
			
			if(in_array('save_post', $fields)){
		
				echo('<span class = "hoverer save_post" onclick="save_post('.$data['id'].', this)">SAVE&nbsp;&nbsp;&nbsp;</span>');
				
			}
			
			if(in_array('flag', $fields)){

				echo('<span class = "hoverer flag" onclick="flag('.$data['id'].', this)">FLAG&nbsp;&nbsp;&nbsp;</span>');
	
			}
	
		}
	
	}

	if(in_array('unsave_post', $fields)){
	
		echo('<span class = "hoverer unsave_post" onclick="unsave_post('.$data['id'].', this)">REMOVE&nbsp;&nbsp;&nbsp;</span>');
		
	}
	
	if(in_array('reply_toggle', $fields)){
		
		if($data['reply_on'] == 1){
	
			echo('<span class = "hoverer remove_reply'.$data['id'].'" onclick="set_reply('.$data['id'].', 0, this)">DISABLE-REPLY&nbsp;&nbsp;&nbsp;</span>');
	
		}
		if($data['reply_on'] == 0){
	
			echo('<span class = "hoverer add_reply'.$data['id'].'" onclick="set_reply('.$data['id'].', 1, this)">ENABLE-REPLY&nbsp;&nbsp;&nbsp;</span>');
	
		}
		
	}
	
	if(in_array('delete_post-user', $fields)){
	
		echo('<span class = "hoverer delete_post" onclick="delete_post('.$data['id'].', this)">DELETE&nbsp;&nbsp;&nbsp;</span>');
		
	}
	
	if(in_array('share_post', $fields)){
		//$link = md5($data['id']);
		
		$link = $data['id'];
				
		echo('<span class = "share">');
		echo('<a href = "posts.php?c='.$data['site'].'&share='.$link.'">SHARE</a>');
		echo('</span>');
		
		
		//echo('<span class = "share" onclick="share_post('.$data['id'].')">SHARE</span>');
		
	}
	
	//end of right pull
	echo('</span>');
	
	echo('</span>');
	//END OF ROW ONE
	
	//begin post row
	echo('<span class = "row">');
	
	if(in_array('post', $fields)){
		
		echo('<span style = "padding:0px;" class = "apost col-xs-12">');
	
		echo($data['post'] . '<br>');
	
		echo('</span>');
	}
	
	echo('</span>');
	//end of post row
	
	
	if(empty($_GET['share']) == false && in_array('reply_share', $fields) && $data['reply_on'] == 1 && logged_in() == true){

		echo('<br><span class = "replyshare pull-left">REPLY</span><hr class = "replysharehr"><span class = "form-group col-xs-12" id = "replygroup'.$data['id'].'"><textarea class = "form-control col-xs-2" id = "reply_submit'.$data['id'].'" placeholder = "ICU2..."></textarea><span data-dismiss="modal" class = "col-xs-2 replysendbutton pull-right btn-info btn-sm" onclick="reply_post('.$data['id'].')">SEND</span></span>');

	}
	
	echo('</span>');
	echo('</span>');
	
}

function search_posts($keyword){
	$keyword = sanitize($keyword);
	
	$result = mysql_query("SELECT * FROM posts WHERE post LIKE '%$keyword%' AND status = 1 ORDER BY ID DESC");
	
	$foundposts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$foundposts[] = $number;		
   	}
	
	return $foundposts;
}



?>

