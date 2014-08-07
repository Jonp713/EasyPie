<h1>Terminator</h1>

<?php

if (isset($_GET['t']) === true && empty($_GET['t']) === true) {
	echo '<br>Terminator Updated';
}

if (empty($_POST) === false && empty($errors) === true && isset($_POST['status'])){
	
	$password = md5($_POST['password']);

	update_terminator($session_admin_id, $_POST['status'], $password);
		
	header('Location: server.php?t');
		
}

	
$result = mysql_fetch_assoc(mysql_query('SELECT * FROM `general` WHERE `name` = "terminator"'));	

?>
<form action="" method="post">
<ul>
	<li>
	Terminator Mode:<select name="status">
		<option value = '<?php echo $result['status'] ?>'><?php echo $result['status'] ?></option>
		<option value = '0'>Off</option>
		<option value = '1'>Sentinel</option>
		<option value = '2'>Lock Down</option>
		<option value = '3'>Termination</option>
	</select>
	</li>
	<li>
		<input type = 'text' name = 'password'>
	</li>
	<li>
		<input type="submit" value="Update">
	</li>
</ul>
</form>