<?php

//moderator_protect_page();

?>

<?php

if (empty($_POST) === false && isset($_POST['register'])) {
	$required_fields = array('code_first_name', 'code_last_name', 'password', 'password_again', 'email');
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
<h1>Register Admin/Moderator</h1>

<?php
if (isset($_GET['a']) === true && empty($_GET['a']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Successfully Registered</strong></div>');
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


<form action="" method="post" class="form-horizontal" role="form">
	  <div class="form-group">
	    <label for="code_first_name" class="col-xs-2 control-label">Favorite Animal</label>
	    <div class="col-xs-6">
	      <input type="text" class="form-control" id="code_first_name" name="code_first_name">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="code_last_name" class="col-xs-2 control-label">Favorite Weapon</label>
	    <div class="col-xs-6">
	      <input type="text" class="form-control" id="code_last_name" name="code_last_name">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="password" class="col-xs-2 control-label">Password</label>
	    <div class="col-xs-6">
	      <input type="password" class="form-control" id="password" name="password">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="password_again" class="col-xs-2 control-label">Confirm Password</label>
	    <div class="col-xs-6">
	      <input type="password" class="form-control" id="password_again" name="password_again">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="email" class="col-xs-2 control-label">Email</label>
	    <div class="col-xs-6">
	      <input type="text" name="email" class="form-control" id="email">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="type" class="col-xs-2 control-label">Type</label>
	    <div class="col-xs-6">
				<select class = "form-control" name= "type" id = "type">
					<option value = '0'>Moderator</option>
					<option value = '1'>Admin</option>
				</select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="community" class="col-xs-2 control-label">Community</label>
	    <div class="col-xs-6">
				<select class = "form-control" name= "community" id = "community">
				
				<?php


				$names = mysql_query("SELECT * FROM communities ORDER BY ID DESC") or die(mysql_error());

				while($number = mysql_fetch_assoc($names)){
	
						echo("<option value = '".$number['name']."'>".$number['name']."</option>");

					}
								
				?>
				</select>
	    </div>
	  </div>
 <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "register" class="btn btn-default">Register</button>
    </div>
  </div>
</form>