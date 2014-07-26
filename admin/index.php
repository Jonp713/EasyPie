<?php
include 'core/init.php';
include 'includes/overall/header.php';


?>

<?php
	
	

if(admin_logged_in() === true){

	echo('Welcome');
	
}else{
	
	echo('Nothing to see here. Why dont you go take a walk?');
	
}



?>

<?php include 'includes/overall/footer.php'; ?>