	<script type="text/javascript" src="jscolor/jscolor.js"></script>
	
	 <span class = "col-xs-12 create-service-form">
	
	<?php 
	
	$service_name = $_GET['service'];
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM services WHERE name = '$service_name' AND core = 1"));
	
	if (empty($_POST) === false) {
			
		$required_fields = array('description, prompt, character_name');
		foreach($_POST as $key=>$value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[] = 'You gotta fill out at least some of the fields dude...';
				break 1;
			}
		}

	
	}
	
	
		
	if (empty($_POST) === false && empty($errors) === true) {
		
		
		/*
			
		//inappropriate - checked or not

		//moderation - whatever_mod, strict_mod

		//identity - anonymous, identity

		//comments_on
		//2comments_on
		//private_on

		//style - media_featured, media_corner, media_after

		//images_on - checked
		//websites_on - checked
		//videos_on - chekced

		//first_quote - text

		//pic_char - file

		//logo - character_image, character_text

		//character_name - text

		//board_color - text

		//prompt - text

		//description - text

		//board_name - text
		
		*/
								
		$service_data1 = array(
			'color'			=> '#' . $_POST['board_color'],
			'prompt'		=> $_POST['prompt'],
			'description'	=> $_POST['description'],
			'identity'		=> $_POST['identity'],
			'style'			=> $_POST['style'],
			'moderation'	=> $_POST['moderation'],
					
		);
		
		if($_POST['title_on'] == 'on'){
	
			$service_data1['title_on'] = 1;
	
		}else{
			
			$service_data1['title_on'] = 0;
			
		}
			
		if($_POST['inappropriate'] == 'on'){
	
			$service_data1['inappropriate'] = 1;
	
		}else{
			
			$service_data1['inappropriate'] = 0;
			
		}

		if($_POST['comments_on'] == 'on'){
	
			$service_data1['comments_on'] = 1;
	
		}else{
			
			$service_data1['comments_on'] = 0;
			
		}
	
		//if($_POST['2comments_on'] == 'on'){
	
		//	$service_data1['2comments_on'] = 1;
	
			//}
		
		if($_POST['private_on'] == 'on'){
	
			$service_data1['private_on'] = 1;
	
		}else{
			
			$service_data1['private_on'] = 0;
			
		}
		
		if($_POST['images_on'] == 'on'){
	
			$service_data1['images_on'] = 1;
	
		}else{
						
			$service_data1['images_on'] = 0;
			
		}
		
		
		if($_POST['videos_on'] == 'on'){
	
			$service_data1['videos_on'] = 1;
	
		}else{
			
			$service_data1['videos_on'] = 0;
			
			
		}
		if($_POST['websites_on'] == 'on'){
	
			$service_data1['websites_on'] = 1;
	
		}else{
			
			$service_data1['websites_on'] = 0;
			
		}
		
		//if($_POST['ratings_on'] == 'on'){
	
			//$service_data1['ratings_on'] = 1;
	
			//}
	
		$service_data1['char_type'] = $_POST['char_type'];
	
		if($_POST['char_type'] == "character_image" && !empty($_FILES['pic_char']['name'])){
								
			if (empty($_FILES['pic_char']['name']) == true) {
	
				$errors[] = 'Please choose a file!';
	
			}else{

				$allowed = array('png', 'jpg', 'jpeg');
	
				$file_name = $_FILES['pic_char']['name'];
				$file_extn = strtolower(end(explode('.', $file_name)));
				$file_temp = $_FILES['pic_char']['tmp_name'];
	
				if (in_array($file_extn, $allowed) === true) {} else {
		
					$errors[] =  'Incorrect file type for character picture. Allowed: ' . implode(', ', $allowed);
		
				}
	
			}
			
			$name = $data['name'];
		
			$file_path = upload_image_characters($data['name'], $file_temp, $file_extn, $session_user_id);
			
			$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM pictures WHERE nickname = '$name'"));
			
			$character_data['pic_id'] = $theid['id'];
			
			update_character_id($data['character_id'], $character_data);
		
		}
					
		update_service_id($data['id'], $service_data1);
		
		if(empty($errors) === true){
						
			//header('Location: admin.php?service='.$data['name']);
		
			//exit();
			
			echo('Service Updated!');

		}
		
		
	
	}else if (empty($errors) === false) {

		echo('<br>'. output_errors($errors));
	}
	
	$service_name = $_GET['service'];
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM services WHERE name = '$service_name' AND core = 1"));

	
	?>
		

		 <h3>Update Board</h3><br>
		 
		  <form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
				
	  			<div class="form-group">
				
			  		      <div class="col-xs-12">
							  <label>Board Description:</label>
			  				<textarea class = "form-control" placeholder = "This will pop-up in the navigation to give a user a description of your board before they decide to click on it. It should describe what they about to see." name="description" id = "description" ><?php echo($data['description']);?></textarea>
			  				</div>
			  			</div>
				
	  			<div class="form-group">
				
			  		      <div class="col-xs-12">
							  <label >Board Prompt:</label>
			  				<textarea class = "form-control" placeholder = "This will appear before people submit to your board, it should help them form their post. Writing an example post is a good idea if possible." name="prompt" id = "prompt" ><?php echo($data['prompt']);?></textarea>
			  				</div>
			  			</div>
						
			  			<div class="form-group">
						
				  		      <div class="col-xs-12">
								  <label >Board Color:</label> (This should match a color in your character logo! If you have one...)
				  				<input type = "text" class = "form-control color" name="board_color" id = "board_color" value = "<?php echo(substr($data['color'], 1));?>">
				  			</div>
						</div>
						<br>			<hr class = "messagehr"><br>
						
						
					   	<div class = "form-group">
					        <label for="is_image"   class = "sf-Events-disable col-xs-3 control-label">Don't use an Icon</label>
	
					 		 <div class="col-xs-8">

					 		 <input onclick = "toggle_create_service_logo('off')" name = "char_type" id="optionsRadios7" type="radio" value="character_text" <?php if($data['char_type'] == 'character_text'){ echo('checked'); }?>>&nbsp;&nbsp;&nbsp;&nbsp;(Your Icon will be the first letter of your boards name)

					 	  </div>
						</div>
			
							   	<div class = "form-group">
							        <label for="is_image" class = "col-xs-3 control-label">Use an Icon  </label>
	
							   	 <div class="col-xs-8">
	
							   		 <input id="optionsRadios8" onclick = "toggle_create_service_logo('on')" type="radio" name = "char_type" value="character_image" <?php if($data['char_type'] == 'character_image'){ echo('checked'); }?>>&nbsp;&nbsp;&nbsp;&nbsp;(You can upload a photo for your logo) <a target = "_blank" style = "color:blue" href = "https://www.fiverr.com/search/gigs?utf8=%E2%9C%93&search_in=everywhere&query=logo&page=1&layout=auto">Get a $5 Logo</a>
 
							   	 </div></div><br>
								 
								 <?php 
						 		$url = get_logo_picture_url_from_character_id($data['character_id']);	
								 
								 if(!empty($url)){
								 
								 	echo('<div class="form-group">');
								 								 									
								  }?>
 					 		  							  
							  
							 <?php if(empty($url)){
							 					
								 	echo('<div class="form-group character-forms col-xs-12 no-padding">');
									
									
 }?>
							  
								 
					 		   		     <label for="pic" class="col-xs-3 logo_pic control-label">Logo:</label>
										 
		 								 <?php 
								 
		 								 if(!empty($url)){
								 

								 
		 								 	echo('<img src = "'.$url.'" class = "col-xs-6 img-responsive">');
   					 		   		echo(' <div class="col-xs-6 col-xs-offset-3"><strong>Change Logo:</strong>');
											
									
		 								  }else{
		 								  	
											
		     					 		   		echo(' <div class="col-xs-6">');
											
		 								  }?>
										 

					 		   		 <input class = "form-control" type="file" name="pic_char">(Keep the dimensions 1:1, ex 400x400 or 1200x1200, PNG only)

					 		   	</div></div>
					 			<br>
								 
