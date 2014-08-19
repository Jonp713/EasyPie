<?php
	
	if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
		$admins = get_admins($_GET['community'], 1);
		$type = 0;
		
		if(count($admins) == 0){
			
			echo('<div class="alert alert-danger" role="alert">No Moderators!</div>');
			
		}
		

	}else{

		$admins = get_admins(null, 0);
		$type = 1;
		
		
	}

	foreach ($admins as $currentadmin) {
		
		echo('<span class = "row">');
		echo('<span class = "well well-sm col-xs-6">');
		
		echo($currentadmin['codename'] . '<br>');
		
		if($currentadmin['type'] == 0){
		
			echo('Privelages: Moderator<br>');
				
			echo('Community: <a href = "overview.php?community='. $currentadmin['community'] . '">'.$currentadmin['community'] . '</a><br>');
		
		}
		if($currentadmin['type']  == 1){
		
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
		echo('<a href = "flagged.php?codename=' . $currentadmin['codename'] . '">Flagged Posts</a> <span class = "badge">'.count_flags(admin_id_from_codename($currentadmin['codename'])).'</span><br>');	
		
		echo('</span></span>');
		 
		
	}

?>
