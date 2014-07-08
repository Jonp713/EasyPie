<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if (empty($_POST) === false) {
	
	if (user_exists_outside($_POST['username'], $session_user_id) === true) {
		$errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken';
	}
	if (preg_match("/\\s/", $_POST['username']) == true) {
		$errors[] = 'Your username must not contain any spaces.';
	}	
	
	if ((empty($errors) === true) && (empty($_POST['email']) === false)){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A valid email address is required';
		}else if (email_exists_outside($_POST['email'], $session_user_id) === true && $user_data['email'] !== $_POST['email']) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}
	}
}

?>
<h1>My information</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'Your details have been updated';
} else {
	if (empty($_POST) === false && empty($errors) === true) {
		
		if(empty($_POST['email']) === false){
		
			$update_data = array(
				'username' 		=> $_POST['username'],
				'allow_email'	=> ($_POST['allow_email'] == 'on') ? 1 : 0
			);
			
			update_user($session_user_id, $update_data);
			
			if(($_POST['email']) != $user_data['email']){
				
				$update_data = array(
					'active' => 2
				);
				update_user($session_user_id, $update_data);
							
				register_email_only($_POST['email'], $session_user_id);
				
			}
		
		}else{
		
			$update_data = array(
				'username' 	=> $_POST['username'],
			);
			update_user($session_user_id, $update_data);
	
		
		}
		
		header('Location: information.php?s');
		exit();
		
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
	?>

	<form action="" method="post">
		<ul>
			<li>
				Username:<br>
				<input type="text" name="username" value="<?php echo $user_data['username']; ?>">
			</li>
			
			<li>
				Password:<br>
				<a href="changepassword.php">Change Password</a>
				
			</li>
			<?php if ($user_data['active'] <= 2){ ?>
			
				<li>
					Email:<br>
					<a href="confirmemail.php">Confirm an email</a>
				</li>

			<?php   }else{ ?>
			
			
				<li>
					Email:<br>
					<input type="text" name="email" value="<?php echo $user_data['email']; ?>">
				</li>
				<li>
					<input type="checkbox" name="allow_email" <?php if ($user_data['allow_email'] == 1) { echo 'checked="checked"'; } ?>>Recieve Emails
				</li>
			
			<?php   } ?>
			
			<li>
				<input type="submit" value="Update">
			</li>
		</ul>
	</form>

<?php
}
include 'includes/overall/footer.php';
?>