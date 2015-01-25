<?php
if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password';
	} else if (user_exists($username) === false) {
		$errors[] = 'That username/password combination is incorrect';
	} else {
		
		$count = get_request_count($_SERVER['REMOTE_ADDR'], 'login');
	
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
		
		$login = login($username, $password);
		
		if($login){
			
			if(empty($errors) === true){
			
				$_SESSION['user_id'] = $login;

$home = get_home_from_username($username);

				if(!empty($home)){

					header('Location: posts.php?c='. $home);

				}else{

					header('Location: feed.php');

				}
				exit();
			
			}
			
		}else {
			
			$errors[] = 'That username/password combination is incorrect';
			
		}
	}
	
	
} else {

	
}

?>
<span class = "whitebg"></span>


<span class = "basic-forms col-xs-12">

<span class = "col-xs-12 col-sm-4 col-sm-offset-4 text-center">

<h1>LOGIN</h1>

 
 Forgotten your <a href="recover.php?mode=username">username</a>?
<br><br>
</span>



<!--

<span class = "row">


<span class = "col-sm-2 col-sm-offset-5 col-xs-6 col-xs-offset-3">

<img src = "images/logonotext.png" class="img-responsive" alt="Responsive image">
</span>


</span>

-->

<span class = "row">

<span class = "col-xs-12 col-sm-4 col-sm-offset-4 text-center">
	
	<?php

	if (empty($errors) === false) {

		echo output_errors($errors);
	
	}
	?>


<form action = "" method = "POST" class="form-horizontal" role="form">
  <div class="form-group">
    <div class="col-xs-12">
      <input type="text" class="form-control" id="username" name = 'username' placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-12">
      <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
    </div>
  </div>

	<?php 
			
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'login');		
			
	if(!$session_local && $count >= 10){
		
		echo("<br>Captcha:<br>");
		
  	 
	   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
	   echo recaptcha_get_html($publickey);


	echo("<br>");

  			
	}

	?>
	
	
		<div class="form-group">
		    <div class="col-xs-12">
	<button type = 'submit' class="col-xs-12 btn btn-info btn-large">Go!</button>	    
	</div>
	</div>

	</form>

	</span>

	</span>
	
</span>