<!--
		
		  <div class="form-group character-forms">
			
			
	      <div class="col-xs-12">
			  <label >Character Name:</label>
			<input type = "text" class = "form-control" placeholder = "What is the name of your board's character? This is like the Owl for ICU, his name is NG" name="character_name" id = "description">
		</div>
	</div>
	



  			<div class="form-group character-forms">
			
		  		      <div class="col-xs-12">
						  <label>Character Quote:</label>
		  				<textarea class = "form-control" placeholder = "This is what will your character will say underneath its logo on the right hand side. You can add more of these later." name="first_quote"></textarea>
		  				</div>
		  			</div>
					<br>
								-->
		 
			
			<hr class = "messagehr"><br>
			<strong>Title:</strong> 
			<div class="checkbox">
		  	  	<label> <input type="checkbox" name="title_on" <?php if($data['title_on'] == 1){ echo('checked'); }?>>Posts have a title (Appears above the timestamp)</label>
		  	</div><br>
				
		<strong>Content:</strong><br>What type of content do you want to allow your users to submit? Text is always included

		  			    <div class="checkbox">
		  			      <label>  	<input type="checkbox" name="images_on" <?php if($data['images_on'] == 1){ echo('checked'); }?>>Images
		  			      </label>
		  			    </div>
		  			    <div class="checkbox">
		  			      <label>
		  			 		 <input type="checkbox" name="websites_on" <?php if($data['websites_on'] == 1){ echo('checked'); }?>>Website Links
		  			      </label>
		  			    </div>
		  			    <div class="checkbox">
		  			      <label>
		  			 		 <input type="checkbox" name="videos_on" <?php if($data['videos_on'] == 1){ echo('checked'); }?>>Video Links
		  			      </label>
		  			    </div>
									
