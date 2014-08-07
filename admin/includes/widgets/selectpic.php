<h1>Moderator Picture</h1>

<?php

?>

<?php

if (isset($_GET['p']) === true && empty($_GET['p']) === true) {
	echo 'Picture Updated';
}

if(empty($_POST) === false && empty($errors) === true){
	
	if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
		
		$update_data = array(
			'profile' 				=> $_POST['pic_id'],
		);
	
		$success = update_admin(admin_id_from_codename($_GET['codename']), $update_data);
						
		header('Location: profile.php?codename='.$_GET['codename']);
		
	}
	
				
	if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
		
		$codename = head_admin_codename_from_community_name($_GET['community']);
		$id = admin_id_from_codename($codename);
	
		$update_data = array(
			'profile' 				=> $_POST['pic_id'],
		);
	
		$success = update_admin($id, $update_data);
						
		header('Location: overview.php?community='.$_GET['community']);

	}	
	
	if(isset($_GET['community']) === false && isset($_GET['codename']) === false){
		
		$update_data = array(
			'profile' 				=> $_POST['pic_id'],
		);
	
		$success = update_admin($admin_data['id'], $update_data);
							
		header('Location: me.php?p');
					
	}
			
	exit();
	
} else if (empty($errors) === false) {
	echo output_errors($errors);
}

?>

<h3>Current Pic:</h3>

<?php
	
if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	$url = get_mods_picurl(admin_id_from_codename($_GET['codename']));
	echo '<img width = "200px" height = "200px" src="../' . $url . '"><br><br><hr>';

}	

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	$codename = head_admin_codename_from_community_name($_GET['community']);
	$id = admin_id_from_codename($codename);
	
	$url = get_mods_picurl($id);
	echo '<img width = "200px" height = "200px" src="../' . $url . '"><br><br><hr>';

}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){
	
	$url = get_mods_picurl($admin_data['id']);

	echo '<img width = "200px" height = "200px" src="../' . $url . '"><br><br><hr>';

}

	
?>

<h3>Select New:</h3>
<form action="" method="post">
<ul>
				<?php 
								
				$pics = get_pics('moderator', 0);	
				
				foreach ($pics as $currentpic) {
					echo('<li>');
					echo('<input type = "radio" name="pic_id" value = "'.$currentpic['id'].'">');
					echo ($currentpic['nickname']. '<br>');
					echo '<img width = "200px" height = "200px" src="../' . $currentpic['url'] . '"><br><br><hr>';
					echo('</li>');
						
				}
				
				?>
			</select>
		</li>
		<li>
			<input type = 'submit' value = 'Update'>
		</li>
</ul>
</form>
				