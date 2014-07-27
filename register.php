<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';


if (empty($_POST) === false) {
	$required_fields = array('username', 'password', 'password_again');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must fill out the required fields';
			break 1;
		}
	}
	
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'registration');
	
	if(!$session_local and $count >= 1){
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
	
	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
			$errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken';
		}
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = 'Your username must not contain any spaces.';
		}
		if (strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters';
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = 'Your passwords do not match';
		}
		if ((empty($_POST['email']) === false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)) {
			$errors[] = 'A valid email address is required';
		}
		if ((empty($_POST['email']) === false) && (email_exists($_POST['email']) === true)) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}
	}
}

?>
<h1>Register</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'You\'ve been registered successfully!';
} else {
	
	
	if (empty($_POST) === false && empty($errors) === true) {
		
		if(empty($_POST['email']) === false){
		
			$register_data = array(
				'username' 		=> $_POST['username'],
				'password' 		=> $_POST['password'],
				'active' 		=> 2,
				'allow_email' 	=> 1,
				'email' 		=> $_POST['email'],
				'email_code'	=> md5($_POST['username'] + microtime())
			);
		
			register_user_with_email($register_data);
			$_SESSION['user_id'] = login($_POST['username'], $_POST['password']);
			header('Location: register.php?s');
			exit();
			
		}else{
			$register_data = array(
				'username' 		=> $_POST['username'],
				'password' 		=> $_POST['password'],
				'active' 		=> 1,
				'allow_email' 	=> 0,
				'email_code'	=> md5($_POST['username'] + microtime())
			);
	
			register_user($register_data);
			$_SESSION['user_id'] = login($_POST['username'], $_POST['password']);
			header('Location: register.php?s');
			exit();
			
		}
		
	}else if (empty($errors) === false) {
	
		echo output_errors($errors);
	}
	
?>

	<form action="" method="post">
		<ul>
			
			<li>
				Username*:<br>
				<input type="text" name="username">
			</li>
			<li>
				Password*:<br>
				<input type="password" name="password">
			</li>
			<li>
				Confirm Password*:<br>
				<input type="password" name="password_again">
			</li>
			<li>
				Email (Optional):<br>
				<input type="text" name="email">
			</li>
			<li>
<?php 
				
$count = get_request_count($_SERVER['REMOTE_ADDR'], 'registration');		
				
if(!$session_local && $count >= 1){
	  	 
   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
   echo recaptcha_get_html($publickey);
   
	  			
}

?>
		 
	  </li>
			<li>
				<input type="submit" value="Register">
			</li>
		</ul>
	</form>

<?php 
}
include 'includes/overall/footer.php'; ?>