<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';?>

<?php

include 'includes/savedposts.php';
include 'includes/approvedposts.php';
include 'includes/displaymessages.php';	
include 'includes/displaymessagessent.php';	
include 'includes/displaypoints.php';	

clear_old_messages($session_user_id);
	
?>


<?php
include 'includes/overall/footer.php';
?>