<?php

moderator_protect_page();

?>

<h1>Create Service</h1>

<?php 

if (empty($_POST) === false && isset($_POST['description'])) {
	$required_fields = array('name', 'description');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must fill out the required fields';
			break 1;
		}
	}
	
	if (empty($_FILES['pic']['name']) == true) {
		
		$errors_p[] = 'Please choose a file!';
		
	}else{
	
		$allowed = array('jpg', 'jpeg', 'gif', 'png');
		
		$file_name = $_FILES['pic']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['pic']['tmp_name'];
		
		if (in_array($file_extn, $allowed) === true) {} else {
			
			$errors[] =  'Incorrect file type. Allowed: ' . implode(', ', $allowed);
			
		}
		
	}
	
	
	if (strlen($_POST['description']) > 80) {
		$errors[] = 'The description must be under 80 characters';
	}
	
	
	if (empty($errors) === true) {
		if (service_exists($_POST['name']) === true) {
			$errors[] = 'Sorry, the service \'' . $_POST['name'] . '\' already exists';
			
		}
	}
}


if (isset($_GET['c']) === true && empty($_GET['c']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Service Created</strong></div>');
}
	
if (empty($_POST) === false && isset($_POST['description']) && empty($errors) === true) {
	
		upload_image($session_admin_id, $_POST['name'], 'service', $file_temp, $file_extn);
		
		$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM pictures WHERE admin_id = '$session_admin_id'"));
			
		$data = array(
			'name' 		=> $_POST['name'],
			'description' 		=> $_POST['description'],
			'color'		=> $_POST['color'],
			'picture_id' => $theid['id'],
			'core' 				=> 1,
			
		);

		create_service($data);
		header('Location: service.php?c');
		exit();
				
}else if (empty($errors) === false) {

	echo output_errors($errors);
}


?>


<form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
			
	  	  <div class="form-group">
	  	    <label for="name" class="col-xs-2 control-label">Service Name</label>
	  	    <div class="col-xs-6">
	  	      <input type="text" class="form-control" id="name" name="name">
	  	    </div>
	  	  </div>
		  
	  	  <div class="form-group">
	  	    <label for="description" class="col-xs-2 control-label">Description</label>
	  	    <div class="col-xs-6">
	  	      <input type="text" class="form-control" id="description" name="description">
	  	    </div>
	  	  </div>
		  
	  	  <div class="form-group">
	  	    <label for="color" class="col-xs-2 control-label">Color</label>
	  	    <div class="col-xs-6">
	  	      <input type="text" class="form-control" id="color" name="color">
	  	    </div>
	  	  </div>
			
			 <div class="form-group">
				     <label for="pic" class="col-xs-2 control-label">Logo Picture:</label>
			 <div class="col-xs-6">
	
			<input class = "form-control" type="file" id = "pic" name="pic">
			
		</div>
	</div>
			
  
  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "update" class="btn btn-default">Submit</button>
    </div>	
    </div>
  </div>

</form>