<?php

include 'core/init.php';
admin_protect_page();
include 'includes/overall/header.php';


?>

<?php

include('includes/terminator.php');
include('includes/displayrequests.php');

clear_old_requests();
	
	
?>

<?php
	
include 'includes/overall/footer.php'; 

?>