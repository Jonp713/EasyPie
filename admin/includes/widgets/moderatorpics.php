<h1>Moderator Pictures</h1>

<?php

if (empty($_POST) == false) {
		
	if (empty($_FILES['pic']['name']) == true) {
		
		$errors_p[] = 'Please choose a file!';
		
	}else{
	
		$allowed = array('jpg', 'jpeg', 'gif', 'png');
		
		$file_name = $_FILES['pic']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['pic']['tmp_name'];
		
		if (in_array($file_extn, $allowed) === true) {} else {
			
			$errors_p[] =  'Incorrect file type. Allowed: ' . implode(', ', $allowed);
			
		}
		
	}
}

if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Moderator Picture Uploaded</strong></div>');
	
}

if (isset($_FILES['pic']) === true && empty($errors_p)){

			
	if(check_admin_power($session_admin_id) > 0){
		
		upload_image($session_admin_id, $_POST['nickname'], 'moderator', $file_temp, $file_extn);
		
		header('Location: pics.php?s');
		exit();
		
	
	}		
		
}else if (empty($errors_p) === false) {
	
	echo output_errors($errors_p);
}
			
		

?>

	<br><br><h2>Upload New</h2>

<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
	
	
    <div class="form-group">
      <label for="nickname" class="col-xs-2 control-label">Title:</label>
      <div class="col-xs-6">
   	<input class = "form-control" id = "nickname" type="text" name = 'nickname'>
	</div>
</div>
	
	
 <div class="form-group">
	     <label for="pic" class="col-xs-2 control-label">Picture:</label>
 <div class="col-xs-6">
	
<input class = "form-control" type="file" id = "pic" name="pic">
	
</div></div>
	
  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "update" class="btn btn-default">Upload</button>
    </div>	
    </div>
  </div>
</form>
<br><br>

<h2>All Pics</h2>

<?php

$pics = get_pics('moderator', 0);

foreach ($pics as $currentpics) {
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-5 col-sm-4 col-md-3">');
	
	echo('<h3>'.$currentpics['nickname'].'</h3>');
	
	echo '<img class="img-responsive col-xs-12" src="../' . $currentpics['url'] . '"><br><br>';
	echo('<br><span id = "'.$currentpics['id'].'remove"><span onclick="remove_pic('.$currentpics['id'].')"><button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Pic</button></span></span>');
	
	echo('</span></span>');
	
}


?>
