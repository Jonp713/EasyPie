<?php

include 'core/init.php';
moderator_protect_page();

include 'includes/overall/header.php';


?>

<?php

echo('<h1>Community: '. $admin_data['community'] . '<br>Moderator: ' . $admin_data['codename'] . '</h1>');
	
$count = community_sub_count($admin_data['community']);

echo("<h2>Subscription Count: ". $count . "</h2><br>");	
	
include ('includes/communitydescription.php');	
	
?>

<?php
	
	include 'includes/overall/footer.php'; 
	
	?>

