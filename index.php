<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>

<?php 

if(logged_in() == true){
		
	include 'includes/displaycommunities.php';
	
}else{
		
	include 'includes/displaycommunities.php';
	
}

?>

<?php include 'includes/overall/footer.php'; ?>