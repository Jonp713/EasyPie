<?php

include 'core/init.php';
admin_protect_page();

include 'includes/overall/header.php';


?>

<?php

$has = check_if_head_moderator_exists($session_admin_id, $_GET['community']);

$head_codename = head_admin_codename_from_community_name($_GET['community']);

echo('<h1>'.$_GET['community'] . ' Overview</h1><br>');

include ('includes/widgets/communitydescription.php');

if($has == false){

	echo('<hr><h1>Head Moderator: ' . $head_codename . '</h1>');

}

echo('<h3>All '. $_GET['community'] .' Moderators:</h3>');

include ('includes/content/displayadmins.php');
	
include ('includes/widgets/adminpost.php');
include("includes/content/displayadminposts.php");

	
?>

<?php
	
	include 'includes/overall/footer.php'; 
	
	?>

