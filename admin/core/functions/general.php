<?php


function moderator_protect_page() {
	if (admin_logged_in() === false) {
		header('Location: index.php');
		exit();
	}else{
		
		if(check_admin_power($_SESSION['admin_id']) >= 1){
			
			header('Location: index.php');
			exit();
			
		}
		
	}
}


function admin_protect_page() {
	if (admin_logged_in() === false) {
		header('Location: index.php');
		exit();
	}else{
		if(check_admin_power($_SESSION['admin_id']) < 1){
			
			header('Location: index.php');
			exit();
			
		}
		
	}
}

function admin_protect_function(){
	
	
	
}

?>

