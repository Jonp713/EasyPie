<?php
include 'core/init.php';
if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password';
	} else if (admin_exists($username) === false) {
		$errors[] = 'We can\'t find that username.';
	} else {
		
		if (strlen($password) > 32) {
			$errors[] = 'Password too long';
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
} else {
	$errors[] = 'No data received';
}
include 'includes/overall/header.php';
if (empty($errors) === false) {
?>
	<h2>We tried to log you in, but...</h2>
<?php
	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>