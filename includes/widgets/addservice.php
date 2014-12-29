	 <span class = "col-xs-12 col-sm-5 add-service-form">
		
		
		<?php
				
			if(!empty($_GET['c']) && !empty($_GET['new'])){	
												
				if(service_exists_in_community($_GET['new'], $_GET['c'])){
				
					$errors_a[] = 'That board is already in your community.';
				
				}
									
				if(empty($errors_a) === true){	
					
				
						$post_data = array(
							'community_name'	 		=> $_GET['c'],
							'service_name'			=> $_GET['new'],
							'user_id'	=> $session_user_id,
							'type'		=> 'moderator',
							'seconds'			=> time()
									
						);
				
						$post_data2 = array(
							'community'	 		=> $_GET['c'],
							'name'			=> $_GET['new'],
							'core'			=> 0,
							'seconds'			=> time()
							
				
						);
	
	
					$success = create_mod($post_data);
					$success2 = add_service($post_data2);
					
					mysql_query("UPDATE `users` SET `admin` = 1 WHERE `user_id` = '$session_user_id'");
					
		
						header('Location: admin.php?a');
						exit();
					
				}else{
					
					echo('<br>'. output_errors($errors_a));
					
				}
			
					
			}
			
		
			
			?>
		
		 <h3>Add an existing board</h3>By adding this board, you will be responsible for moderating all of its posts within your home community.<i> You can only add boards to your home community.</i><br>
		 
				  
				  <?php
				  
	  			echo("<span class = 'row'>");
				  
				$home = get_home_from_user_id($session_user_id);
				  
			  	$services = get_services($home, 2);

			  	foreach ($services as $currentservice){
			
		  			echo("<span class = 'col-xs-12 col-sm-5 add-service-button'>");
							
			   		 $color = get_service_color_from_service_name($currentservice['name']);
					 $url =  get_logo_picture_url_from_service_name($currentservice['name']);
					 
					 $link = "createservice.php?new=".$currentservice['name']."&c=".$home;
					 
	  		 		
		 			echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['name'].'-container">');
		
		 			echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-12">');
			
					$newcolor = hex2rgb($color);
			
			
					echo('<span style = "background-color:rgba('.implode($newcolor,',').', .6);" class = "service-logo-circle col-xs-2 no-padding pull-left"></span>');
			
			
					if(get_service_char_type($currentservice['name']) == "character_image" && !empty($url)){
	
						echo('<img class = "service-logo col-xs-2 no-padding pull-left" src = "'.$url.'">');
	
					}else if(get_service_char_type($currentservice['name']) == "character_text"){
	
						echo('<span class = "service-logo-text2 col-xs-2 no-padding pull-left">'. strtoupper($currentservice['name'][0]).'</span>');
	
					}
				
		 			echo('<span class = "service-list-name2"><span class = "service-name-sub blackfont ">'.strtoupper($currentservice['name']).'</span></span></a>');
						
					
		  			echo('</span>');
					
					echo('<span class = "">'.$currentservice['description'].'</span>');
					
						
					echo('</span>');
					
					
	

			  	}
	  			echo('</span>');
				  
				  
				?>
				<br>  </span>
		 
