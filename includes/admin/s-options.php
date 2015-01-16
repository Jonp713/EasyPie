<?php

if(isset($_GET['defranchise'])){	

	$community = $_GET['c'];
	$service = $_GET['service'];
	
	$service = sanitize($service);	
	$community = sanitize($community);	
	
	if(!has_moderator($service, $community)){
		
		mysql_query("DELETE FROM services WHERE community = '$community' AND name = '$service' AND core = 0");
	
		mysql_query("DELETE FROM subscriptions WHERE community_name = '$community' AND service = '$service'");
	
		mysql_query("UPDATE posts SET is_home = 0 WHERE site = '$community' AND service = '$service' AND status <> 2 AND status <> 3");	
	
		header('Location: admin.php?success=mod_quit');
		
		exit();
	
	}
	
}


protect_moderator($_GET['service'], $_GET['c'], $session_user_id);


if(isset($_POST['moderator_quit']) ){	

	$community = $_GET['c'];
	$service = $_GET['service'];
	
	$service = sanitize($service);	
	$community = sanitize($community);	
		
	mysql_query("DELETE FROM admins WHERE user_id = '$session_user_id' AND community_name = '$community' AND service_name = '$service' AND type = 'moderator'");
	
	if(has_moderator($service, $community)){
		
		header('Location: admin.php?success=mod_quit');
		exit();
		
		
	}else{
		
		header('Location: admin.php?service='.$_GET['service'].'&c='.$_GET['c'].'&p=Options&defranchise');
		exit();

	}
	
	
}


if(isset($_POST['deactivate_board']) ){	


	$community = $_GET['c'];
	$service = $_GET['service'];
	
	$service = sanitize($service);	
	$community = sanitize($community);	
	
	mysql_query("DELETE FROM admins WHERE community_name = '$community' AND service_name = '$service' AND type = 'moderator'");
		
	mysql_query("DELETE FROM services WHERE community = '$community' AND name = '$service' AND core = 0");
	
	mysql_query("DELETE FROM subscriptions WHERE community_name = '$community' AND service = '$service'");
	
	mysql_query("UPDATE posts SET is_home = 0 WHERE site = '$community' AND service = '$service' AND status <> 2 AND status <> 3");
	
	
	header('Location: admin.php?success=defranchise_board');
	exit();
	
}

if(isset($_POST['add_moderator']) ){
	
	$user_id = user_id_from_username($_POST['username']);
	
	if(!user_moderates_service($_GET['service'], $_GET['c'], $user_id)){
	
		$post_data = array(
			'community_name'	 	=> $_GET['c'],
			'service_name'			=> $_GET['service'],
			'user_id'				=> $user_id,
			'type'					=> 'moderator',
			'seconds'				=> time()
				
		);

		$success = create_mod($post_data);	
	
		header('Location: admin.php?service='.$_GET['service'].'&c='.$_GET['c'].'&success=add_mod&p=Options');
		exit();
	
	
	}else{
		
		header('Location: admin.php?service='.$_GET['service'].'&c='.$_GET['c'].'&success=already_mod&p=Options');
		exit();
		
		
	}

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

	  <button type="submit" name = "moderator_quit" data-toggle="tooltip" title="If you are the only moderator, this will also defranchise this board"  data-placement="bottom" value = "add" class="btn btn-danger">Quit</button>
	  
</form>
<br>
<form class = "form-horizontal" role="form" action="" method="post">  	

	  
	  <button type="submit" name = "deactivate_board" value = "add" class="btn btn-danger">Close Franchise</button>
	  
</form>


