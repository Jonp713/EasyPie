<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
?>

<span class = "col-md-8 col-xs-12 col-xs-offset-0 col-md-offset-2 dashboard">
		
	<span class = "row">

		<span class = "pull-left">

			<h1 class = "usernametitle"><?php echo $user_data['username']; ?></h1><br>
			<?php include 'includes/content/displaypoints.php'; ?>
		
		</span>
		
		<span class = "pull-right dashsidelinks text-right">
			<br><a href = "information.php">Information & Security</a><br>
	    	<a href="logout.php">Log Out</a>
		
		</span>

	</span>
	<span class = "dashnavbar row">
	
		<?php include 'includes/widgets/dashnavbar.php'; ?>
		
	</span>
	
	<?php
	
	//for some reason messages do need spacing up with dashcontent
	if($_GET['t'] == "messages"){
		
		clear_old_messages($session_user_id);
		
		include 'includes/content/displaymessages.php';
		
		
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

<?php

include 'includes/overall/footer.php'; 

?>


