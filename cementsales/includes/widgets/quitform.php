<?php

moderator_protect_page();

?>

<?php

if(empty($_POST) === false){
	
			
		$update_data = array(
			'status' 	=> 3,			
		);
	
		update_admin($session_admin_id, $update_data);
			
		header('Location: index.php');
		
		exit();
	
}

?>

<h1>Quitting</h1>

Are you sure you want to quit?

<form class="form-horizontal" role="form" action="" method="post">
	
	<div class="form-group">
   	 <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "quit" class="btn btn-default">Yes</button>
    </div>	
    </div>
  </div>
  
 </form>