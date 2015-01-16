<?php

include 'core/init.php';
moderator_protect_page();
include 'includes/overall/header.php';


?>

<?php

include ('includes/widgets/adminpost.php');
include("includes/content/displayadminposts.php");

echo("<h3><a href = 'quit.php'>Quit</a></h3>");

	
?>

<?php
	
include 'includes/overall/footer.php'; 
	
?>


