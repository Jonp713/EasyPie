<?php

include 'core/init.php';
include 'includes/overall/header.php';
moderator_protect_page();


?>

<?php

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	admin_protect_page();
	
	echo('<h1>'.$_GET['community'] . ' High Scores</h1><br>');


}

if(empty($_GET) === true){
	moderator_protect_page();
	
	echo('<h1>'. $admin_data['community'] . ' High Scores</h1> ');

}
	

echo('<h2>High Scores</h2><br>');


include ('includes/content/displaypoints.php');

	
	
	
?>

<?php
	
	include 'includes/overall/footer.php'; 
	
	?>

