<?php

if (empty($_POST) === false && isset($_POST['description'])) {
	
	if ((empty($errors) === true) && (empty($_POST['email']) === false)){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = '<p class = "form_error">A valid email address is required</p>';
		}
	}
}

?>

<h1>Info</h1>

<?php

if (isset($_GET['d']) === true && empty($_GET['d']) === true) {
	echo 'Admin Updated';
}

if(empty($_POST) === false && empty($errors) === true && isset($_POST['email'])){
	
	if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
			
		$update_data = array(
			'email' 				=> $_POST['email'],
			'status' 				=> $_POST['status'],
			'type' 					=> $_POST['type'],
			'community'			 	=> $_POST['community_name']				
		);
	
		update_admin(admin_id_from_codename($_GET['codename']), $update_data);
			
		header('Location: profile.php?codename='.$_GET['codename'].'&d');
		
	}
	exit();
	
} else if (empty($errors) === false) {
	echo output_errors($errors);
}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){

	$codename = $_GET['codename'];
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM cementsalesmen WHERE codename = '$codename'"));
	

?>

<form class = "admin_data_form" action="" method="post">
				
	Email:<br>
	<input type="text" name="email" value="<?php echo $result['email']; ?>">

	Status:<select name="status">
		<option value = '<?php echo($result['status']) ?>'><?php echo($result['status']) ?></option>
		<option value = '0'>Good Standing</option>
		<option value = '1'>Warned</option>
		<option value = '2'>Fired</option>
		<option value = '3'>Quit</option>
	</select>

	Privelages:<select name="type">
		<option value = '<?php echo $result['type'] ?>'><?php echo $result['type'] ?></option>
		<option value = '0'>Moderator</option>
		<option value = '1'>Admin</option>
	</select>

	Community:<select name="community_name">
		<option value = '<?php  echo $result['community']; ?>'><?php echo $result['community']; ?></option>
		<?php 
		$communities = get_communities(0, '');
		
		foreach ($communities as $currentcommunity) {
			echo('<option value = '.$currentcommunity['name'].'>'.$currentcommunity['name'].'</option>');
		
		}
		
		
		?>
	</select>

	<input type="submit" value="Update">
</form>

		<?php
		
	}
	
?>
