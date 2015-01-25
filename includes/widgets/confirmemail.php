<?php

if (empty($_POST) === false) {
	$required_fields = array('email', 'password');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must type in an email and your password';
			break 1;
		}
	}
	
	if (check_hash($user_data['password'], $_POST['password'])){

	} else {
		$errors[] = 'Your current password is incorrect';
	}
	
	if (empty($errors) === true) {
		if ((empty($_POST['email']) === false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)) {
			$errors[] = 'A valid email address is required';
		}
		if ((empty($_POST['email']) === false) && (email_exists_outside($_POST['email'], $user_data['user_id']) === true)) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}
	}
}

?>
<h1>Confirm Email</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'Awesome, an email will be there shortly. Check your email and click the link to finish the process';
} else {
	
	if (empty($_POST) === false && empty($errors) === true) {
				
		register_email_only($_POST['email'], $session_user_id);
		header('Location: confirmemail.php?s');
		exit();
					
	}else if (empty($errors) === false) {
	
		echo output_errors($errors);
	}
	
?>

<form class ="form-horizontal" action="" method="post">
	<div class = "form-group col-xs-12">
		<label for = "email">Email:</label>
		<input class = "form-control" id = "email" type="text" name="email">
	</div>
	<div class = "form-group col-xs-12">
		<label for = "password">Password:</label>
		<input id = "password" class = "form-control" type="password" name="password">
	</div>
	<div class = "form-group col-xs-12">
	  <button type="submit" class="btn btn-info">Confirm Email</button>
	</div>
</form>

<?php

}

?>