<?php

moderator_protect_page();

?>

<?php

if (empty($_POST) === false && isset($_POST['community'])) {
	$required_fields = array('community', 'service');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must fill out the required fields';
			break 1;
		}
	}

}

?>
<h1>Add Service</h1>

<?php
if (isset($_GET['a']) === true && empty($_GET['a']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Successfully Added</strong></div>');
} 
	
if (empty($_POST) === false && empty($errors) === true && isset($_POST['community'])) {

	//check if that community already has service
	
	$register_data = array(
		'community' 		=> $_POST['community'],
		'name' 				=> $_POST['service'],
		'core' 				=> 0,
		
	);

	add_service($register_data);
	header('Location: service.php?a');
	exit();
				
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>


<form action="" method="post" class="form-horizontal" role="form">

	  <div class="form-group">
	    <label for="community" class="col-xs-2 control-label">Community</label>
	    <div class="col-xs-6">
				<select class = "form-control" name= "community" id = "community">
				
				<?php


				$names = mysql_query("SELECT * FROM communities ORDER BY ID DESC") or die(mysql_error());

				while($number = mysql_fetch_assoc($names)){
	
						echo("<option value = '".$number['name']."'>".$number['name']."</option>");

					}
								
				?>
				</select>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="service" class="col-xs-2 control-label">Services</label>
	    <div class="col-xs-6">
				<select class = "form-control" name= "service" id = "service">
				
				<?php


				$names = mysql_query("SELECT * FROM services WHERE core = 1 ORDER BY ID DESC") or die(mysql_error());

				while($number = mysql_fetch_assoc($names)){
	
						echo("<option value = '".$number['name']."'>".$number['name']."</option>");

					}
								
				?>
				</select>
	    </div>
	  </div>
	  
	  
 <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "register" class="btn btn-default">Add</button>
    </div>
  </div>
</form>