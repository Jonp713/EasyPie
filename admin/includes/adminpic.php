<h1>Moderator Picture</h1>

<?php
if (isset($_FILES['profile']) === true) {
	if (empty($_FILES['profile']['name']) === true) {
		echo 'Please choose a file!';
	} else {
		$allowed = array('jpg', 'jpeg', 'gif', 'png');
		
		$file_name = $_FILES['profile']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['profile']['tmp_name'];
		
		if (in_array($file_extn, $allowed) === true) {
			
			if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
				
				$id = admin_id_from_codename($_GET['codename']);
				change_profile_image($id, $file_temp, $file_extn);
				
				header('Location: profile.php?codename='.$_GET['codename']);
			
			}
						
			if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
				
				$codename = head_admin_codename_from_community_name($_GET['community']);
				$id = admin_id_from_codename($codename);
				change_profile_image($id, $file_temp, $file_extn);
				
			
				header('Location: overview.php?community='.$_GET['community']);
			
			}
			if(empty($_GET) === true){
				
				change_profile_image($session_admin_id, $file_temp, $file_extn);
				header('Location: ' . $current_file);
				
			}
			exit();
			
		} else {
			echo 'Incorrect file type. Allowed: ';
			echo implode(', ', $allowed);
		}
	}
}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	$id = admin_id_from_codename($_GET['codename']);	
	$image_data = admin_data($id, 'profile', 'initials');
			
	echo '<img width = "200px" height = "200px" src="', $image_data['profile'], '" alt="', $image_data['initials'], '\'s Profile Image">';


}

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$codename = head_admin_codename_from_community_name($_GET['community']);
	
	if(empty($codename)){}else{
	
		$id = admin_id_from_codename($codename);
	
		$image_data = admin_data($id, 'profile', 'initials');
			
		echo '<img width = "200px" height = "200px" src="', $image_data['profile'], '" alt="', $image_data['initials'], '\'s Profile Image">';

	}

}
if(empty($_GET) === true){

	if (empty($admin_data['profile']) === false) {
	
		echo '<img width = "200px" height = "200px" src="', $admin_data['profile'], '" alt="', $admin_data['initials'], '\'s Profile Image">';
	}
}


?><br>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="profile"> <input type="submit">
</form>
<br><br>