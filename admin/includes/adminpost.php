<?php

if (empty($_POST) === false && isset($_POST['admin_post'])) {
			
	$required_fields = array('admin_post');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'An admin post cannot be blank';
			break 1;
		}
	}
	
}

?>
<h1>Admin Post</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'Your admin post is now live';
	
} 
		
if (empty($_POST) === false && empty($errors) === true && isset($_POST['admin_post'])) {	
	
	if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
		
		$success = admin_post($_POST['admin_post'], $session_admin_id, $_GET['community']);
	
		if($success){
		
			header('Location: overview.php?community='.$_GET['community'].'&s');
			exit();
	
		}else{
		
			echo($success);
		
		}	
	}
	
	if(empty($_GET) === true){
		
		$success = admin_post($_POST['admin_post'], $session_admin_id, $admin_data['community']);
	
		if($success){
		
			header('Location: community.php?s');
			exit();
	
		}else{
		
			echo($success);
		
		}
		
	}
	
}else if (empty($errors) === false) {

	echo output_errors($errors);
}

if(isset($_GET['codename'])){}else{

	
?>

	<form action="" method="post">
		<ul>
			
			<li>
				Admin Post:<br>
				<input type="text" name="admin_post">
			</li>
			
			<li>
				<input type="submit" value="Post">
			</li>
		</ul>
	</form>
	
	
<h3>Live Posts</h3>

<?php 

}

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$admin_posts = get_admin_post($_GET['community'], $session_admin_id, 0, 1);

	foreach ($admin_posts as $currentpost) {
		
		$codename = admin_data($currentpost['admin_id'], 'codename');

		echo($currentpost['message'] . '<br>');
		echo('Submitted by:<i>'.$codename["codename"].'</i><br>');
		echo('<span class = "delete_admin_post" onclick="delete_admin_post('.$currentpost['id'].')"">Take Down Post</span><br><br>');


	}


}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	$admin_posts = get_admin_post(null, admin_id_from_codename($_GET['codename']), 0, 2);

	foreach ($admin_posts as $currentpost) {

		echo($currentpost['message'] . '<br>');
		
		if($currentpost['status'] == 0){
			
			echo('<span class = "delete_admin_post" onclick="delete_admin_post('.$currentpost['id'].')"">Take Down Post</span><br><br>');
		
		}else{
			
			echo('<br>');
		}


	}
	
}

if(empty($_GET) === true){

	$admin_posts = get_admin_post($admin_data['community'], $session_admin_id, 0, 0);

	foreach ($admin_posts as $currentpost) {

		echo($currentpost['message'] . '<br>');
		echo('<span class = "delete_admin_post" onclick="delete_admin_post('.$currentpost['id'].')"">Take Down Post</span><br><br>');


	}

}


?>