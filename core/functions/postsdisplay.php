<?php

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

?>
