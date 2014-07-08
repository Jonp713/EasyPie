<div id = 'navbar'>
	<?php
	if (logged_in() === true) {
		include 'includes/navbar/loggedin.php';
	} else {
		include 'includes/navbar/login.php';
	}
	?>
	&nbsp;<a href = 'explore.php'>Explore</a>
	
	
</div>