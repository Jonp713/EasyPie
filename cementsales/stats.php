<?php

include 'core/init.php';
admin_protect_page();

include 'includes/overall/header.php';


?>

<?php

echo('<h1>'. $_GET['community'] . ' Stats</h1><br>');

$count = community_sub_count($_GET['community']);

echo("<h2>Subscription Count: ". $count . "</h2><br>");	
	
?>

<?php
	
include 'includes/overall/footer.php'; 

?>

