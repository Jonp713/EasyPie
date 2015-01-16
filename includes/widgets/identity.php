<?php

if (empty($_POST) === false) {
	
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'identity_update');

	if(!$session_local and $count >= 3){
    $privatekey = "6LcXHfYSAAAAANnTCLXRiag_cz0BijZII2_ysboN";
     $resp = recaptcha_check_answer ($privatekey,
                                   $_SERVER["REMOTE_ADDR"],
                                   $_POST["recaptcha_challenge_field"],
                                   $_POST["recaptcha_response_field"]);

     if (!$resp->is_valid) {
       // What happens when the CAPTCHA was entered incorrectly
	   	//$errors[] = $resp->error;
		$errors[] = '<p class = "form_error">Incorrect Captcha</p>';
     }
 
 	}
	
	if (preg_match("/\\s/", $_POST['first_name']) == true || preg_match("/\\s/", $_POST['last_name']) == true) {
		$errors[] = 'Your names must not contain any spaces.';
	}
	
	
}


?>
<h1>My Identity</h1>

<?php

if (empty($_POST) === false && empty($errors) === true) {
	
		$update_data = array(
			'first_name' => $_POST['first_name'],
			'last_name'	=> $_POST['last_name'],
		);
		
		if(isset($_POST['is_image']) && $_POST['is_image'] == "checked"){
		
			$servicename = $_POST['service'];
				
			if (empty($_FILES['pic']['name']) == true) {
	
				$errors[] = 'Please choose a file!';
	
			}else{

				$allowed = array('jpg', 'jpeg', 'gif', 'png');
	
				$file_name = $_FILES['pic']['name'];
				$file_extn = strtolower(end(explode('.', $file_name)));
				$file_temp = $_FILES['pic']['tmp_name'];
	
				if (in_array($file_extn, $allowed) === true) {} else {
		
					$errors[] =  'Incorrect file type. Allowed: ' . implode(', ', $allowed);
		
				}
	
			}
		
			$username = $user_data['username'];
		
			$file_path = upload_image_user($username, 'user', $file_temp, $file_extn);
		
			$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM pictures WHERE nickname = '$username'"));
		
			$update_data['pic_id'] = $theid['id'];		
			$update_data['img_src'] = $file_path; 		
		}
		
		if (empty($_POST['first_name']) == false && empty($_POST['first_name']) == false){

			$update_data['has_identity'] = 1;
			
		}else{
			
			$update_data['has_identity'] = 0;
			
			echo("You must type in a first and a last name to use your identity");
			
		}
		update_user($session_user_id, $update_data);
		
	
	header('Location: identity.php?success=identity_updated');
	exit();
	
} else if (empty($errors) === false) {
	echo output_errors($errors);
}
	
?>

<form class = "form-horizontal" role="form" action="" method="post" enctype="multipart/form-data"> 
	Your identity is only seen when posting to certain boards. There will be a note at the top of the form if you are posting to such a board. This will not be seen by any other user outside of your post to that board.
	
	  <div class="form-group col-xs-12"><br>
  	    <label for="first_name">First Name:</label>
			<input id = "first_name" class = "form-control" type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>">
  	  </div>
 	  <div class="form-group col-xs-12">
 	    <label for="last_name">Last Name:</label>
		<input id = "last_name" class = "form-control" type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
 	  </div>
	  
	<?php if (!empty($user_data['img_src'])){
		
		echo('<div class = "form-group col-xs-12">');
		
		echo('<strong>Current Profile Photo:<strong><br>');
		
		echo('<img src = "'.$user_data['img_src'].'" class = "img-responsive col-xs-6 no-padding"></div>');
		
		?>
		
	 	<div class = "form-group col-xs-12">
			<br>
	      <label for="is_image"   class = "sf-Events-disable col-xs-3 control-label">Change Profile Photo:</label>
		
		
		<?php
		
		
	}else{ ?>
	  
 	<div class = "form-group">
      <label for="is_image"   class = "sf-Events-disable col-xs-3 control-label">Upload a Profile Photo:</label>
		
		
		<?php } ?>
		
	
		
	 	 <div class="col-xs-8">
		
	 		 <input onclick = "toggle_post_picture('identity')" type="checkbox" name = "is_image" value="checked">
	 
	 	 </div></div>
	
	  <div id = "post-pic-form-identity" class="form-group picture-disabled">
				
	 		     <label for="pic" class="col-xs-3 control-label">Profile Photo:</label>
	 			 <div class="col-xs-8">

	 		 <input class = "form-control" type="file" name="pic">

	 	</div></div>
		
		
		
  	  <div class="form-group">
		  
		  		<?php
			
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'identity_update');		
				
	if(!$session_local && $count >= 3){
	  	 
		echo('<div class="form-group">');
		
		echo("<br><strong>Captcha:</strong><br>");
		
		 
	   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
	   echo recaptcha_get_html($publickey);
	   
	   echo('<br>');
	   
	   echo('</div>');
	  			
	}
	

	?>

	  <button type="submit" class="btn btn-default">Update</button>

	</form>

