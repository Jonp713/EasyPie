<h1>Recover</h1>
<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<p>An email has been sent to that address</p>
<?php
} else {
	$mode_allowed = array('username');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
		if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
			if (email_exists($_POST['email']) === true) {
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success');
				exit();
			} else {
				echo '<p>An email has been sent to that address</p>';
			}
		}
	?>
		
		<form action="" method="post">
			Please enter your email address:<br>
			<input type="text" name="email">
			<input type="submit" value="Recover">
		</form>
		
	<?php
	} else {
		header('Location: index.php');
		exit();
	}
}
?>