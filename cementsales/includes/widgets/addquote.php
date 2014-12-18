<?php

admin_protect_page();

?>

<?php

if (empty($_POST) === false && isset($_POST['character_id'])) {
	$required_fields = array('character_name', 'service_id', 'text', 'character_id');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must fill out the required fields';
			break 1;
		}
	}

}

?>
<h1>Add Quote</h1>

<?php
if (isset($_GET['q']) === true && empty($_GET['q']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Successfully Added</strong></div>');
} 
	
if (empty($_POST) === false && empty($errors) === true && isset($_POST['character_id'])) {

	//check if that character already has service
	
	$register_data = array(
		'community_name' 		=> $_POST['community_name'],
		'service_id' 		=> $_POST['service_id'],
		'character_id' 		=> $_POST['character_id'],
		'text' 		=> $_POST['text']
		
	);

	add_quote($register_data);
	header('Location: characters.php?q');
	exit();
				
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>


<form action="" method="post" class="form-horizontal" role="form">

		      <div>
				<textarea placeholder = "Write a quote..." name="text" class = "form-control"></textarea>
				</div>
			</div>

	  <div class="form-group">
	    <label for="community" class="col-xs-2 control-label">Community:</label>
	    <div class="col-xs-6">
				<select class = "form-control" name= "community_name" id = "community">
				
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
	    <label for="character" class="col-xs-2 control-label">Character:</label>
	    <div class="col-xs-6">
				<select class = "form-control" name= "character_id" id = "character">
				
				<?php


				$names = mysql_query("SELECT * FROM characters ORDER BY ID DESC") or die(mysql_error());

				while($number = mysql_fetch_assoc($names)){
	
						echo("<option value = '".$number['id']."'>".$number['name']."</option>");

					}
								
				?>
				</select>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="service" class="col-xs-2 control-label">Services:</label>
	    <div class="col-xs-6">
				<select class = "form-control" name= "service_id" id = "service">
				
				<?php


				$names = mysql_query("SELECT * FROM services WHERE core = 1 ORDER BY ID DESC") or die(mysql_error());

				while($number = mysql_fetch_assoc($names)){
	
						echo("<option value = '".$number['id']."'>".$number['name']."</option>");

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