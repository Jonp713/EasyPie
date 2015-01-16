<?php

if (empty($_POST) === false) {
	$required_fields = array('current_password', 'password', 'password_again');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}

	if (check_hash($user_data['password'], $_POST['current_password'])){
		if (trim($_POST['password']) !== trim($_POST['password_again'])) {
			$errors[] = 'Your new passwords do not match';
		} else if (strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters';
		}
	} else {
		$errors[] = 'Your current password is incorrect';
	}
}

?>
<h1>Change Password</h1>

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo 'Your password has been changed.';
} else {
	
	if (isset($_GET['force']) === true && empty($_GET['force']) === true) {
	?>
		<p>You must change your password.</p>
	<?php
	}
	
	if (empty($_POST) === false && empty($errors) === true) {
		change_password($session_user_id, $_POST['password']);
		header('Location: changepassword.php?success=change_password');
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
	?>

	<form class = "form-horizontal"  role = "form" action="" method="post">
		<div class = "form-group">
			<label for = "current">Current Password:</label>
			<input class = "form-control" id = "current" type="password" name="current_password">
		</div>
		<div class = "form-group">
			<label for = "password1">New Password:</label>
			<input class = "form-control" id = "password" type="password" name="password">
		</div>
		<div class = "form-group">
			<label for = "password2">Confirm Password:</label>
				<input class = "form-control" id = "password2" type="password" name="password_again">
		</div>

	  <button type="submit" class="btn btn-default">Change</button>
		
	</form>
<?php

}

?>
