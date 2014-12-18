<?php
	
//ICU	

if($service_in == 'ICU'){

	echo('<span id = "sf-ICU" data-active = "active">');

}else{
	
   echo('<span id = "sf-ICU" data-active = "notactive">');
   
}
	
?>

				<div class="form-group">
				
			    <input type="text" id = "sf-ICU-service" value = "ICU" name = "service" hidden>
				
				
		      <div class="col-xs-12">
				<textarea placeholder = "ICU..." name="post" class = "form-control" id = "sf-ICU-textarea"></textarea>
				</div>
			</div>
		
			<?php if(logged_in() === true){ ?>
									

			    <div class="checkbox">
			      <label data-container="body" data-toggle="popover" data-placement="left" data-content="
Users can anonymously send you messages by clicking reply. They cannot see your username.
">
			 		 <input type="checkbox" name="reply_on" checked = 'checked'>I want replies
			      </label>
			    </div>
						
			
			<?php }else{?>
				
				<div class="checkbox disabled">
				  <label>
				    <input type="checkbox" value="" disabled>
					I want replies
				  </label>
				</div>
				
	You must <a href = 'login.php'>login</a> or <a href = 'register.php'>register</a> to recieve private replies
	
	
<?php } ?>

			    <div class="checkbox">
			      <label>
			 		 <input type="checkbox" id = "sf-ICU-comments" name="comments_on">Allow comments
			      </label>
			    </div>	
		
	</span>
	
	

<?php

//BONE
	
if($service_in == 'Bone'){

	echo('<span id = "sf-Bone" data-active = "active">');

}else{
	
   echo('<span id = "sf-Bone" data-active = "notactive">');
   
}
	
?>

			<?php if(logged_in() === true){ ?>

				<div class="form-group">
				
			    <input type="text" id = "sf-Bone-service"  value = "Bone" name = "service" hidden>
				<input type="checkbox" name="reply_on" checked = 'checked' hidden>	
				
				
				
		      <div class="col-xs-12">
				<textarea placeholder = "Will someone with a hot body make out with me NSA?" name="post" id = "sf-Bone-textarea" class = "form-control"></textarea>
				</div>
			</div>
						
						
		    <div class="checkbox">
		      <label>
		 		 <input type="checkbox" id = "sf-Bone-comments" name="comments_on">Allow comments
		      </label>
		    </div>
											
				
				<?php }else{
					
					?>
					
					You need to log in before you can post to Bone because Bone only works if people can reply to your posts.
					
					<?php }?>
			
		
	</span>		
	
	
	
	
	
	<?php

	//BONE
	
	if($service_in == 'Hole'){

		echo('<span id = "sf-Hole" data-active = "active">');

	}else{
	
	   echo('<span id = "sf-Hole" data-active = "notactive">');
   
	}
	
	?>


					<div class="form-group">
				
				    <input type="text" id = "sf-Hole-service" value = "Hole" name = "service" hidden>
								
			      <div class="col-xs-12">
					<textarea placeholder = "Post to the hole do not go through our moderation system" name="post" id = "sf-Hole-textarea" class = "form-control"></textarea>
					</div>
				</div>
				
				
				<div class = "form-group">
   			     <label for="is_image" class="col-xs-3 control-label">Use a picture:</label>
					
				 <div class="col-xs-8">
					
					 <input id = "is_image" onclick = "toggle_post_picture()" type="checkbox" name = "is_image" value="checked">
				 
				 </div></div>
				
			 <div id = "post-pic-form" class="form-group picture-disabled">
							
					     <label for="pic" class="col-xs-3 control-label">Picture:</label>
						 <div class="col-xs-8">
	
					 <input class = "form-control" type="file" id = "pic" name="pic">
	
				</div></div>
						
			
		
		</span>
	
	