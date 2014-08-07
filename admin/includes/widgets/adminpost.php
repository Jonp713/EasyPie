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

<div id = "admin-post" class = "row">
<span class = "col-md-6">
	
<h1>Admin Post</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo '<div class="alert alert-success" role="alert"><strong>Your admin post is now live</strong></div>
';
	
} 
		
if (empty($_POST) === false && empty($errors) === true && isset($_POST['admin_post'])) {	
	
	if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
		
		$success = admin_post($_POST['admin_post'], $session_admin_id, $_GET['community']);
	
		if($success){
		
			header('Location: overview.php?community='.$_GET['community'].'&s#admin-post');
			exit();
	
		}else{
		
			echo($success);
		
		}	
	}
	
	if(isset($_GET['community']) === false && isset($_GET['codename']) === false){
		
		$success = admin_post($_POST['admin_post'], $session_admin_id, $admin_data['community']);
	
		if($success){
		
			header('Location: me.php?s#admin-post');
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
	<span class = "form-group">
		<label for="post">New Admin Post:</label>
		<input type="text" class="form-control" id = "post" name="admin_post">
	</span>
    <button type="submit" class="btn btn-primary">Post Live</button>
</form>
</div>


<?php 

}

?>