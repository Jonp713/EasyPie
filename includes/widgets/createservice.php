<?php protect_page(); ?>


	<script type="text/javascript" src="jscolor/jscolor.js"></script>
	
	 <span class = "col-xs-12 col-sm-6 pull-right create-service-form">
	
	<?php 
	
	if (empty($_POST) === false) {
		
		if(empty($_POST['description']) || empty($_POST['board_name']) || empty($_POST['prompt'])){
			
			$errors[] = 'You gotta fill out at least some of the fields dude...';
			
		}



		if (preg_match('/[^a-zA-Z]+/', $_POST['board_name']))
		{
			$errors[] = "What kind of name is that? You can't have wierd characters in your board name";
		}
	

		$name = preg_replace('/\s+/', '', $_POST['board_name']);
	
		if(service_exists($name)){
		
			$errors[] = 'A board with that name already exists.';
			
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
	
		$home = get_home_from_user_id($session_user_id);
			

		$service_data1 = array(
			'name'			=> $name,
			'color'			=> '#' . $_POST['board_color'],
			'prompt'		=> $_POST['prompt'],
			'name_display'	=> $_POST['name_display'],
			'description'	=> $_POST['description'],
			'identity'		=> $_POST['identity'],
			'style'			=> $_POST['style'],
			'moderation'	=> $_POST['moderation'],
			'core'			=> 1,
			'seconds'		=> time()
					
		);
		$service_data2 = array(
			'community'	=> $home,
			'name'				=> $name,
			'seconds'			=> time(),
			'core'				=> 0,
					
		);
			
		if($_POST['inappropriate'] == 'on'){
	
			$service_data1['inappropriate'] = 1;
	
		}
		
		if($_POST['time_oriented'] == 'yes'){
	
			$service_data1['is_event'] = 1;
	
		}
		
		if($_POST['for_memes'] == 'yes'){
	
			$service_data1['for_memes'] = 1;
	
		}
		
		if($_POST['title_on'] == 'on'){
	
			$service_data1['title_on'] = 1;
	
		}

		if($_POST['comments_on'] == 'on'){
	
			$service_data1['comments_on'] = 1;
	
		}
	
		
		if($_POST['private_on'] == 'on'){
	
			$service_data1['private_on'] = 1;
	
		}
		if($_POST['images_on'] == 'on'){
	
			$service_data1['images_on'] = 1;
	
		}
		if($_POST['videos_on'] == 'on'){
	
			$service_data1['videos_on'] = 1;
	
		}
		if($_POST['websites_on'] == 'on'){
	
			$service_data1['websites_on'] = 1;
	
		}
		if($_POST['ratings_on'] == 'on'){
	
			$service_data1['ratings_on'] = 1;
	
		}
		
		if($_POST['share_on'] == 'on'){
	
			$service_data1['share_on'] = 1;
	
		}
		
		if($_POST['geo_lock'] == 'on'){
	
			$service_data1['geo_locked'] = 1;
	
		}else{
			
			$service_data1['geo_locked'] = 0;
			
		}
		
		if($_POST['blur_on'] == 'on'){
	
			$service_data1['blur_on'] = 1;
	
		}else{
			
			$service_data1['blur_on'] = 0;
			
		}
		
		
		$character_data = array(
			'name'	 		=> $_POST['character_name'],
			
		);
	
		$quote_data = array(
			'text'	=> $_POST['first_quote'],
			'community_name'	 => $home,

		);
		
		$admin_data1 = array(
			'user_id'	 	=> $session_user_id,
			'type'			=> 'owner',
			'seconds'		=> time(),
			'service_name'	=> $name,
			'community_name'=> $home,

		);
		
		$admin_data2 = array(
			'user_id'	 	=> $session_user_id,
			'type'			=> 'moderator',
			'seconds'		=> time(),
			'service_name'	=> $name,
			'community_name'=> $home,
		
		);
	
		$service_data1['char_type'] = $_POST['char_type'];
	
		if($_POST['char_type'] == "character_image" && !empty($_FILES['pic_char']['name'])){
								
			if (empty($_FILES['pic_char']['name']) == true) {
	
				$errors[] = 'Please choose a file!';
	
			}else{

				$allowed = array('jpg', 'jpeg', 'png');
		
				$file_name = $_FILES['pic_char']['name'];
				$file_extn = strtolower(end(explode('.', $file_name)));
				$file_temp = $_FILES['pic_char']['tmp_name'];
	
				if (in_array($file_extn, $allowed) === true) {} else {
		
					$errors[] =  'Incorrect file type for logo. Allowed: ' . implode(', ', $allowed);
		
				}
	
			}
			
			if(empty($errors)){
					
				$file_path = upload_image_characters($name, $file_temp, $file_extn, $session_user_id);
			
				$name = sanitize($name);
			
				$theid = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM pictures WHERE nickname = '$name'"));
			
				$character_data['pic_id'] = $theid['id'];
			
			}
		
		}
		
		if(empty($errors)){
		
			create_character($character_data);
			
			$charname = $_POST['character_name'];
			
			$charname = sanitize($charname);
			
			$character_id = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM characters WHERE name = '$charname'"));
				
			$quote_data['character_id'] = $character_id['id'];
			$service_data1['character_id'] = $character_id['id'];
		
			create_mod($admin_data1);
			create_mod($admin_data2);
		
			create_service($service_data1);
		
			$name = sanitize($name);
		
			$servename = $name;
			
			$service_id = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id FROM services WHERE name = '$servename' AND core = 1"));
		
			$quote_data['service_id'] = $service_id['id'];
		
			add_service($service_data2);
		
			add_quote($quote_data);
			
			$session_user_id = sanitize($session_user_id);
			
			mysql_query("UPDATE `users` SET `admin` = 1 WHERE `user_id` = '$session_user_id'");
		
			header('Location: admin.php?success=board');
	
			exit();
	
		}else if (empty($errors) === false) {
			
			echo('<br>'. output_errors($errors));
			
		}
	
	}else if (empty($errors) === false) {

		echo('<br>'. output_errors($errors));
	}
	
	?>
		

		 <h3>Create a board</h3>You will create a new board and define what types of content users can post. You will be responsible for moderating this board within your home habbitat. Your board will appear in the "Open a pre-existing board" panel for any other user to add it to their home habbitat.<br><br>
		 
		 <span class = "form-note col-xs-12">
		 	<strong>Board ideas you should use!</strong><br>
			Satire news -  
			Compliments - 
			Crushes - 
			Missed Connections -  
			Confessions - 
			Personals - 
			Humans Of - 
			Work Showcase - 
			News - 
			Nudes - 
			Things to do in the area - 
			Overheard - 
			Ideas/Wishes - 
			Lost and Found - 
			Free Food - 
			Discussion/Arguments - 
			Announcements - 
			Jokes - 
			Poems - 
			Job postings - 
			Memes - 
			Events -
			Recipes -
			Fashion - 
			Historical Photos - 
			Photos of whats happening on the weekend! - 
			Ride sharing - 
			Couch sharing - 
			Stories/Lore - 
			Milkshake Reviews - 
			Questions -
			College Bucket list -
			Freshman tips -
			And think of your own!
			<br>
		 </span>
		 		 
 		<hr class = "messagehr col-xs-11"><br>
		 
		 
		  <form class = "form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
			  
			  
			  <div class="form-group">
				
				
	  		      <div class="col-xs-12">
					  <label >Board Name:</label>
	  				<input type = "text" class = "form-control" placeholder = "What is the name of your board?" name="board_name" id = "board_name">
	  			</div>
			</div>
			
			<strong>Name Display: (In the top left corner)</strong><br>

			<div class="radio">
			  <label>
			    <input type="radio" name="name_display" id="optionsRadios4" value="comser" checked>
			  	Community first - ex. HAMPY<strong>BONE</strong>
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="name_display" id="optionsRadios5" value="sercom">
			  	Board First - ex. <strong>ICU</strong>HAMPY
			  </label>
			</div><br>
				
	  			<div class="form-group">
				
			  		      <div class="col-xs-12">
							  <label>Board Description:</label>
			  				<textarea class = "form-control" placeholder = "This will pop-up in the navigation to give a user a description of your board before they decide to click on it. It should describe what they about to see." name="description" id = "description" ></textarea>
			  				</div>
			  			</div>
				
	  			<div class="form-group">
				
			  		      <div class="col-xs-12">
							  <label >Board Prompt:</label>
			  				<textarea class = "form-control" placeholder = "This will appear before people submit to your board, it should help them form their post. Writing an example post is a good idea if possible." name="prompt" id = "prompt" ></textarea>
			  				</div>
			  			</div>
						
			  			<div class="form-group">
						
				  		      <div class="col-xs-12">
								  <label >Board Color:</label> (This should match a color in your character logo! If you have one...)
				  				<input type = "text" class = "form-control color" name="board_color" id = "board_color">
				  			</div>
						</div>
						<br>			<hr class = "messagehr"><br>
						
						
					   	<div class = "form-group">
					        <label for="is_image"   class = "sf-Events-disable col-xs-3 control-label">Don't use an Icon</label>
	
					 		 <div class="col-xs-8">

					 		 <input onclick = "toggle_create_service_logo('off')" name = "char_type" id="optionsRadios7" type="radio" value="character_text" checked>&nbsp;&nbsp;&nbsp;&nbsp;(Your logo will be the first letter of your boards name)

					 	  </div>
						</div>
			
							   	<div class = "form-group">
							        <label for="is_image" class = "col-xs-3 control-label">Use an Icon  </label>
	
							   	 <div class="col-xs-8">
	
							   		 <input id="optionsRadios8" onclick = "toggle_create_service_logo('on')" type="radio" name = "char_type" value="character_image" >&nbsp;&nbsp;&nbsp;&nbsp;(You can upload a photo for your logo) <a style = "color:blue"  target = "_blank" href = "https://www.fiverr.com/search/gigs?utf8=%E2%9C%93&search_in=everywhere&query=logo&page=1&layout=auto">Get a $5 Logo</a> - <a href = "https://www.fiverr.com/foxsquare" style = "color:blue"  target = "_blank">I recommend this guy</a>
 
					   	 </div></div><br>
						 
			 		    <div class="form-group character-forms">
	
			 		   		     <label for="pic" class="col-xs-3 logo_pic control-label">Logo:</label>
			 		   			 <div class="col-xs-8">

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
						<strong>Type:</strong><br>Is your board time oriented? Does it regard events or things that happen at certain times? Does it involve clocks, or jack in the boxes?

						<div class="radio">
						  <label class = "radio-inline">
						    <input type="radio" name="time_oriented" id="optionsRadios13" value="yes">
						  	 Yes (Your boards form will include start time/date, end time/date, recurring options and a location field. The posts will be sorted by start time on your boards page)
						  </label>
						  
						</div>
						<div class="radio">
						  <label class = "radio-inline">
						    <input type="radio" name="time_oriented" id="optionsRadios15" value="no" checked>
						  	 No 
						  </label>
						</div>
						<br>Is your board for Memes? You know...those pictures things?
												<div class="radio">
												  <label class = "radio-inline">
												    <input type="radio" name="for_memes" id="optionsRadios13" value="yes">
												  	 Yes (A top line field and a bottom line field will be added. Images will be allowed for upload whether or not you check it below. You will be responsible for curating a memebase, a collection of meme templates for others to use)
												  </label>
						  
												</div>
												<div class="radio">
												  <label class = "radio-inline">
												    <input type="radio" name="for_memes" id="optionsRadios15" value="no" checked>
												  	 No 
												  </label>
												</div>
												<br>
						<hr class = "messagehr"><br>
						
		 			
			<strong>Title:</strong> 
			<div class="checkbox">
		  	  	<label> <input type="checkbox" name="title_on">Posts have a title</label>
		  	</div><br>
						
		<strong>Content:</strong><br>What type of content do you want to allow your users to submit? A text field is always included

  			    <div class="checkbox">
  			      <label>  	<input type="checkbox" name="images_on">Images
  			      </label>
  			    </div>
  			    <div class="checkbox">
  			      <label>
  			 		 <input type="checkbox" name="websites_on">Website Links
  			      </label>
  			    </div>
  			    <div class="checkbox">
  			      <label>
  			 		 <input type="checkbox" name="videos_on">Video Links
  			      </label>
  			    </div>
									
<br>

<strong>Style:</strong><br>How is your media positioned on the post? (Only for Videos and Images) (Does not affect Memes, which are automatically After)

<div class="radio">
  <label>
    <input type="radio" name="style" id="optionsRadios1" value="media_after" checked>
  	 After - Media appears after the post
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="style" id="optionsRadios2" value="media_corner">
  	 Corner - Media appears in the corner of the post (Only Images)
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="style" id="optionsRadios3" value="media_featured">
   	Featured - Media appears at the top of the post
  </label>
</div><br>

						
			<strong>Features:</strong><br>What can other users do with the content submitted?

			  			    <div class="checkbox">
			  			      <label>  			 		 <input type="checkbox" name="comments_on" checked>Comment on posts
			  			      </label>
			  			    </div>
			  			    <!--<div class="checkbox">
			  			      <label>  			 		 <input type="checkbox" name="2comments_on">Comment on comments
			  			      </label>
			  			    </div>-->
			  			    <div class="checkbox">
			  			      <label>
			  			 		 <input type="checkbox" name="private_on">Send Private Messages
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
    <input type="radio" name="identity" id="optionsRadios4" value="anonymous" checked>
  	Anonymous - No username or identity appears
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="identity" id="optionsRadios5" value="identity">
  	Identity - Show users first and last name and their picture (User will be required to have entered their identity to post)
  </label>
</div><br>
			 
			 
			 
			 <strong>Moderation:</strong><br>

			 <div class="radio">
			   <label>
			     <input type="radio" name="moderation" id="optionsRadios10" value="whatever_mod" checked>
			   Post can be seen without being approved

			   </label>
			 </div>
			 <div class="radio">
			   <label>
			     <input type="radio" name="moderation" id="optionsRadios9" value="strict_mod">
  				 Posts cannot be seen without being approved
			   
			   </label>
			 </div><br>
			 
			 
			 <hr class = "messagehr"><br>
			 <strong>Security:</strong><br>

 		    <div class="checkbox">
 		      <label>
 		 		 <input type="checkbox" name="geo_lock">Geo-lock my board (Prevents users from accessing unless within a certain mile radius of your community, affects load time)  <i class = "form-note"> Your posts will not be allowed on the community home page </i>
	      </label>
 		      </label>
 		    </div>
			 
  		    <div class="checkbox">
  		      <label>
  		 		 <input type="checkbox" name="blur_on">Prevent saving/screenshotting (Will add a removeable blur over your images and text)  <i class = "form-note"> Your posts will not be allowed on the community home page </i>
	      </label>
  		      </label>
  		    </div>
			
  		    <div class="checkbox">
  		      <label>
  		 		 <input type="checkbox" name="share_on" checked>Allow users to share posts from this board
  		      </label>
  		    </div>
  			 
  			 <br><br>
			 
 		    <div class="checkbox">
 		      <label>
 		 		 <input type="checkbox" name="inappropriate">The content of my board could be considered inappropriate.
 		      </label>
 		    </div>
			 <br>
			 <span class = "alert-warning alert">Hey! Just so you know, we reserve the right to delete your board for any reason at any time. Also, make sure to remember you are responsible for everything that gets posted onto your board! ALSO, we reserve the right to use your boards logo anywhere on the website or on an advertisement.</span>
			 
			 <br>
			 <button type="submit" class=" btn btn-info">SUBMIT</button></form><br></span>