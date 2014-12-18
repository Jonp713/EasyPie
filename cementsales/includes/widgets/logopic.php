<?php

admin_protect_page();

?>

<h1 id = "moderator-picture">Character Logos</h1>

Choose which characters logo to change<br>
<?php


$names = mysql_query("SELECT * FROM characters ORDER BY ID DESC") or die(mysql_error());

while($number = mysql_fetch_assoc($names)){

		echo("<a href = 'logos.php?character=".$number['name']."'>".$number['name']."</a><br>");

	}
			
?>

<?php

if(isset($_POST['update_pic'])){
	
	if(isset($_POST['pic_id']) == false){
	
		$errors_mp[] = "You must select a picture";
	
	}
	
	
}


if(empty($_POST) === false && empty($errors_mp) === true && isset($_POST['update_pic'])){
	
	if(isset($_GET['character']) && check_admin_power($session_admin_id) > 0){
		
		$update_data = array(
			'pic_id' 				=> $_POST['pic_id'],
		);
	
		$success = update_character($update_data, $_GET['character']);
								
		header('Location: logos.php?character='.$_GET['character'].'&ls');
		
	}
	
		
	exit();
	
} else if (empty($errors_mp) === false) {
		
	echo output_errors($errors_mp);
}

?>

<h3>Current Pic:</h3>

<?php
	
if(isset($_GET['character']) && check_admin_power($session_admin_id) > 0){
		
	$url = get_logo_picture_url_from_character_name($_GET['character']);
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-5 col-sm-4 col-md-3">');
		
	echo '<img class="img-responsive col-xs-12" src="../' . $url . '"><br><br><hr>';
	
	echo('</span></span>');

}	

	
?>

<h3>Select New:</h3>
<form action="" method="post" class="form-horizontal" role="form">
	
				<?php 
								
				$pics = get_pics('service', 0, 1);	
				
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
				