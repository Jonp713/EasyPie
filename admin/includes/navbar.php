<div id = 'navbar'>
	<?php
	if (admin_access() === true) {
		include 'includes/navbar/loggedin.php';
	} else {
		include 'includes/navbar/login.php';
	}
	?>	
	
</div>

<div id = 'navbar2'>
	
	<?php
	if (isset($_GET['community'])) {
		include 'includes/navbar/community.php';
	}
	if (isset($_GET['codename'])) {
		include 'includes/navbar/admin.php';
	}
	?>	
	
	
</div>