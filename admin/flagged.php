<?php
include 'core/init.php';
admin_protect_page();
include 'includes/overall/header.php';


?>

<?php

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){

	echo('<h1>'. $_GET['codename'] . ' (Flagged)</h1> ');


}

include("includes/flagged.php")



?>

<?php include 'includes/overall/footer.php'; ?>