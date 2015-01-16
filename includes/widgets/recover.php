<h1>Recover Username</h1>
<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
?>
	<p>An email has been sent to that address</p>
<?php
} else {
	$mode_allowed = array('username');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
		if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
			if (email_exists($_POST['email']) === true) {
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?s');
				exit();
			} else {
				echo '<p>An email has been sent to that address</p>';
			}
		}
	?>
		
		<form class = "form-horizontal" action="" method="post">
			<div class = "form-group">
				<label for = "email">Email address:</label>
				<input id = "email" class = "form-control" type="text" name="email">
			</div>
				
	 	   	<button type="submit" class="btn btn-default">Recover</button>
		</form>
		
	<?php
	} else {
		header('Location: index.php');
		exit();
	}
}
?>