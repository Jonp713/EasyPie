<?php

if (empty($_POST) === false) {
			
						
		/*$required_fields = array('post');
		foreach($_POST as $key=>$value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[] = 'A post cannot be blank';
				break 1;
			}
		}
	
		/}*/
	
		/*
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'submit_post');		
	
	if(!$session_local && $count >= 10){
    $privatekey = "6LcXHfYSAAAAANnTCLXRiag_cz0BijZII2_ysboN";
     $resp = recaptcha_check_answer ($privatekey,
                                   $_SERVER["REMOTE_ADDR"],
                                   $_POST["recaptcha_challenge_field"],
                                   $_POST["recaptcha_response_field"]);

     if (!$resp->is_valid) {
       // What happens when the CAPTCHA was entered incorrectly
	   	//$errors[] = $resp->error;
		$errors[] = 'Incorrect Captcha';
     }
 
 	}
		
		*/
	
	if ((empty($_POST['email']) === false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)) {
		$errors[] = 'A valid email address is required';
	}
	
}

?>

<?php
		
if (empty($_POST) === false && empty($errors) === true) {

    $timestamp = date('g:i A \ \ D, M d, Y' , time());
		
	$post = $_POST["post"];
				
	if(!empty($_GET['c'])){			
		
		$post_data = array(
			'site'			=> $community_in,
			'display_time'	=> $timestamp,
			'second'		=> time(),
			'service'		=> $_POST['service'],
			
		);
	
	}else{
		
		$post_data = array(
			'site'			=> $_POST['community'],
			'display_time'	=> $timestamp,
			'second'		=> time(),
			'service'		=> $_POST['service'],
				
		);
		
	}
	
	if(empty($_POST['title'])){
		
		$post_data['title'] = "";
	}else{
		$post_data['title'] = $_POST['title'];
		
	}
		
	
	if(isset($_POST['comments_on'])){
		if($_POST['comments_on'] == 'on'){
		
			$post_data['allow_comments'] = 1;
		
		}
		
	}
	if(isset($_POST['is_video'])){
		if($_POST['is_video'] == 'checked'){
		
			$post_data['isVideo'] = 1;
			$post_data['vurl'] = $_POST['vurl'];
			
		
		}
		
	}
	if(isset($_POST['is_website'])){
		if($_POST['is_website'] == 'checked'){
		
			$post_data['isWebsite'] = 1;
		
			$post_data['wurl'] = $_POST['wurl'];
			
		}
		
	}
	
	if(service_needs_approve($_POST['service']) == "strict_mod"){
		
		$post_data['needs_approve'] = 1;
		
		
	}
	if(service_needs_approve($_POST['service']) == "whatever_mod"){
	
		$post_data['needs_approve'] = 0;
	}
	
		
	$post_data['is_home'] = service_is_home($_POST['service'], $_GET['c']);
	
	
	if(isset($_POST['reply_on'])){
	
		if(logged_in() === true){
	
			if($_POST['reply_on'] == 'on'){
	
				$post_data['reply_on'] = 1;
		
			}
		
		
		}
	
	}
	
	$post_data['user_id'] = $session_user_id;
	
	
	if(isset($_POST['is_image']) && $_POST['is_image'] == "checked" || (is_meme($_POST['service']) == 1 && $_POST['meme_type'] == "upload")){
		
		$servicename = $_POST['service'];
		
		$post_data['isImage'] = 1;
		
		if (empty($_FILES['pic']['name']) == true) {
	
			$errors[] = 'Please choose a file!';
	
		}else{

			$allowed = array('jpg', 'jpeg', 'gif', 'png');
	
			$file_name = $_FILES['pic']['name'];
			$file_extn = strtolower(end(explode('.', $file_name)));
			$file_temp = $_FILES['pic']['tmp_name'];
	
			if (in_array($file_extn, $allowed) === true) {} else {
		
				$errors[] =  'Incorrect file type. Allowed: ' . implode(', ', $allowed);
		
			}
	
		}
		
		if(empty($errors)){
		
			$file_path = upload_image_post($servicename, $file_temp, $file_extn);
		
			$post_data['img_src'] = $file_path; 
		
		}
		
	}
	
	if(has_identity($_POST['service'])){
		
		$post_data['has_identity'] = 1;
		
	}
	
	if(is_meme($_POST['service']) == 1){
		
		$post_data['isMeme'] = 1;
		
		$post_data['top_line'] = $_POST['top_line'];
		
		$post_data['bottom_line'] = $_POST['bottom_line'];
	
		if($_POST['meme_type'] == "base"){
			
			$post_data['isImage'] = 1;
			
						
			$post_data['img_src'] = $_POST['meme_img_src']; 
			
		}
	
	
	
	}
	
	

	if(is_event($_POST['service'])){
		
		$post_data['is_event'] = 1;
			
		if(isset($_POST['free_food']) && $_POST['freefood_on'] == 'on'){
			
			$post_data['has_free_food'] = 1;
			
		}
		
		$real_hour = 0;
			
		if($_POST['apm'] == "am"){
			
			$real_hour = $_POST['hour'];
			
		}else{
			
			$real_hour = $_POST['hour'] + 12;
			
		}
		
		if(empty($_POST['year'])){
			
			$_POST['year'] = date("Y");
		}
		
		$time = $_POST['year'] . "-" . $_POST['month'] . "-". $_POST['day']  . " " . $real_hour . ":" . $_POST['minute'] . ":" . "00";
		
		$seconds = strtotime($time);
		
		$end_seconds = $seconds + $_POST['duration'];		
		
		$post_data['start_second'] = $seconds;
		$post_data['end_second'] = $end_seconds;
		
		$post_data['title'] = $_POST['title'];
		
		if(!empty($_POST['location'])){
		
			$post_data['location'] = $_POST['location'];
		
		}else{
			
			$post_data['location'] = "Somewhere";
			
		}
		
		if($_POST['recurring_type'] != "Not"){
						
			$post_data['recurring_type'] = $_POST['recurring_type'];
			
		
			if(empty($_POST['r_year'])){
			
				$_POST['r_year'] = date("Y");
			}
			
			$time = $_POST['r_year'] . "-" . $_POST['r_month'] . "-". $_POST['r_day'];
		
			$recurring_end_seconds = strtotime($time);
			
			$post_data['recurring_end'] = $recurring_end_seconds;
			
		}
	
	}
	
	
	
	$success = submit_post($post_data, $post);
	
	
	if($success){
		
		$service = $_POST['service'];
		$post = $_POST['post'];
	
		$session_user_id = sanitize($session_user_id);
	
		$post_id = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM posts WHERE service = '$service' AND user_id = '$session_user_id'"));
	
		create_mod_notification($_POST['service'], $_GET['c'], "new_post", "A new post awaits your moderation", $post_id['id']);
		
		if(empty($errors) === true){
				
			if(!empty($_GET['c'])){			
				
				if($_POST['service'] == "Hole"){
					
					header('Location: hole.php?c='.$community_in.'&service=Hole&success=post');
					
				}else{
					header('Location: posts.php?c='.$community_in.'&service='.$service_in.'&success=post');
					
					
				}
		
			}else{
			
				header('Location: feed.php?success=post');
			
			}
			exit();
	
	
		}else if (empty($errors) === false) {

			echo output_errors($errors);
		
		}
		

	
	}
	
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>