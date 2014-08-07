<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>

<?php 

if(logged_in() == true){
		
	include 'includes/content/displaycommunities.php';
	
}else{
		
	include 'includes/content/displaycommunities.php';
	
}

?>

<?php include 'includes/overall/footer.php'; ?>