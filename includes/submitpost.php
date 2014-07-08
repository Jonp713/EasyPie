<?php

if (empty($_POST) === false) {
			
	$required_fields = array('post');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'A post cannot be blank';
			break 1;
		}
	}
	if ((empty($_POST['email']) === false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)) {
		$errors[] = 'A valid email address is required';
	}
	
}

?>
<h1>Submit Post</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'Your post has been submitted';
	
} else {
		
	if (empty($_POST) === false && empty($errors) === true) {
	
	    $timestamp = date('g:i A \ \ D, M d, Y' , time());
					
		$post_data = array(
			'post'	 		=> $_POST['post'],
			'site'			=> $community_in,
			'display_time'	=> $timestamp,
			'second'		=> time()
		);
		
		if(logged_in() === true){
		
			if($_POST['reply_on'] == 'on'){
		
				$post_data['reply_on'] = 1;
			
			}	
			
			$post_data['user_id'] = $session_user_id;
			
		}else if(empty($_POST['email']) === false){
			
			$post_data['email'] = $_POST['email'];
			$post_data['reply_on'] = 1;
			
		}
		$success = submit_post($post_data);
		
		if($success){
			
			header('Location: posts.php?c='.$community_in.'&s');
			exit();
		
		}else{
			
			echo($success);
			
		}
		
	}else if (empty($errors) === false) {
	
		echo output_errors($errors);
	}
	
?>

	<form action="" method="post">
		<ul>
			
			<li>
				Post:<br>
				<input type="text" name="post">
			</li>
		
			<?php if(logged_in() === true){ ?>
			<li>
				Allow Private Reply:<br>
				<input type="checkbox" name="reply_on" checked = 'checked'>
			</li>
			
			<?php }else{?>
				
				<li>
					You must be logged in to get replies
				</li>
				
			<?php }?>
			
			<li>
				<input type="submit" value="Post">
			</li>
		</ul>
	</form>

<?php 
}