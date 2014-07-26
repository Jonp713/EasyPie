<?php

if (empty($_POST) === false) {
			
	$required_fields = array('post');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'A post cannot be blank';
			break 1;
		}
	}
	
	if(!$session_local){
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
<h1>Submit Post</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'Your post has been submitted';
	
}
		
if (empty($_POST) === false && empty($errors) === true) {

    $timestamp = date('g:i A \ \ D, M d, Y' , time());
				
	$post_data = array(
		'post'	 		=> $_POST['post'],
		'site'			=> $community_in,
		'display_time'	=> $timestamp,
		'second'		=> time()
	);
	
	if(logged_in() === true){
	
		if($_POST['reply_on'] == 'on'){
	
			$post_data['reply_on'] = 1;
		
		}	
		
		$post_data['user_id'] = $session_user_id;
		
	}else if(empty($_POST['email']) === false){
		
		$post_data['email'] = $_POST['email'];
		$post_data['reply_on'] = 1;
		
	}
	$success = submit_post($post_data);
	
	if($success){
		
		header('Location: posts.php?c='.$community_in.'&s');
		exit();
	
	}else{
		
		echo($success);
		
	}
	
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>

	<form action="" method="post">
		<ul>
			
			<li>
				Post:<br>
				<input type="text" name="post">
			</li>
		
			<?php if(logged_in() === true){ ?>
			<li>
				Allow Private Reply:<br>
				<input type="checkbox" name="reply_on" checked = 'checked'>
			</li>
			
			<?php }else{?>
				
				<li>
					You must be logged in to get replies
				</li>
				
			<li>
			<?php 
			}
			
			
			$count = get_request_count($_SERVER['REMOTE_ADDR'], 'submit_post');		
				
			if(!$session_local && $count >= 5){
	  	 
			   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
			   echo recaptcha_get_html($publickey);
   
			}

			?>
			</li>			
			<li>
				<input type="submit" value="Post">
			</li>
		</ul>
	</form>
