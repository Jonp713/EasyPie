<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
?>

<span class = "col-xs-12 no-padding dashboard">
		
		<span class = "userinfo col-xs-2">

			<h1 class = "usernametitle"><?php echo $user_data['username']; ?></h1><br>
			<?php include 'includes/content/displaypoints.php'; ?>
			
			<span class = "dashsidelinks text-left">
				
					<br><a href = "admin.php">Admin</a>
				
				
				<br><a href = "identity.php">Identity</a>
					
				<br><a href = "information.php">Account</a><br>
		    	<a href="logout.php">Log Out</a>
		
			</span>
		
		</span>
		
		<span class = "dashnavbar text-left row">
	
		<?php include 'includes/widgets/dashnavbar.php'; ?>
		
	</span>
	
	<span class = "dashboard-content">
	
	<?php
	
	//for some reason messages do need spacing up with dashcontent
	if($_GET['t'] == "inbox"){
		
		clear_old_messages($session_user_id);
		
		include 'includes/content/displaymessages.php';
		
		
	}
	
	//for some reason messages do need spacing up with dashcontent
	if($_GET['t'] == "sent"){
		
		clear_old_messages($session_user_id);
		
		include 'includes/content/displaymessagessent.php';
		
		
	}
	
	
	?>
	
	
	<?php
	
	

	if($_GET['t'] == "notifications"){
		
		include 'includes/content/displaynotifications.php';
		
	}

	if($_GET['t'] == "saved"){
		
		
		include 'includes/content/savedposts.php';
			
		
	}
	if($_GET['t'] == "submissions"){
		
		
		include 'includes/content/approvedposts.php';
				
		
	}
	
	?>
</span>

</span>

<?php

include 'includes/overall/footer.php'; 

?>


