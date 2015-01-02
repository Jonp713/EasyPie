<?php

protect_moderator($_GET['service'], $_GET['c'], $session_user_id);


if(isset($_POST['moderator_quit']) ){	

	$community = $_GET['c'];
	$service = $_GET['service'];
		
	mysql_query("DELETE FROM admins WHERE user_id = '$session_user_id' AND community_name = '$community' AND service_name = '$service'") or die(mysql_error());
	
	header('Location: admin.php');
	
	
}


if(isset($_POST['deactivate_board']) ){	

	$community = $_GET['c'];
	$service = $_GET['service'];
		
	mysql_query("DELETE FROM services WHERE community = '$community' AND name = '$service' AND core = 0") or die(mysql_error());
	
	header('Location: admin.php');
	
	
}

if(isset($_POST['add_moderator']) ){
	
	$user_id = user_id_from_username($_POST['username']);
	
	$post_data = array(
		'community_name'	 	=> $_GET['c'],
		'service_name'			=> $_GET['service'],
		'user_id'				=> $user_id,
		'type'					=> 'moderator',
		'seconds'				=> time()
				
	);

	$success = create_mod($post_data);	
	
	echo('Moderator Added!');
}
?>

<span class = "whiteunderlay col-xs-12 no-padding">
	
	

	<span class = "col-xs-12 section-top"><strong>Add Moderator</strong></span><br>

<form class = "form-horizontal col-xs-12" style = "padding-bottom:15px" role="form" action="" method="post">  	

	  <div class="form-group col-xs-12">
  	    <label for="username">Username:</label>
			<input id = "username" class = "form-control" type="text" name="username">
  	  </div>
	  
	  
	  <button type="submit" name = "add_moderator" value = "add" class="btn btn-default">Add</button>
	  


</form>

</span>

<br>
<form class = "form-horizontal" role="form" action="" method="post">  	

	  
	  <button type="submit" name = "moderator_quit" value = "add" class="btn btn-danger">Quit</button>
	  


</form>
<br>
<form class = "form-horizontal" role="form" action="" method="post">  	

	  
	  <button type="submit" name = "deactivate_board" value = "add" class="btn btn-danger">Close Franchise</button>
	  
</form>


