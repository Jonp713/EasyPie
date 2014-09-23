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
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
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
		
		header('Location: information.php?success');
		exit();
		
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
	?>

	<form class = "form-horizontal update_user_info" role = "form" action="" method="post">
  	  <div class="form-group">
  	    <label for="username">Username:</label>
			<input id = "username" class = "form-control" type="text" name="username" value="<?php echo $user_data['username']; ?>">
  	  </div>
  	  <div class="form-group">
  	    <label for="password">Password:</label>
				<a class = "form-control" id = "password" href="changepassword.php">Change Password</a>
  	  </div>
	  
	  <!-- 
							
		<?php //if ($user_data['active'] <= 2){ ?>
			
	    	  <div class="form-group">
	    	    <label for="confirmemail">Email:</label>
					<a id = "confirmemail "class = "form-control" href="confirmemail.php">Confirm an email</a>
	    	  </div>
	
		<?php   //}else{ ?>
			
			
    	  <div class="form-group">
    	    <label for="emailvalue">Email:</label>
			<input id = "emailvalue" class = "form-control" type="text" name="email" value="<?php //echo $user_data['email']; ?>" disabled>
    	  </div>		
		
	  	  <div class="form-group">
	  	    <label for="recieveemail">Recieve Emails:</label>
			<input id = "recieveemail" class = "form-control" type="checkbox" name="allow_email" <?php //if ($user_data['allow_email'] == 1) { echo 'checked="checked"'; } ?>>
	  	  </div>

	    	  <div class="form-group">
	    	    <label for="confirmemail">Change Email:</label>
					<a id = "confirmemail "class = "form-control" href="confirmemail.php">Confirm a different email</a>
	    	  </div>
		
		
  	  <div class="form-group">
		  
	 -->
		
	<?php 
	//}
	
			
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'user_update');		
				
	if(!$session_local && $count >= 1){
	  	 
		echo('<div class="form-group">');
		
		echo("<br><strong>Captcha:</strong><br>");
		
		 
	   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
	   echo recaptcha_get_html($publickey);
	   
	   echo('<br>');
	   
	   echo('</div>');
	  			
	}
	

	?>

	  <button type="submit" class="btn btn-default">Update</button>

	</form>

<?php
}
?>
