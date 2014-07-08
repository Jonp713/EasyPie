<?php
include 'core/init.php';
include 'includes/overall/header.php';

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<h2>We've activated your account</h2>
<?php
} else if (isset($_GET['email'], $_GET['email_code']) === true) {

	$email 		= trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	
	echo($email);
	echo($email_code);
	
	if (email_exists($email) === false) {
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
		header('Location: activate.php?success');
		exit();
	}

} else {
	header('Location: index.php');
	exit();
}

include 'includes/overall/footer.php';
?>