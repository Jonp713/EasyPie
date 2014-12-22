<?php
function submit_comment($comment_data){

	array_walk($comment_data, 'array_sanitize');
	
	$user_id = user_id_from_post_id($comment_data['post_id']);
	
	if($user_id != null && empty($user_id) == false){
		
		create_notification($user_id, 'comment', 'Someone commented on your post!', $comment_data['post_id']);
		
	}
	
	$fields = '`' . implode('`, `', array_keys($comment_data)) . '`';
	$data = '\'' . implode('\', \'', $comment_data) . '\'';
		
	return mysql_query("INSERT INTO `comments` ($fields) VALUES ($data)");
	
	
}

function comment_count($post_id){
		
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS totalcomments FROM comments WHERE post_id = '$post_id'"));
	
	return ($count['totalcomments']);
}


function get_comments($post_id){
		
	$result = mysql_query("SELECT * FROM comments WHERE post_id = '$post_id' AND status = 0 ORDER BY id DESC");
	
	$allcomments = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$allcomments[] = $number;		
   	}
	
	return $allcomments;
}



function display_comment($comment_id){
	$post_id = sanitize($comment_id);
	
	$totalspan = 0;
	
	$update = array();
	
	$num_args = func_num_args();
	$fields = func_get_args();
	array_walk($fields, 'array_sanitize');
	
	if ($num_args > 1) {
		unset($fields[0]);
	}
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM comments WHERE id = '$comment_id'"));
	
	echo('<span class = "col-xs-12 a-comment" id = "comment'.$comment_id.'">');
	
	//begin post row
	
	if(in_array('text', $fields)){
		
		echo('<span class = "atext col-xs-12 no-padding">');
	
		echo($data['text'] . '<br><br>');
	
		echo('</span>');
	}
	
	//end of post row
	
	
	echo('<span class = "comment-widgets">');
	
	if(in_array('username', $fields)){
		
		if($data['show_username'] == 1){
		
			if($data['user_id'] != null){
											
				$username = username_from_user_id($data['user_id']);
			
				echo('<span class = "">'.$username.'&nbsp;&nbsp;</span>');
			
			}
		
		}


	}
	
	/*
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
		
			echo('<span id = "point-count'.$data['id'].'" class = "point_count acount">&nbsp;'.$point_count.'&nbsp;</span>');
		

		}
		
		if(in_array('give_point', $fields)){
		
			if(check_given_points($data['id'], $_SESSION['user_id'])){
			
				echo('<span class = "icon-selected upvote glyphicon glyphicon-chevron-down"></span>');
		
		
			}else{
			
				echo(check_given_points($data['id'], $_SESSION['user_id']));
			
				echo('<span class = "hoverer-icon upvote glyphicon glyphicon-chevron-up" onclick="take_point('.$data['id'].', this)"></span>');	
						
			}
			
		}
		
	
	}
	*/
	echo('</span>');
	
		
	
	//functions
	//echo('<span class = "row comment-top">');
	
	//echo('<span class = "pull-right text-right">');
	
	
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
	
	//echo('</span>');
	
	
	
	
	//echo('<span style = "padding:0px;" class = "pull-right col-xs-8 text-right">');

	
	if(logged_in() == false){
	
		//echo("If you want to reply or save a post, you need to log in<br>");

	}else{
		
		
		if(in_array('flag', $fields)){

			echo('<span class = "hoverer flag" onclick="flag('.$data['id'].', this)">FLAG&nbsp;&nbsp;&nbsp;</span>');

		}

	}
	
	
	

	
	if(in_array('delete_post-user', $fields)){
	
		echo('<span class = "hoverer delete_post" onclick="delete_post('.$data['id'].', this)">DELETE&nbsp;&nbsp;&nbsp;</span>');
		
	}

	
	//end of right pull
	//echo('</span>');
	
	//echo('</span>');
	//END OF ROW ONE
		
	echo('</span>');
	
}


?>