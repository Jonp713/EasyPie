<?php

include 'core/init.php';
admin_protect_page();
include 'includes/overall/header.php';


?>

<?php

check_if_head_moderator_exists($session_admin_id, $_GET['community']);

$head_codename = head_admin_codename_from_community_name($_GET['community']);

echo('<h1>Community: '. $_GET['community'] . '</h1><br>');

include ('includes/communitydescription.php');

echo('<hr><h1>Head Moderator: ' . $head_codename . '</h1>');

echo('<h3>All '. $_GET['community'] .' Moderators:</h3>');

include ('includes/displayadmins.php');
	
include ('includes/adminpost.php');

include ('includes/selectpic.php');
	
	
	
?>

<?php
	
	include 'includes/overall/footer.php'; 
	
	?>

