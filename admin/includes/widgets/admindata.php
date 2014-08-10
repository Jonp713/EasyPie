<?php

if (empty($_POST) === false && isset($_POST['email'])) {
	
	if ((empty($errors) === true) && (empty($_POST['email']) === false)){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors_ad[] = 'A valid email address is required';
		}
	}
}

?>

<h1>Info</h1>

<?php

if (isset($_GET['d']) === true && empty($_GET['d']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Admin Updated</strong></div>');

}

if(empty($_POST) === false && empty($errors_ad) === true && isset($_POST['email'])){
	
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
	
} else if (empty($errors_ad) === false) {
	echo output_errors($errors_ad);
}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){

	$codename = $_GET['codename'];
	
	$result = mysql_fetch_assoc(mysql_query("SELECT * FROM cementsalesmen WHERE codename = '$codename'"));
	

?>

<form class="form-horizontal" role="form" action="" method="post">
	
  <div class="form-group">
    <label for="email" class="col-xs-2 control-label">Email</label>
    <div class="col-xs-6">
	<input class = "form-control" id = "email" type="text" name="email" value="<?php echo $result['email']; ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="status" class="col-xs-2 control-label">Status</label>
    <div class="col-xs-6">
   	<select class = "form-control" id = "status" name="status">
		<option value = '<?php echo($result['status']) ?>'><?php 
		
		if($result['status'] == 0){
			
			echo("Good Standing");
			
		}
		if($result['status'] == 1){
			
			echo("Warned");
			
		}
		if($result['status'] == 2){
			
			echo("Fired");
			
		}
		if($result['status'] == 3){
			
			echo("Quit");
			
		}
	  
	   ?></option>
		<option value = '0'>Good Standing</option>
		<option value = '1'>Warned</option>
		<option value = '2'>Fired</option>
		<option value = '3'>Quit</option>
	</select>
</div>
</div>

  <div class="form-group">
    <label for="privelages" class="col-xs-2 control-label">Privelages</label>
    <div class="col-xs-6">
   	<select class = "form-control" id = "privelages" name="type">
		<option value = '<?php echo $result['type'] ?>'>
		<?php	
			
		if($result['type'] == 0){
			
			echo("Moderator");
			
		}
		if($result['type'] == 1){
			
			echo("Admin");
			
		}

		?></option>
		<option value = '0'>Moderator</option>
		<option value = '1'>Admin</option>
	</select>
	</div>
	</div>
	
	
  <div class="form-group">
    <label for="community" class="col-xs-2 control-label">Community</label>
    <div class="col-xs-6">
   	<select class = "form-control" id = "community" name="community_name">
		<option value = '<?php  echo $result['community']; ?>'><?php echo $result['community']; ?></option>
		<?php 
		$communities = get_communities(0, '');
		
		foreach ($communities as $currentcommunity) {
			echo('<option value = '.$currentcommunity['name'].'>'.$currentcommunity['name'].'</option>');
		
		}
		
		
		?>
	</select>
</div>
</div>

<div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "update" class="btn btn-default">Update</button>
    </div>	
    </div>
  </div>
</form>

		<?php
		
	}
	
?>
