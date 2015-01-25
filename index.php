<?php

include 'core/init.php';
include 'includes/overall/header.php';


?>


<?php
	
if(logged_in() == true){

	header('Location: feed.php');


	
}else{
	
	/*
	$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
	$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
	
	if($Android || $iPod || $iPhone || $iPad) {

	
		header('Location: app.php');
	
		
	}else{
	
	*/
		
	
		header('Location: landing.php');
	
		//}
	
}
	
?>

<?php include 'includes/overall/footer.php'; ?>