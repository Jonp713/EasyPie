<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';?>

<?php

include 'includes/content/displaymessages.php';	
include 'includes/content/displaymessagessent.php';	

clear_old_messages($session_user_id);
	
?>


<?php
include 'includes/overall/footer.php';
?>