<?php
	
if (isset($_GET['email'], $_GET['email_code']) === true) {

	$email 		= trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	
	if (email_ready($email) === false) {
		$errors[] = 'Oops, something went wrong, and we couldn\'t find that email address!';
	} else if (activate($email, $email_code) === false) {
		$errors[] = 'We had problems activating your account';
	}
	
	if (empty($errors) === false) {
	?>
		<h2>Oops...</h2>
	<?php
		echo output_errors($errors);
	} else {
		header('Location: activate.php?success=confirmed_email');
		exit();
	}

} else {
	header('Location: index.php');
	exit();
}


?>