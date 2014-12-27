<?php


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
	
	echo('<span class = "col-xs-12 no-padding" id = "post'.$post_id.'">');
	echo('<span class = "col-xs-12 anypost '.$data['service'].'-post">');
	
	//functions
	echo('<span class = "posttop col-xs-12 no-padding">');
	
	//defining size of post-top
	if(in_array('image_corner', $fields)){
		
		if($data['isImage'] == 1){
			
			echo('<span style = "padding:0px;" class = "pull-left text-left col-xs-12 col-sm-11">');
			
			
		}else{	
		
			echo('<span style = "padding:0px;" class = "pull-left text-left col-xs-12">');
		
		}
	
	}else{
		
		echo('<span style = "padding:0px;" class = "pull-left text-left col-xs-12 col-sm-4">');
	
	}	
	
	
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
	
	if(in_array('title', $fields)){
		echo('<span class = "atitle">'.$data['title'].'</span>&nbsp;&nbsp;&nbsp;');

	
	}
	
	
	if(in_array('site', $fields)){
		
		echo('<span class = "postsite communityonpost">');
		
		$color = get_community_color_from_community_name($data['site']);
				
		echo('<a style = "color:'.$color.';" href = "posts.php?c='.$data['site'].'">'.$data['site'].'</a>');
				
		echo('</span>');
		
	}
	
	if(in_array('service', $fields)){
		
		echo('<span class = "postservice serviceonpost">');
		
		$color = get_service_color_from_service_name($data['service']);
				
		echo('<a style = "color:'.$color.';" href = "posts.php?c='.$data['site'].'&service='.$data['service'].'">'.$data['service'].'</a>&nbsp;&nbsp;&nbsp;');
				
		echo('</span>');
		
		
	}

	
	echo('</span>');
	
	if($data['service'] == "Events"){
		
		if(in_array('image_corner', $fields)){
		
			if($data['isImage'] == 1){
		
				echo('<img class = "pull-right col-sm-1 hidden-xs no-padding" src = "'.$data['img_src'].'">');
				
			}

		}
		
	}
	
	
	
	if($data['service'] == "Events"){
		
		echo('<span style = "padding:0px;" class = "pull-left text-left col-xs-12 col-sm-11">');
		

				
		if(in_array('start_time', $fields)){
			
			$time = $data['start_second'];
			
			if($data['time_status'] == 1){
				
				echo("<span style = 'color:".get_service_color_from_service_name($data['service'])."' class = 'message-icon glyphicon glyphicon-bell'></span> <span class = 'hopnow'>Happening Now!</span>");
				
			}else{
		
				echo("<script>	var time = moment.unix(".$time.");"); 
				echo("document.write(time.from(moment()));</script>");
		
			}
			echo('&nbsp;&nbsp;|&nbsp;&nbsp;');
			
		}
		if(in_array('change_start_time', $fields)){
			
			if($data['time_status'] == 1){
				
				echo("<span style = 'color:".get_service_color_from_service_name($data['service'])."' class = 'message-icon glyphicon glyphicon-bell'></span> <span class = 'hopnow'>Happening Now!</span>");
			
			
			}else{
			
				$time = $data['start_second'];		
		
				echo('<span class = "changeme">'.$time.'</span>');
					
			}
			
			echo('&nbsp;&nbsp;|&nbsp;&nbsp;');
			
		
		}
		
		if(in_array('location', $fields)){
			
			
			echo($data['location']);
			echo('&nbsp;&nbsp;|&nbsp;&nbsp;');
			
		
			
		}
		
		if(in_array('start_time_full', $fields)){
			
			$time = $data['start_second'];		
						
			echo($today = date("D, M, n g:ia") . '&nbsp;&nbsp;|&nbsp;&nbsp;');
		
		}
		
		if(in_array('free_food', $fields)){
		
			if($data['has_free_food'] == 1){
				
				echo('<span class = "message-icon glyphicon glyphicon-cutlery"></span> <span class = "free-food">Free Food!</span>&nbsp;&nbsp;|&nbsp;&nbsp;');
			}
		
		}
	
		
		if(in_array('duration', $fields)){
			
			if($data['time_status'] == 1){
				
				echo("<script>	
				var endtime = moment.unix(".$data['end_second']."); 
				
				document.write('Ends ' + endtime.from(moment()));
				</script>
				");
			
			}else{
				
				$time = $data['end_second'] - $data['start_second'];
		
				echo("<script>	
		
					document.write(moment.duration(".$time.", 'seconds').humanize() + ' long'); // a minute
		
				</script>
				");
			
			}
					
			
		}
		if(in_array('change_duration', $fields)){
			
			if($data['time_status'] == 1){
				
				echo('<span class = "changeme3">'.$data['end_second'].'</span>');
				
			
			}else{
				
				$time = $data['end_second'] - $data['start_second'];
				
				echo('<span class = "changeme2">'.$time.'</span>');
	
			
			}
		
		
		}
	
		
		
		

		
		echo('</span>');
			

	}
	
	

	
	echo('</span>');
	//END OF ROW ONE
	
	//begin post row
	echo('<span class = "col-xs-12 no-padding apost">');
	
	if(in_array('post', $fields)){
		
		if($data['service'] == "Hole"){
			
			if($data['isImage'] == 1){
			
				echo('<span data-toggle="tooltip" title="Click to unblur"  data-placement="top" class = "hole-post-overlay-image col-xs-12 no-padding">');
			
			}else{
				
				echo('<span class = "col-xs-12 no-padding hole-post-overlay-text">');
				
			}
			
		}
		
		if($data['service'] == "Events"){
	
			echo('<span class = "posttext events">');

				echo($data['post'] . '<br>');

			echo('</span>');

		}else{

			echo('<span class = "posttext normal">');

				echo($data['post'] . '<br>');

			echo('</span>');

		}	


		if(in_array('image', $fields)){
		
			echo('<img class = "img-responsive" src = "'.$data['img_src'].'">');

		}
		
		if($data['service'] == "Hole"){
	
			echo('</span>');

		}
			
	
		
	}
	
	
	echo('</span>');
	//end of post row
	
	
	//begin bottom row
	echo('<span class = "bottomrow col-xs-12 no-padding">');
	
	//wierd extras
	echo('<span style = "padding:0px;" class = "pull-left col-xs-4 text-left">');
		
		
	echo('</span>');
	//end eiwerd extras
	
	//widgetsandbuttons
	echo('<span style = "padding:0px;" class = "pull-right col-xs-8 text-right">');

	if(in_array('comment_on', $fields)){
		
		if($data['service'] == "Hole"){
			
		echo('<a href = "hole.php?c='.$data['site'].'&service='.$data['service'].'&comment='.$data['id'].'#post'.$data['id'].'" class = "hoverer-icon comment glyphicon glyphicon-comment"></a>');
		
		}else{
	
			if($data['allow_comments'] == 1){
						
				echo('<span onclick = "show_comments('.$post_id.', this)" class = "hoverer-icon comment glyphicon glyphicon-comment"></span>');
				
			}
		
		}

	}
	if(in_array('comment_count', $fields)){
		
		if($data['allow_comments'] == 1 || $data['service'] == "Hole"){
		
			$comment_count = comment_count($data['id']);

			echo('<span class = "comment_count acount">&nbsp;'.$comment_count.'</span>&nbsp;&nbsp;&nbsp;');
		
		}

	}
	
	
	
	
	
	if(logged_in() == true){
	
		if(in_array('give_point', $fields)){
						
			if(check_given_points($data['id'], $_SESSION['user_id'])){
				
				echo('<span class = "icon-selected upvote glyphicon glyphicon-chevron-up"></span>');
			
			
			}else{
				
				echo(check_given_points($data['id'], $_SESSION['user_id']));
				
				echo('<span class = "hoverer-icon upvote glyphicon glyphicon-chevron-up" onclick="give_point('.$data['id'].', this)"></span>');			
			}
			

		}
	
		if(in_array('point_count', $fields)){
			
			$point_count = count_post_points($post_id);
			
			echo('<span id = "point-count'.$data['id'].'" class = "point_count acount">&nbsp;'.$point_count.'</span>');
			

		}
		
	}


	
		if(logged_in() == false){
		
			//echo("If you want to reply or save a post, you need to log in<br>");

		}else{
			
			if(in_array('reply', $fields) && $data['reply_on'] == 1){
								
				echo('&nbsp;&nbsp;&nbsp;<span class = "hoverer reply reply'.$post_id.'" id = "'.$data['id'].'" onclick = "start_reply(this,'.$data['id'].')">REPLY</span>');
			
			}
			
			if(in_array('save_post', $fields)){
				
				if(check_saved($post_id, $_SESSION["user_id"])){
		
					echo('<span class = "selected save_post" onclick="unsave_post('.$data['id'].', this, 2)">&nbsp;&nbsp;&nbsp;SAVE</span>');
				
				}else{
					
					echo('<span class = "hoverer save_post" onclick="save_post('.$data['id'].', this)">&nbsp;&nbsp;&nbsp;SAVE</span>');
					
				}
				
			}
			
			if(in_array('flag', $fields)){

				echo('<span class = "hoverer flag" onclick="flag('.$data['id'].', this)">&nbsp;&nbsp;&nbsp;FLAG</span>');
	
			}
	
		}
	
	
	

	if(in_array('unsave_post', $fields)){
	
		echo('<span class = "hoverer unsave_post" onclick="unsave_post('.$data['id'].', this, 1)">&nbsp;&nbsp;&nbsp;REMOVE</span>');
		
	}
	
	if(in_array('reply_toggle', $fields)){
		
		if($data['reply_on'] == 1){
	
			echo('<span class = "hoverer remove_reply'.$data['id'].'" onclick="set_reply('.$data['id'].', 0, this)">&nbsp;&nbsp;&nbsp;DISABLE-REPLY</span>');
	
		}
		if($data['reply_on'] == 0){
	
			echo('<span class = "hoverer add_reply'.$data['id'].'" onclick="set_reply('.$data['id'].', 1, this)">&nbsp;&nbsp;&nbsp;ENABLE-REPLY</span>');
	
		}
		
	}
	
	if(in_array('comment_toggle', $fields)){
		
		if($data['allow_comments'] == 1){
	
			echo('<span class = "hoverer remove_comments'.$data['id'].'" onclick="set_comments('.$data['id'].', 0, this)">&nbsp;&nbsp;&nbsp;DISABLE-COMMENTS</span>');
	
		}
		if($data['allow_comments'] == 0){
	
			echo('<span class = "hoverer add_comments'.$data['id'].'" onclick="set_comments('.$data['id'].', 1, this)">&nbsp;&nbsp;&nbsp;ALLOW-COMMENTS</span>');
	
		}
		
	}
	
	if(in_array('delete_post-user', $fields)){
	
		echo('<span class = "hoverer delete_post" onclick="delete_post('.$data['id'].', this)">&nbsp;&nbsp;&nbsp;DELETE</span>');
		
	}
	
	if(in_array('share_post', $fields)){
		//$link = md5($data['id']);
		
		$link = $data['id'];
				
		echo('<span class = "share">');
		echo('&nbsp;&nbsp;&nbsp;<a href = "posts.php?c='.$data['site'].'&service='.$data['service'].'&share='.$link.'">SHARE</a>');
		echo('</span>');
		
		
		//echo('<span class = "share" onclick="share_post('.$data['id'].')">SHARE</span>');
		
	}
	
	echo('</span>');
	//end of right pull widgetns n buttons
	
	echo('</span>');
	//end of bottom row
	
	
	if(empty($_GET['share']) == false && in_array('reply_share', $fields) && $data['reply_on'] == 1 && logged_in() == true){

		echo('<hr class = "replysharehr"><span class = "replyshare pull-left">REPLY</span><span class = "form-group col-xs-12" id = "replygroup'.$data['id'].'"><textarea placeholder = "Send a message..." class = "form-control col-xs-2" id = "reply_submit'.$data['id'].'" ></textarea><span data-dismiss="modal" class = "replysendbutton pull-right btn-info btn" onclick="reply_post('.$data['id'].')">SEND</span></span>');

	}
	
	
	if(empty($_GET['share']) == false && in_array('comment_share', $fields) && $data['allow_comments'] == 1 && logged_in() == true){
		
		echo('<br><span class = "replyshare pull-left">COMMENT</span><hr class = "replysharehr"><div class = "col-xs-12" id = "actual-comments"><textarea rows = "2" placeholder = "Write a comment..." class = "form-control" name ="comment" id = "commenttoget'.$data['id'].'"></textarea><button class = "btn btn-info pull-right comment_submit" onclick = "submit_comment(' .$data['id']. ', this, 2)">COMMENT</button><br><br><span id = "comments'.$data['id'].'">');
		
		$comments = get_comments($data['id']);
	
		foreach ($comments as $currentcomment) {
	
			display_comment($currentcomment['id'], 'text', 'username');
	
		}
		
		echo('</span></div>');
	}
	
	echo('</span>');
	echo('</span>');
	
	if(empty($_GET['share']) == false && in_array('comment_share', $fields)){
		
		echo('<span class = "col-xs-12 no-padding post-add-on anypost-bottom" id = "post'.$data['id'].'-bottom-share"></span>');
		
	}else{
		
		echo('<span class = "col-xs-12 no-padding post-add-on anypost-bottom" id = "post'.$data['id'].'-bottom"></span>');
		
		
	}
	
}





function display_hole_post($post_id){
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
	
	echo('<span style = "padding:0px;" class = "pull-left text-left col-xs-12 col-sm-12">');
	
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
	
	echo('<span style = "padding:0px;" class = "pull-left col-xs-12 text-left">');
	
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
	
	
	if(in_array('comment_on', $fields)){

		echo('<span class = "hoverer-icon comment glyphicon glyphicon-comment" onclick="open_comments('.$data['id'].', this)"></span>');

	}
	if(in_array('comment_count', $fields)){
		
		$comment_count = comment_count($data['id']);

		echo('<span class = "comment_count acount">&nbsp;'.$comment_count.'</span>&nbsp;&nbsp;&nbsp;');

	}

	
	if(logged_in() == true){
	
		if(in_array('give_point', $fields)){
						
			if(check_given_points($data['id'], $_SESSION['user_id'])){
				
				echo('<span class = "icon-selected upvote glyphicon glyphicon-chevron-up"></span>');
			
			
			}else{
				
				echo(check_given_points($data['id'], $_SESSION['user_id']));
				
				echo('<span class = "hoverer-icon upvote glyphicon glyphicon-chevron-up" onclick="give_point('.$data['id'].', this)"></span>');			
			}
			

		}
	
		if(in_array('point_count', $fields)){
			
			$point_count = count_post_points($post_id);
			
			echo('<span id = "point-count'.$data['id'].'" class = "point_count acount">&nbsp;'.$point_count.'</span>');
			

		}
		
	}

	
	//end of right pull
	echo('</span>');
	
	echo('</span>');
	//END OF ROW ONE
	
	//begin post row
	echo('<span class = "row">');
	
	if(in_array('post', $fields)){
		
		if($data['post'] != ""){
		
			echo('<span style = "padding:0px;" class = "apost col-xs-12">');
	
			echo($data['post'] . '<br>');
	
			echo('</span>');
		}
	
	}
	
	
	if(in_array('image', $fields)){
		if($data['isImage'] == 1){
			
			echo('<img class = "img-responsive no-padding col-xs-12" src = "'.$data['img_src'].'">');
			
		}
		
		
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
