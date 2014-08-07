<?php
include 'core/init.php';
include 'includes/overall/header.php';


?>

<?php
	
if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	admin_protect_page();
	

	echo('<h1>'. $_GET['community'] . ' (Approved)</h1> ');


}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	admin_protect_page();

	echo('<h1>'. $_GET['codename'] . ' (Approved)</h1> ');


}

if(empty($_GET) === true){
	
	echo('<h1>'. $admin_data['community'] . ' (Approved)</h1> ');

}
	
include("includes/content/approved.php");



?>

<?php include 'includes/overall/footer.php'; ?>