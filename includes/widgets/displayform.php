<?php
	
//ICU	

if($service_in == 'ICU'){

	echo('<span id = "sf-ICU" data-active = "active">');

}else{
	
   echo('<span id = "sf-ICU" data-active = "notactive">');
   
}
	
?>

				<div class="form-group">
				
			    <input type="text" value = "ICU" name = "service" hidden>
				
				
		      <div class="col-sm-12">
				<textarea placeholder = "ICU..." name="post" class = "form-control"></textarea>
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
				
			    <input type="text" value = "Bone" name = "service" hidden>
				<input type="checkbox" name="reply_on" checked = 'checked' hidden>	
				
				
				
		      <div class="col-sm-12">
				<textarea placeholder = "Will someone with a hot body make out with me NSA?" name="post" class = "form-control"></textarea>
				</div>
			</div>
						
											
				
				<?php }else{
					
					?>
					
					You need to log in before you can post to Bone because Bone only works if people can reply to your posts.
					
					<?php }?>
			
		
	</span>		