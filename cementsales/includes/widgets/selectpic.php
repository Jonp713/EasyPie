<?php

moderator_protect_page();

?>

<h1 id = "moderator-picture">Moderator Picture</h1>

<?php

if(isset($_POST['update_pic'])){
	
	if(isset($_POST['pic_id']) == false){
	
		$errors_mp[] = "You must select a picture";
	
	}
}

if (isset($_GET['p']) === true && empty($_GET['p']) === true) {
	echo('<div class="alert alert-success" role="alert"><strong>Picture Changed</strong></div>');

}

if(empty($_POST) === false && empty($errors_mp) === true && isset($_POST['update_pic'])){
	
	if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
		
		$update_data = array(
			'profile' 				=> $_POST['pic_id'],
		);
	
		$success = update_admin(admin_id_from_codename($_GET['codename']), $update_data);
						
		header('Location: profile.php?codename='.$_GET['codename'].'&p#moderator-picture');
		
	}
	
				
	if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
		
		$codename = head_admin_codename_from_community_name($_GET['community']);
		$id = admin_id_from_codename($codename);
	
		$update_data = array(
			'profile' 				=> $_POST['pic_id'],
		);
	
		$success = update_admin($id, $update_data);
						
		header('Location: overview.php?community='.$_GET['community'].'&p#moderator-picture');

	}	
	
	if(isset($_GET['community']) === false && isset($_GET['codename']) === false){
		
		$update_data = array(
			'profile' 				=> $_POST['pic_id'],
		);
	
		$success = update_admin($admin_data['id'], $update_data);
							
		header('Location: me.php?p#moderator-picture');
					
	}
			
	exit();
	
} else if (empty($errors_mp) === false) {
	
	echo output_errors($errors_mp);
}

?>

<h3>Current Pic:</h3>

<?php
	
if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
		
	$url = get_mods_picurl(admin_id_from_codename($_GET['codename']));
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-5 col-sm-4 col-md-3">');
		
	echo '<img class="img-responsive col-xs-12" src="../' . $url . '"><br><br><hr>';
	
	echo('</span></span>');

}	

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	if(head_admin_id_from_community_name($_GET['community']) == null || head_admin_id_from_community_name($_GET['community']) < 0){
		
		echo('<div class="alert alert-danger" role="alert"><strong>No Head Moderator!</strong></div>');
		
		exit();
	
	}else{
		
		$codename = head_admin_codename_from_community_name($_GET['community']);
		$id = admin_id_from_codename($codename);
	
		$url = get_mods_picurl($id);
	
		echo('<span class = "row">');
		echo('<span class = "well well-sm col-xs-5 col-sm-4 col-md-3">');
		
		echo '<img class="img-responsive col-xs-12" src="../' . $url . '"><br><br><hr>';
	
		echo('</span></span>');
		
	}

}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){
	
	$url = get_mods_picurl($admin_data['id']);

	echo '<img width = "200px" height = "200px" src="../' . $url . '"><br><br><hr>';

}

	
?>

<h3>Select New:</h3>
<form action="" method="post" class="form-horizontal" role="form">
	
				<?php 
								
				$pics = get_pics('moderator', 0, 0);	
				
				foreach ($pics as $currentpic) {
					
					echo('<span class = "row">');
					echo('<span class = "well well-sm col-xs-5 col-sm-4 col-md-3">');
					
					echo('<h2><input type = "radio" name="pic_id" value = "'.$currentpic['id'].'"> ');
					echo ($currentpic['nickname']. '</h2><br>');
					echo '<img class="img-responsive col-xs-12" src="../' . $currentpic['url'] . '"><br><br><hr>';
					
					echo('</span></span>');
						
				}
				
				?>
			</select>

  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <button type = "submit" name = "update_pic" class="btn btn-primary">Update</button>
    </div>
    </div>
  </div>

</form>
				