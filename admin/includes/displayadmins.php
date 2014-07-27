<?php
	
	if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
		$admins = get_admins($_GET['community'], 1);
		$type = 0;

	}else{

		$admins = get_admins(null, 0);
		$type = 1;
	}


	foreach ($admins as $currentadmin) {
		
		echo($currentadmin['codename'] . '<br>');
		
		if($type == 0){
			if($type == 1){
		
				echo('Privelages: Moderator<br>');
		
			}
		
			echo($currentadmin['community'] . '<br>');
		
		}
		if($type == 1){
		
			echo('Privelages: Admin<br>');
		
		}
		if($currentadmin['status'] == 0){
			
			echo('Good Standing<br>');
			
		}
		if($currentadmin['status'] == 1){
			
			echo('Warned<br>');
			
		}
		if($currentadmin['status'] == 2){
			
			echo('Fired<br>');
			
		}
		if($currentadmin['status'] == 4){
			
			echo('Retired<br>');
			
		}
		
		echo('<a href = "profile.php?codename=' . $currentadmin['codename'] . '">Profile</a><br>');
		
		echo('<a href = "approved.php?codename=' . $currentadmin['codename'] . '">Approved</a><br>');
		echo('<a href = "denied.php?codename=' . $currentadmin['codename'] . '">Denied</a><br>');
		echo('<a href = "adminposts.php?codename=' . $currentadmin['codename'] . '">Admin Posts</a><br>');
		echo('<a href = "flagged.php?codename=' . $currentadmin['codename'] . '">Flagged Posts('.count_flags(admin_id_from_codename($currentadmin['codename'])).')</a><br><br>');
	
		
	}

?>
