<?php
include 'core/init.php';
if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password';
	} else if (admin_exists($username) === false) {
		$errors[] = 'That username/password combination is incorrect';
	} else {
		
		if (strlen($password) > 32) {
			$errors[] = 'Password too long';
		}
		
		$count = get_request_count($_SERVER['REMOTE_ADDR'], 'admin_login');

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
		
		$login = admin_login($username, $password);
		if ($login === false) {
			$errors[] = 'That username/password combination is incorrect';
		} else {
			$_SESSION['admin_id'] = $login;
			header('Location: index.php');
			exit();
		}
	}
}else {
	$errors[] = 'No data received';
}
include 'includes/overall/header.php';
if (empty($errors) === false) {
?>
	<h2>We tried to log you in, but...</h2>
<?php
	echo output_errors($errors);
}

?>

<form action="" method="post">
	<ul>
	<li>
	
	Username:
	<input type="text" name="username">
	
	</li>
	<li>

	Password:
	<input type="password" name="password">
	
	</li>
	<li>
	<?php 
			
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'admin_login');		
				
	if(!$session_local && $count >= 1){
	  	 
	   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
	   echo recaptcha_get_html($publickey);
   
	  			
	}

	?>
		 
	</li>
	<li>
	<input type="submit" value="Log in">
	</li>
</form>

<?php
include 'includes/overall/footer.php';
?>