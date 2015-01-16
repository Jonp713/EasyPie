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

function change_service($post_id, $service, $admin_id){

	if(check_admin_power($admin_id) > 0){
		
		$success = mysql_query("UPDATE `posts` SET `service` = '$service', `judged_by` = '$admin_id', `second_judged` = '$time' WHERE `id` = '$post_id'") or die(mysql_error());
		
	}else{

		$result = mysql_fetch_assoc(mysql_query("SELECT community FROM cementsalesmen WHERE id = '$admin_id' LIMIT 1"));
	
		$admin_site = $result['community'];
		
		$success = mysql_query("UPDATE `posts` SET `service` = '$service', `judged_by` = '$admin_id', `second_judged` = '$time' WHERE `id` = '$post_id' AND `site` = '$admin_site'") or die(mysql_error());	
	
	}


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
	
	echo('<strong style = "color:'.get_service_color_from_service_name($data['service']).'">'.$data['service'] . '</strong><br>');
	
	
	if(!empty($data['title'])){

		echo('<strong>'.$data['title'] . '</strong><br>');
	}
	
	
	if(in_array('post', $fields)){
		

		echo('<span class = "col-xs-12 no-padding">');

			echo($data['post'] . '<br>');

		echo('</span>');

		if(in_array('image', $fields)){
			
			if($data['isMeme'] == 1){
			
				echo('<span class = "memewrapper col-xs-12 no-padding">');
			
				echo('<span class = "meme top">'.$data['top_line'].'</span>');
		
				echo('<img class = "img-responsive no-padding meme-image" src = "../'.$data['img_src'].'">');
						
				echo('<span class = "meme bottom">'.$data['bottom_line'].'</span>');

				echo('</span>');
			
			}else{
				if($data['isImage'] == 1){

					echo('<img class = "slight-circle img-responsive no-padding col-xs-8 col-sm-4" src = "../'.$data['img_src'].'">');
				}
			
			}
		}
		
		if($data['isVideo'] == 1){

				echo('<iframe class = "post_video" src="//www.youtube.com/embed/'.$data['vurl'].'" frameborder="0" allowfullscreen></iframe>');
		}
	
	
		if($data['isWebsite'] == 1){
		
			echo('<a href ="'.$data['wurl'].'">'.$data['wurl'].'</a>');

		}
				
	}
	
	if($data['is_event'] == 1){

		echo('On '. date("F j, Y, g:i a", $data['start_second']).  '<br>');
	}
	
	if($data['is_event'] == 1){

		if($data['recurring_type'] != "Not" && !empty($data['recurring_type'])){
			
			echo($data['recurring_type'] . " recurring ending on: ".  date("F j, Y, g:i a", $data['recurring_end']) . "<br>");
			
		}
	}
	
	
	
	
	if(in_array('display_time', $fields)){
	
	
		echo('<br>Submitted on: '. $data['display_time'] . '<br>');
	
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
	
			echo("Submitted by:<i> " . $current_post_user_data['username'] . "</i><br><br>");
		
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
		
		
		echo('<span class = "form-inline">');
		
		if(in_array('admin_reply', $fields)){
	
			echo('<span class = "'.$data['id'].'reply"><input type = "text" class = "reply form-control">&nbsp;<span onclick="admin_reply('.$data['id'].', 1)"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-share-alt"></span> Admin Reply</span></span><br></span>');
		
		}
		
		if(in_array('points_awarded', $fields)){
			
			$points = get_points(2, $data['id'], null);
			
			if(isset($points['amount'])){
			
				echo('Points Awarded: '. $points['amount'] . '<br>');

			}
	
		}
		
		
		if(in_array('give_points', $fields)){
		
		echo('<span class = "'.$data['id'].'points"><input type = "text" class = "form-control points">&nbsp;<span onclick="give_points('.$data['id'].',\''.$data['site'].'\')"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-certificate"></span> Dish Points</span></span><br></span>');
		
		}
	
	
	}
	
	if(in_array('service', $fields)){
		
		echo('<span class = "post'.$data['id'].'service">');
		
			echo('<select id = "post'.$data['id'].'-service-form" value = '.$data['site'].' class = "form-control col-xs-8" name = "service">');
		
		$services = get_services($data['site'], 0);

		foreach ($services as $currentservice){
			
			if($currentservice['name'] == $data['service']){
				
				echo('<option value = "' . $currentservice['name'] . '" selected>'. $currentservice['name']  .'</option>');
				
			}else{
				
				echo('<option value = "' . $currentservice['name'] . '">'. $currentservice['name']  .'</option>');
				
			}
			
			
			
		}
		echo('</select>');
		
	
		echo('<span onclick="change_service('.$data['id'].')"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-wrench"></span> Change Service</span></span><br><br>');	
		
		echo('</span>');

		
	}
	
	
	if(in_array('approve', $fields)){
	
		echo('<span class = "'.$data['id'].'approve"><span onclick="judgement('.$data['id'].', 1)"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-thumbs-up"></span> Approve</span></span><br></span>');
	
	}
	if(in_array('deny', $fields)){
	
		echo('<span class = "'.$data['id'].'deny"><span onclick="judgement('.$data['id'].', 2)"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-thumbs-down"></span> Deny</span></span><br></span>');
	
	}
	if(in_array('delete', $fields)){
	
		echo('<span class = "'.$data['id'].'delete"><span onclick="judgement('.$data['id'].', 3)"><span class="btn btn-default btn-md"><span class="glyphicon glyphicon-remove-sign"></span> Delete</span></span><br></span>');
		
	}
	
	echo('</span>');
	
	
	
	echo('</span>');
	echo('</span>');
	
	
}
?>