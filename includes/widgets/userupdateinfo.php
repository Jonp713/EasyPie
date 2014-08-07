<?php

if (empty($_POST) === false) {
	
	if (user_exists_outside($_POST['username'], $session_user_id) === true) {
		$errors[] = '<p class = "form_error">Sorry, the username \'' . $_POST['username'] . '\' is already taken</p>';
	}
	if (preg_match("/\\s/", $_POST['username']) == true) {
		$errors[] = '<p class = "form_error">Your username must not contain any spaces.</p>';
	}	
	
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'user_update');

	if(!$session_local and $count >= 1){
    $privatekey = "6LcXHfYSAAAAANnTCLXRiag_cz0BijZII2_ysboN";
     $resp = recaptcha_check_answer ($privatekey,
                                   $_SERVER["REMOTE_ADDR"],
                                   $_POST["recaptcha_challenge_field"],
                                   $_POST["recaptcha_response_field"]);

     if (!$resp->is_valid) {
       // What happens when the CAPTCHA was entered incorrectly
	   	//$errors[] = $resp->error;
		$errors[] = '<p class = "form_error">Incorrect Captcha</p>';
     }
 
 	}
	
	if ((empty($errors) === true) && (empty($_POST['email']) === false)){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = '<p class = "form_error">A valid email address is required</p>';
		}else if (email_exists_outside($_POST['email'], $session_user_id) === true && $user_data['email'] !== $_POST['email']) {
			$errors[] = '<p class = "form_error">Sorry, the email \'' . $_POST['email'] . '\' is already in use</p>';
		}
	}
}

?>
<h1>My information</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo '<p class = "form_success">Your details have been updated</p>';
} else {
	if (empty($_POST) === false && empty($errors) === true) {
		
		if(empty($_POST['email']) === false){
		
			$update_data = array(
				'username' 		=> $_POST['username'],
				'allow_email'	=> ($_POST['allow_email'] == 'on') ? 1 : 0
			);
			
			update_user($session_user_id, $update_data);
			
			if(($_POST['email']) != $user_data['email']){
				
				$update_data = array(
					'active' => 2
				);
				update_user($session_user_id, $update_data);
							
				register_email_only($_POST['email'], $session_user_id);
				
			}
		
		}else{
		
			$update_data = array(
				'username' 	=> $_POST['username'],
			);
			update_user($session_user_id, $update_data);
	
		
		}
		
		header('Location: information.php?s');
		exit();
		
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
	?>

	<form class = "update_user_info" action="" method="post">
				Username:<br>
				<input type="text" name="username" value="<?php echo $user_data['username']; ?>">

				Password:<br>
				<a href="changepassword.php">Change Password</a>
				
			<?php if ($user_data['active'] <= 2){ ?>
			
					Email:<br>
					<a href="confirmemail.php">Confirm an email</a>

			<?php   }else{ ?>
			

					Email:<br>
					<input type="text" name="email" value="<?php echo $user_data['email']; ?>">

					<input type="checkbox" name="allow_email" <?php if ($user_data['allow_email'] == 1) { echo 'checked="checked"'; } ?>>Recieve Emails
	<?php 
	}
			
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'user_update');		
				
	if(!$session_local && $count >= 1){
	  	 
	   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
	   echo recaptcha_get_html($publickey);
	  			
	}

	?>

	<input type="submit" value="Update">

	</form>

<?php
}
?>
