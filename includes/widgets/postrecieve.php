<?php

if (empty($_POST) === false) {
			
			
	if(!isset($_POST['is_image'])){
			
		$required_fields = array('post');
		foreach($_POST as $key=>$value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[] = 'A post cannot be blank';
				break 1;
			}
		}
	
	}
	
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
	
	if ((empty($_POST['email']) === false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)) {
		$errors[] = 'A valid email address is required';
	}
	
}

?>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true && (empty($errors) === false)) {
	
	echo('<span class="alert alert-success" role="alert"><span class = "glyphicon"></span>Your post has been submitted</span>');
}
		
if (empty($_POST) === false && empty($errors) === true) {

    $timestamp = date('g:i A \ \ D, M d, Y' , time());
				
	if(!empty($_GET['c'])){			
	
		$post_data = array(
			'post'	 		=> $_POST['post'],
			'site'			=> $community_in,
			'display_time'	=> $timestamp,
			'second'		=> time(),
			'service'		=> $_POST['service'],
			
		);
	
	}else{
		
		$post_data = array(
			'post'	 		=> $_POST['post'],
			'site'			=> $_POST['community'],
			'display_time'	=> $timestamp,
			'second'		=> time(),
			'service'		=> $_POST['service'],
				
		);
		
	}
	
	if($_POST['service'] == "Hole"){
				
		if($_POST['is_image'] == "checked"){
			
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
			
			$file_path = upload_image_post('hole', $file_temp, $file_extn);
			
			
			$post_data['img_src'] = $file_path; 
			
		}
		
	}
	
	if(isset($_POST['comments_on'])){
		if($_POST['comments_on'] == 'on'){
		
			$post_data['allow_comments'] = 1;
		
		}
		
	}
	
	
	if(logged_in() === true){
	
		if($_POST['reply_on'] == 'on'){
	
			$post_data['reply_on'] = 1;
		
		}
		
		$post_data['user_id'] = $session_user_id;
		
	}
	
	$success = submit_post($post_data);
			
	if($success){
		
		if(empty($errors) === true){
				
			if(!empty($_GET['c'])){			
				
				if(!empty($_GET['service'])){
					
					if($_GET['service'] == "Hole"){
						
						header('Location: hole.php?c='.$community_in.'&service='.$service_in.'&s');
						
					}else{
						header('Location: posts.php?c='.$community_in.'&service='.$service_in.'&s');
						
						
					}
					
				
				}else{
					
					header('Location: posts.php?c='.$community_in.'&s');
					
				}
		
			}else{
			
				header('Location: feed.php?s');
			
			}
			exit();
	
	
		}
	}else{
		
		//echo($success);
		
	}
	
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>