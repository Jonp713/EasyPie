<?php


if (empty($_POST) === false && isset($_POST['register'])) {
	$required_fields = array('username', 'password', 'password_again', 'email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must fill out the required fields';
			break 1;
		}
	}
	
	if (empty($errors) === true) {
		if (preg_match("/\\s/", $_POST['code_first_name']) == true) {
			$errors[] = 'Your code first name must not contain any spaces.';
		}
		if (preg_match("/\\s/", $_POST['code_last_name']) == true) {
			$errors[] = 'Your code last name must not contain any spaces.';
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
		
	}
}

?>
<h1>Register Admin</h1>

<?php
if (isset($_GET['a']) === true && empty($_GET['a']) === true) {
	echo 'Admin Successfully Registered!';
} 
	
if (empty($_POST) === false && empty($errors) === true && isset($_POST['register'])) {
	
	$initials = substr($_POST['code_first_name'], 0, 1) . substr($_POST['code_last_name'], 0, 1);
	$initials = strtoupper($initials);
	
	$codename = $_POST['code_first_name'] . $_POST['code_last_name'];
	
	$register_data = array(
		'codename' 				=> $codename,
		'initials' 				=> $initials,
		'type' 					=> $_POST['type'],
		'community' 			=> $_POST['community'],
		'password' 				=> $_POST['password'],
		'email' 				=> $_POST['email']
		
	);

	register_admin($register_data);
	header('Location: creation.php?a');
	exit();
				
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>

	<form action="" method="post">
		<ul>
			
			<li>
				Favorite Animal*:<br>
				<input type="text" name="code_first_name">
			</li>
			<li>
				Favorite Word*:<br>
				<input type="text" name="code_last_name">
			</li>
			<li>
				Password*:<br>
				<input type="password" name="password">
			</li>
			<li>
				Confirm Password*:<br>
				<input type="password" name="password_again">
			</li>
			<li>
				Email*:<br>
				<input type="text" name="email">
			</li>
			<li>
				Type*:<br>
				<select name= "type">
					<option value = '0'>Moderator</option>
					<option value = '1'>Admin</option>
				</select>
			</li>
			<li>
				Community*:<br>
				<select name= "community">
				
				<?php


				$names = mysql_query("SELECT * FROM communities ORDER BY ID DESC") or die(mysql_error());

				while($number = mysql_fetch_assoc($names)){
	
						echo("<option value = '".$number['name']."'>".$number['name']."</option>");

					}
								
				?>
			</select>
			</li>
			<li>
				<input type="submit" name = "register" value="Register">
			</li>
		</ul>
	</form>