<?php

moderator_protect_page();

?>

<?php

if (empty($_POST) === false && isset($_POST['description'])) {
	
	if (strlen($_POST['description']) > 80) {
		$errors[] = 'The description must be under 80 characters';
	}

}

?>

<h1>Community Update:</h1>

<?php

if (isset($_GET['d']) === true && empty($_GET['d']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Community Updated</strong></div>');
}

if (empty($_POST) === false && empty($errors) === true && isset($_POST['description'])){
	
	if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
		$update_data = array(
			'description' 		=> $_POST['description'],
			'status' 			=> $_POST['status'],
			'head_admin_id' 	=> $_POST['head_admin_id'],
			'hole'			 	=> $_POST['hole']				
		);
	
		update_community($session_admin_id, $update_data, $_GET['community']);
			
		header('Location: overview.php?community='.$_GET['community'].'&d');
	
	}else{
		
		$update_data = array(
			'description' 		=> $_POST['description'],
		);
	
		update_community($session_admin_id, $update_data, $admin_data['community']);
	
		header('Location: community.php?d');
		
	}
	
	exit();
	
} else if (empty($errors) === false) {
	echo output_errors($errors);
}

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){

	$community = $_GET['community'];
	
}else{
	
	$community = $admin_data['community'];
	
}
	
$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));

	
?>
<form action="" method="post" class="form-horizontal" role="form">
	
	  <div class="form-group">
	    <label for="description" class="col-xs-2 control-label">Community Description</label>
	    <div class="col-xs-6">
	      <input type="text" class="form-control" id="description" name="description" value="<?php echo $result['description']; ?>">
	    </div>
	  </div>
		
		<?php
			
			if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
				
				?>
				
				    <div class="form-group">
				      <label for="status" class="col-xs-2 control-label">Status</label>
				      <div class="col-xs-6">
					   	<select class = "form-control" id = "status" name="status">
							<option value = '<?php echo($result['status']) ?>'>
								
		<?php 
		
		if($result['status'] == 0){
			
			echo("Pending");
			
		}
		if($result['status'] == 1){
			
			echo("Live");
			
		}
		if($result['status'] == 2){
			
			echo("Taken Down");
			
		}
	  
	   ?></option>
							<option value = '0'>Pending</option>
							<option value = '1'>Live</option>
							<option value = '2'>Taken Down</option>
						</select>
		
					</div>
					</div>
					
				    <div class="form-group">
				      <label for="hole" class="col-xs-2 control-label">Hole</label>
				      <div class="col-xs-6">
				   	<select class = "form-control" id = "hole" name="hole">
						<option value = '<?php echo $result['hole'] ?>'>
		<?php 
		
		if($result['hole'] == 0){
			
			echo("Not Available");
			
		}
		if($result['hole'] == 1){
			
			echo("Available");
			
		}
	   ?></option>
						<option value = '0'>Not Available</option>
						<option value = '1'>Available</option>
					</select>

					</div>
					</div>
					
				    <div class="form-group">
				      <label for="head_admin" class="col-xs-2 control-label">Head Moderator</label>
				      <div class="col-xs-6">
				   	<select class = "form-control" id = "head_admin" name="head_admin_id">
						<option value = '<?php echo $result['head_admin_id']; ?>'><?php echo( head_admin_codename_from_community_name($_GET['community']));
 ?></option>
						<?php 
						$admins = get_admins($_GET['community'], 1);
												
						
						foreach ($admins as $currentadmin) {
							echo('<option value = '.$currentadmin['id'].'>'.$currentadmin['codename'].'</option>');
						
						}
						
						$admins2 = get_admins(null, 2);
						
						foreach ($admins2 as $currentadmin) {
							echo('<option value = '.$currentadmin['id'].'>'.$currentadmin['codename'].' - Admin</option>');
						
						}
						
						?>
					</select>
					</div>
					</div>
				
				<?php
				
			}
			
		?>
		

  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "update" class="btn btn-default">Update</button>
    </div>	
    </div>
  </div>
  
</form>


	
	
	
	
