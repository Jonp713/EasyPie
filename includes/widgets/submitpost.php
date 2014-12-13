<?php

if (empty($_POST) === false) {
			
	$required_fields = array('post');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'A post cannot be blank';
			break 1;
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
					
					header('Location: posts.php?c='.$community_in.'&service='.$service_in.'&s');
				
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



<?php

if(isset($_GET['service'])){

$desc = get_service_description_from_service_name($_GET['service']);	

echo('<span class = "col-xs-12 service-desc">'.$desc.'<br></span>');

}else{
	
	$desc = get_service_description_from_service_name('ICU');	
	
	echo('<span class = "col-xs-12 service-desc">'.$desc.'<br></span>');
	
}


?>


<!-- Button trigger modal -->
<button class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModal">SUBMIT POST</button>

	
