<?php

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

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo '<p>You\'ve been registered successfully!</p>';
} else {
	
	
	if (empty($_POST) === false && empty($errors) === true) {
		
		if(empty($_POST['email']) === false){
		
			$register_data = array(
				'username' 		=> $_POST['username'],
				'password' 		=> $_POST['password'],
				'active' 		=> 2,
				'allow_email' 	=> 1,
				'email' 		=> $_POST['email'],
				'email_code'	=> md5($_POST['username'] + microtime()),
			);
		
			register_user_with_email($register_data);
			$_SESSION['user_id'] = login($_POST['username'], $_POST['password']);
			header('Location: register.php?success');
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
			header('Location: explore.php?success=newbie');
			exit();
			
		}
		
	}
	
?>

<span class = "whitebg"></span>


<span class = "basic-forms col-xs-12">



<span class = "col-xs-12 col-sm-4 col-sm-offset-4 text-center">

<h1>SIGNUP</h1>
 Forgotten your <a href="recover.php?mode=username">username</a>?
<br><br>

</span>



<!--

<span class = "col-sm-2 col-sm-offset-5 col-xs-6 col-xs-offset-3">
	<br>
   
<img src = "images/logonotext.png" class="img-responsive">

<br>
</span>

-->

<span class = "col-xs-12 col-sm-4 col-sm-offset-4 text-center">
	
	<?php
	
	if (empty($errors) === false) {
	
			echo output_errors($errors);
	}
		
	?>


<form action = "" method = "POST" class="form-horizontal" role="form">
	
  <div class="form-group">
    <div class="col-sm-12">
      <input type="text" class="form-control" id="username" name = 'username' placeholder="Username">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-12">
      <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-12">
      <input type="password" class="form-control" id="password_again" name = "password_again" placeholder="Confirm Password">
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-12">
        <input type="email" class="form-control" id="email" name = "email" placeholder="Email (Optional)">
      </div>
    </div>
  

	<?php 
			
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'registration');		
			
	if(!$session_local && $count >= 1){
		
		echo("<br>Captcha:<br>");
		
  	 
	   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
	   echo recaptcha_get_html($publickey);
	   
	   echo('<br>');

	}

	?>
	
	<div class="form-group">
	    <div class="col-sm-12">
<button class="col-xs-12 btn btn-info btn-large">Go!</button>	    
</div>
	  </div>

</form>



</span>

<?php 
}

?>