<br>

<strong>Style:</strong><br>How is your media positioned on the post? (Only for Videos and Images)

<div class="radio">
  <label>
    <input type="radio" name="style" id="optionsRadios1" value="media_after" <?php if($data['style'] == 'media_after'){ echo('checked'); }?>>
  	 After - Media appears after the post
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="style" id="optionsRadios2" value="media_corner" <?php if($data['style'] == 'media_corner'){ echo('checked'); }?>>
  	 Corner - Media appears in the corner of the post (Only Images)
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="style" id="optionsRadios3" value="media_featured" <?php if($data['style'] == 'media_featured'){ echo('checked'); }?>>
   	Featured - Media appears at the top of the post
  </label>
</div><br>

						
			<strong>Features:</strong><br>What can other users do with the content submitted?

			  			    <div class="checkbox">
			  			      <label> 
								 <input type="checkbox" name="comments_on" <?php if($data['comments_on'] == 1){ echo('checked'); }?>>Comment on posts
			  			      </label>
			  			    </div>
			  			    <!--<div class="checkbox">
			  			      <label>  			 		 <input type="checkbox" name="2comments_on">Comment on comments
			  			      </label>
			  			    </div>-->
			  			    <div class="checkbox">
			  			      <label>
			  			 		 <input type="checkbox" name="private_on" <?php if($data['private_on'] == 1){ echo('checked'); }?>>Send Private Messages
			  			      </label>
			  			    </div>
			  			    <!--<div class="checkbox">
			  			      <label>
			  			 		 <input type="checkbox" name="ratings_on">4 - Star Ratings
			  			      </label>
			  			    </div>
							-->
							
							
							
<br>	<hr class = "messagehr"><br>


<strong>Identity:</strong><br>

<div class="radio">
  <label>
    <input type="radio" name="identity" id="optionsRadios4" value="anonymous" <?php if($data['identity'] == 'anonymous'){ echo('checked'); }?>>
  	Anonymous - No username or identity appears
  </label>
</div>

<div class="radio">
  <label>
    <input type="radio" name="identity" id="optionsRadios5" value="identity" <?php if($data['identity'] == 'identity'){ echo('checked'); }?>>
  	Identity - Show posters first and last name and their picture (User will be required to have entered their identity to post)
  </label>
</div><br>
			 
			 
			 
			 <strong>Moderation:</strong><br>

			 <div class="radio">
			   <label>
			     <input type="radio" name="moderation" id="optionsRadios10" value="whatever_mod" <?php if($data['moderation'] == 'whatever_mod'){ echo('checked'); }?>>
			   Post can be seen without being approved

			   </label>
			 </div>
			 <div class="radio">
			   <label>
			     <input type="radio" name="moderation" id="optionsRadios9" value="strict_mod" <?php if($data['moderation'] == 'strict_mod'){ echo('checked'); }?>>
  				 Posts cannot be seen without being approved
			   
			   </label>
			 </div><br>
			 
		    <div class="checkbox">
		      <label>
		 		 <input type="checkbox" name="inappropriate" <?php if($data['inappropriate'] == 1){ echo('checked'); }?>>The content of my board could be considered inappropriate.
		      </label>
		    </div>
			 <br>

			 
			 <button type="submit" class=" btn btn-info">UPDATE</button></form><br></span>