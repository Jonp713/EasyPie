<?php
include 'core/init.php';
protect_page();


include 'includes/overall/header.php';


?>

	


<?php




//nav
if(isset($_GET['service']) == false && isset($_GET['c']) == false){
	
	echo('<span class = "admin-stuff col-sm-8 col-sm-offset-2 col-xs-12">');

	include 'includes/admin/displaycommunities.php';

	echo('</span>');

}else{
	
	
?>
	
	<span class = "col-xs-12 no-padding dashboard">
		

			<span class = "userinfo col-xs-2">

				<h1 class = "usernametitle"><?php echo $user_data['username']; ?></h1>
				<br><?php
				
				if(isset($_GET['service']) && isset($_GET['c'])){

	$points = service_sub_count($_GET['service'], $_GET['c']);
	
	echo('<span class = "pointsline ">');
	
	echo('<span class = "pointscount">'.$points.'</span> people have subscribed to your board!&nbsp;');
	
	
	if(service_is_home($_GET['service'], $_GET['c']) == 1){
		
		echo('<br><br>Your franchise is part of the home feed!&nbsp;');
		
	}else{
		
		echo('<br><br>Your franchise has not been added to the home feed&nbsp;');
		
	}
	
	echo('</span>');
	
	}
	
	if(isset($_GET['service']) && isset($_GET['c']) == false){

		$points = count_franchises($_GET['service']);

		echo('<span class = "pointsline ">');

		echo('Your service has <span class = "pointscount">'.$points.'</span>&nbsp; franchises');

		echo('</span>');

}
	
	

?>
				
				<span class = "dashsidelinks text-left">
				
				<br><a href = "admin.php">Admin Home</a>
				
			</span>
				
			
			</span>
		

			<span class = "dashnavbar text-left row">
	
			<?php include 'includes/admin/admindashnavbar.php'; ?>
		
		</span>
	
		<span class = "dashboard-content">
	
	
<?php
}

//moderate service
if(isset($_GET['service']) == true && isset($_GET['c']) == true){
		
	switch($_GET['p']){
		case 'Queue':
		
			if($_GET['service'] == "Hole"){
			
				header('location: admin.php?service='.$_GET["service"].'&c='.$_GET["c"].'&p=Approved');
				exit();
			
			}
			include 'includes/admin/queue.php';
		
		break;
		case 'Approved':
		
			include 'includes/admin/approved.php';
		
		break;
		case 'Announcements':
		
			include 'includes/admin/announcements.php';
		
		break;
		case 'Memebase':
			include 'includes/admin/memebase.php';
		
		break;
		case 'Options':
		
			include 'includes/admin/s-options.php';
		
		break;
		default:
	
			if($_GET['service'] == "Hole"){
		
				header('location: admin.php?service='.$_GET["service"].'&c='.$_GET["c"].'&p=Approved');
				exit();
		
			}
			include 'includes/admin/queue.php';
		
	}
	
	
	
}

//own service
if(isset($_GET['service']) == true && isset($_GET['c']) == false){
	
	
	switch($_GET['p']){
		case 'Update':
		
			include 'includes/admin/o-update.php';
		
		break;
		case 'Logo':
		
			include 'includes/admin/logo.php';
		
		break;
		case 'Content':
		
			include 'includes/admin/content.php';
		
		break;
		case 'Information':
		
			include 'includes/admin/information.php';
		
		break;
		case 'Options':
		
		//UPDATE `posts` SET is_home = 1 WHERE service = '$service_name';
		//UPDATE `posts` SET needs_approve = 1 WHERE service = '$service_name';
		
			include 'includes/admin/o-options.php';
		
		break;
		case 'Stats':
		
			include 'includes/admin/stats.php';
		
		break;
		default:
		
			include 'includes/admin/o-update.php';
		
	}
		
}

//c overview
if(isset($_GET['service']) == false && isset($_GET['c']) == true){
	
	switch($_GET['p']){
		case 'Services':
		
			include 'includes/admin/services.php';
		
		break;
		case 'Info':
		
			include 'includes/admin/info.php';
		
		break;
		case 'Announcements':
		
			include 'includes/admin/announcements.php';
		
		break;
		
		case 'Options':
		
			include 'includes/admin/c-options.php';
		
		break;
		default:
		
			include 'includes/admin/services.php';
		
	}
	
	
}



?>


<?php

if(isset($_GET['service']) == false && isset($_GET['c']) == false){}else{

	echo('</span></span>');
	
	}
	
	?>

<?php include 'includes/overall/footer.php'; ?>