
<?php

if (empty($_POST) === false && isset($_POST['status'])) {
	
	if($_POST['status']){
		
		
	}

}

?>

<h1>Community Description:</h1>

<?php

if (isset($_GET['d']) === true && empty($_GET['d']) === true) {
	echo '<br>Community Updated';
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
<form action="" method="post">
	<ul>
		<li>
			<input type="text" name="description" value="<?php echo $result['description']; ?>">
		</li>
		<?php
			
			if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
				
				?>
				
				<li>
					Status:<select name="status">
						<option value = '<?php echo($result['status']) ?>'><?php echo($result['status']) ?></option>
						<option value = '0'>Pending</option>
						<option value = '1'>Live</option>
						<option value = '2'>Taken Down</option>
					</select>
				</li>
				
				<li>
					Hole:<select name="hole">
						<option value = '<?php echo $result['hole'] ?>'><?php echo $result['hole'] ?></option>
						<option value = '0'>Down</option>
						<option value = '1'>Up</option>
					</select>
				</li>
				<li>
					Head Moderator:<select name="head_admin_id">
						<option value = '<?php echo $result['head_admin_id']; ?>'><?php echo( head_admin_codename_from_community_name($_GET['community']));
 ?></option>
						<?php 
						$admins = get_admins($_GET['community'], 1);
												
						
						foreach ($admins as $currentadmin) {
							echo('<option value = '.$currentadmin['id'].'>'.$currentadmin['codename'].'</option>');
						
						}
						
						$admins2 = get_admins(null, 2);
						
						foreach ($admins2 as $currentadmin) {
							echo('<option value = '.$currentadmin['id'].'>'.$currentadmin['codename'].'</option>');
						
						}
						
						?>
					</select>
				</li>
				
				<?php
				
			}
			
		?>
		
		<li>
			<input type="submit" value="Update">
		</li>
	</ul>
</form>


	
	
	
	
