<?php

moderator_protect_page();

?>

<h1>Create Community</h1>

<?php 

if (empty($_POST) === false && isset($_POST['state'])) {
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
		if (community_exists($_POST['name']) === true) {
			$errors[] = 'Sorry, the community \'' . $_POST['name'] . '\' already exists';
			
		}
	}
}


if (isset($_GET['c']) === true && empty($_GET['c']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Community Created</strong></div>');
}
	
	
if (empty($_POST) === false && isset($_POST['state']) && empty($errors) === true) {
	
	
		upload_image($session_admin_id, $_POST['name'], 'community', $file_temp, $file_extn);
		
		$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM pictures WHERE admin_id = '$session_admin_id'"));
			
		$data = array(
			'name' 		=> $_POST['name'],
			'state' 		=> $_POST['state'],
			'description' 		=> $_POST['description'],
			'color'		=> $_POST['color'],
			'picture' => $theid['id']
			
		);

		create_community($data);
		header('Location: creation.php?c');
		exit();
				
}else if (empty($errors) === false) {

	echo output_errors($errors);
}


?>


<form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
			
	  	  <div class="form-group">
	  	    <label for="name" class="col-xs-2 control-label">Community Name</label>
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
      <label for="state" class="col-xs-2 control-label">State</label>
      <div class="col-xs-6">
   	<select class = "form-control" id = "state" name="state">
			<option value="" selected="selected">Select a State</option> 
			<option value="AL">Alabama</option> 
			<option value="AK">Alaska</option> 
			<option value="AZ">Arizona</option> 
			<option value="AR">Arkansas</option> 
			<option value="CA">California</option> 
			<option value="CO">Colorado</option> 
			<option value="CT">Connecticut</option> 
			<option value="DE">Delaware</option> 
			<option value="DC">District Of Columbia</option> 
			<option value="FL">Florida</option> 
			<option value="GA">Georgia</option> 
			<option value="HI">Hawaii</option> 
			<option value="ID">Idaho</option> 
			<option value="IL">Illinois</option> 
			<option value="IN">Indiana</option> 
			<option value="IA">Iowa</option> 
			<option value="KS">Kansas</option> 
			<option value="KY">Kentucky</option> 
			<option value="LA">Louisiana</option> 
			<option value="ME">Maine</option> 
			<option value="MD">Maryland</option> 
			<option value="MA">Massachusetts</option> 
			<option value="MI">Michigan</option> 
			<option value="MN">Minnesota</option> 
			<option value="MS">Mississippi</option> 
			<option value="MO">Missouri</option> 
			<option value="MT">Montana</option> 
			<option value="NE">Nebraska</option> 
			<option value="NV">Nevada</option> 
			<option value="NH">New Hampshire</option> 
			<option value="NJ">New Jersey</option> 
			<option value="NM">New Mexico</option> 
			<option value="NY">New York</option> 
			<option value="NC">North Carolina</option> 
			<option value="ND">North Dakota</option> 
			<option value="OH">Ohio</option> 
			<option value="OK">Oklahoma</option> 
			<option value="OR">Oregon</option> 
			<option value="PA">Pennsylvania</option> 
			<option value="RI">Rhode Island</option> 
			<option value="SC">South Carolina</option> 
			<option value="SD">South Dakota</option> 
			<option value="TN">Tennessee</option> 
			<option value="TX">Texas</option> 
			<option value="UT">Utah</option> 
			<option value="VT">Vermont</option> 
			<option value="VA">Virginia</option> 
			<option value="WA">Washington</option> 
			<option value="WV">West Virginia</option> 
			<option value="WI">Wisconsin</option> 
			<option value="WY">Wyoming</option>
</select>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "update" class="btn btn-default">Submit</button>
    </div>	
    </div>
  </div>

</form>