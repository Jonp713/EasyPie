<?php
include 'core/init.php';
protect_page();

include 'includes/overall/header.php';

?>

<span class = "admin-stuff col-xs-12">
	

<?php


//nav
if(isset($_GET['service']) == false && isset($_GET['community']) == false){

include 'includes/admin/displaycommunities.php';

}

//moderate service
if(isset($_GET['service']) == true && isset($_GET['community']) == true){
		
	switch($_GET['p']){
		case 'queue':
		
			include 'includes/admin/queue.php';
		
		break;
		case 'quotes':
		
			include 'includes/admin/quotes.php';
		
		break;
		case 'stats':
		
			include 'includes/admin/stats.php';
		
		break;
		case 'options':
		
			include 'includes/admin/s-options.php';
		
		break;
		default:
		
			include 'includes/admin/queue.php';
		
	}
	
	
	
}

//own service
if(isset($_GET['service']) == true && isset($_GET['community']) == false){
	
	switch($_GET['p']){
		case 'stats':
		
			include 'includes/admin/stats.php';
		
		break;
		case 'options':
		
			include 'includes/admin/o-options.php';
		
		break;
		case 'settings':
		
			include 'includes/admin/settings.php';
		
		break;
		case 'character/logo':
		
			include 'includes/admin/character.php';
		
		break;
		default:
		
		
			include 'includes/admin/stats.php';
		
	}
		
}

//community overview
if(isset($_GET['service']) == false && isset($_GET['community']) == true){
	
	switch($_GET['p']){
		case 'info':
		
			include 'includes/admin/info.php';
		
		break;
		
		case 'stats':
		
			include 'includes/admin/c-stats.php';
		
		break;
		case 'announcements':
		
			include 'includes/admin/announcements.php';
		
		break;
		
		case 'options':
		
			include 'includes/admin/c-options.php';
		
		break;
		case 'services':
		
			include 'includes/admin/services.php';
		
		break;

		default:
		
			include 'includes/admin/info.php';
		
	}
	
	
}



?>

</span>

<?php include 'includes/overall/footer.php'; ?>