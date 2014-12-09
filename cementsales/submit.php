<?php

include 'core/init.php';
admin_protect_page();

include 'includes/overall/header.php';


?>


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

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true && (empty($errors) === false)) {
	
	
}
		
if (empty($_POST) === false && empty($errors) === true) {
	
	$daysecs = $_POST['days'] * 86400;
	$hoursecs = $_POST['hours'] * 3600;
	$minutesecs = $_POST['minutes'] * 60;
	
	$seconds = time() + $daysecs + $hoursecs + $minutesecs;

    $timestamp = date('g:i A \ \ D, M d, Y' , $seconds);	
		
	$post_data = array(
		'post'	 		=> $_POST['post'],
		'site'			=> $_POST['community'],
		'display_time'	=> $timestamp,
		'second'		=> $seconds
	);
			
	if($_POST['reply_on'] == 'on'){

		$post_data['reply_on'] = 1;
	
	}	
	
	$post_data['user_id'] = 1;
		
	$success = submit_post($post_data);
	
	if($success){
		
		if(empty($errors) === true){
						
			header('Location: submit.php?c='.$community_in.'&s');
		
			exit();
	
	
		}
		
	}else{
		
		echo($success);
		
	}
	
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>

		  <form class = "submit_post form-horizontal" role="form" action="" method="post">


	    <div class="form-group">
	      <div class="col-sm-12">
			<textarea placeholder = "ICU..." name="post" class = "form-control"></textarea>
			</div>
		</div>
				
	    
		<div class="form-group">
	      <div class="col-sm-4">
			Days from now:<input type= "text" name="days" class = "form-control">
			</div>

	      <div class="col-sm-4">
			Hours from now:<input type= "text" name="hours" class = "form-control">
			</div>

	      <div class="col-sm-4">
			Minutes from now:<input type= "text" name="minutes" class = "form-control">
			</div>
		</div>				

	    <div class="checkbox">
	      <label data-container="body" data-toggle="popover" data-placement="left" data-content="
Users can anonymously send you messages by clicking reply. They cannot see your username.
">
	 		 <input type="checkbox" name="reply_on" checked = 'checked'>I want replies
	      </label>
	    </div>
				
		<?php
							
		echo('
	   	 	<div class="form-group">
	   	 	<div class="col-sm-12">
		
		');
		
		echo('<br>Which community are you posting to?: <select class = "form-control" name = "community">');
		
		$communities = get_communities(0, '');

		foreach ($communities as $currentcommunity){

			echo('<option value = "' . $currentcommunity['name'] . '">'. $currentcommunity['name']  .'</option>');

		}
		
		echo('</select></div></div>');							


		?>
    
        <button type="submit" class="btn btn-info">Submit</button>
		
		</form>

</span>

<br>


<?php
	
include 'includes/overall/footer.php'; 

?>

	
