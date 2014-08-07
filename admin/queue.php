<?php
include 'core/init.php';
include 'includes/overall/header.php';


?>

<?php

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	admin_protect_page();
	
	echo('<h1>'. $_GET['community'] . ' (Pending)</h1> ');


}else{
	moderator_protect_page();
	
	echo('<h1>'. $admin_data['community'] . ' (Pending)</h1>');

}
	
include("includes/content/pending.php")



?>

<?php include 'includes/overall/footer.php'; ?>