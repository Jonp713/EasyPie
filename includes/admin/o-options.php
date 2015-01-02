<?php

if(isset($_POST['transfer_ownership']) ){	

	$service = $_GET['service'];
		
	mysql_query("DELETE FROM admins WHERE user_id = '$session_user_id' AND service_name = '$service' AND type = 'owner'");
	
	$user_id = user_id_from_username($_POST['username']);
	
	$home = get_home_from_user_id($user_id);
	
	$post_data = array(
		'community_name'	 	=> $home,
		'service_name'			=> $_GET['service'],
		'user_id'				=> $user_id,
		'type'					=> 'owner',
		'seconds'				=> time()
				
	);

	$success = create_mod($post_data);	
	
	header('Location: admin.php');
	
}


if(isset($_POST['deactivate_service']) ){	

	$service = $_GET['service'];
		
	mysql_query("DELETE FROM services WHERE name = '$service'") or die(mysql_error());
	
	header('Location: admin.php');
	
	
}

?>

<span class = "whiteunderlay col-xs-12 no-padding">
	
<span class = "col-xs-12 section-top"><strong>Transfer Ownership</strong></span><br>

<form class = "form-horizontal col-xs-12" style = "padding-bottom:15px" role="form" action="" method="post">  	

	  <div class="form-group col-xs-12">
  	    <label for="username">Username:</label>
			<input id = "username" class = "form-control" type="text" name="username">
  	  </div>
	  
	  <button type="submit" data-toggle="tooltip" title="WARNING! You will no longer own this service"  data-placement="bottom" name = "transfer_ownership" value = "add" class="btn btn-default">TRANSFER</button>
	  
</form>

</span>

<br>
<form class = "form-horizontal" role="form" action="" method="post">  	

	  
	  <button data-toggle="tooltip" title="WARNING! This will remove every instance of this board from every community"  data-placement="bottom" type="submit" name = "deactivate_service" value = "add" class="btn btn-danger">DEACTIVATE BOARD</button>
	  
</form>


