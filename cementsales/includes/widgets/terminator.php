<?php

moderator_protect_page();

?>

<h1>Terminator</h1>

<?php

if(isset($_POST['status'])){
		
	if(md5($_POST['password']) == 'f998325eeb785830789ca65e6b99a247'){}else{
	
		$errors_t[] = "Intruder Alert!";
	
	}
	
}

if (isset($_GET['t']) === true && empty($_GET['t']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Terminator Updated</strong></div>');
	
}

if (empty($_POST) === false && empty($errors_t) && isset($_POST['status'])){
	
	$success = update_terminator($session_admin_id, $_POST['status']);
	
	if($success){
		
		header('Location: server.php?t');
		
	}
		
		
}else if(empty($errors_t) == false){

	echo(output_errors($errors_t));	
	
}



	
$result = mysql_fetch_assoc(mysql_query('SELECT * FROM `general` WHERE `name` = "terminator"'));	

?>
<form action="" method="post" class="form-horizontal" role="form">
	
  <div class="form-group">
    <label for="status" class="col-xs-2 control-label">Terminator Mode:</label>
    <div class="col-xs-6">
 	<select class = "form-control" id = "status" name="status">
 		<option value = '<?php echo $result['status'] ?>'>
		<?php 
		
		if($result['status'] == 0){
			
			echo("Off");
			
		}
		if($result['status'] == 1){
			
			echo("Sentinel");
			
		}
		if($result['status'] == 2){
			
			echo("Lock Down");
			
		}
		if($result['status'] == 3){
			
			echo("Termination");
			
		}
		
		?></option>
 		<option value = '0'>Off</option>
 		<option value = '1'>Sentinel</option>
 		<option value = '2'>Lock Down</option>
 		<option value = '3'>Termination</option>
 	</select>
    </div>
  </div>

	
  <div class="form-group">
    <label for="password" class="col-xs-2 control-label">Password:</label>
    <div class="col-xs-6">
		<input type = 'text' name = 'password' class = "form-control" id = "password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "update" class="btn btn-default">Update</button>
    </div>	
    </div>
  </div>


</form>