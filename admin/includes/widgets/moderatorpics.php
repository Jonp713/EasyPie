<h1>Moderator Pictures</h1>

<?php
if (isset($_FILES['pic']) === true) {
	if (empty($_FILES['pic']['name']) === true) {
		echo 'Please choose a file!';
	} else {
		$allowed = array('jpg', 'jpeg', 'gif', 'png');
		
		$file_name = $_FILES['pic']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['pic']['tmp_name'];
		
		if (in_array($file_extn, $allowed) === true) {
			
			if(check_admin_power($session_admin_id) > 0){
				
				upload_image($session_admin_id, $_POST['nickname'], 'moderator', $file_temp, $file_extn);
				
				header('Location: pics.php?s');
			
			}
						
			exit();
			
		} else {
			echo 'Incorrect file type. Allowed: ';
			echo implode(', ', $allowed);
		}
	}
}

?>

<form action="" method="post" enctype="multipart/form-data">
	Title:<input type="text" name = 'nickname'>
	<input type="file" name="pic"> <input type="submit">
</form>
<br><br>

<?php

$pics = get_pics('moderator', 0);

foreach ($pics as $currentpics) {
	
	echo ($currentpics['nickname']. '<br>');
	echo '<img width = "200px" height = "200px" src="../' . $currentpics['url'] . '"><br>';
	echo('<span id = "'.$currentpics['id'].'remove"><span onclick="remove_pic('.$currentpics['id'].')">Remove</span></span><br><br>');
	
}


?>
