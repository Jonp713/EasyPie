<?php
	
	
if(empty($_GET['share']) == false){
	
	
	?>
	
	
	<div class="modal fade" id="sharepostmodal" tabindex="-1" role="dialog" aria-labelledby="sharepostmodal" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	     
	      <div class="modal-body">
			  		  
			  <?php 	
			  
	    		$id = $_GET['share'];
				
				$id = sanitize($id);
	  
	  	  $data = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$id' LIMIT 1"));	
			  
			  //from header
			  $link = $data['id']; 
			  
			  ?>
			  
			  <span class = "col-xs-12">
				  				  
				  Share link:
				  			  
			  <input size="6" type = "text"  value = "<?php echo('https://icu.university/posts.php?c='.$data['site'].'&service='.$data['service'].'&share='.$link); ?>">
			   

<div class="pull-right fb-share-button" data-href="<?php echo('https://icu.university/posts.php?c='.$data['site'].'&service='.$data['service'].'&share='.$link); ?>">
</div>

<a href="https://twitter.com/share" class="pull-right twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>





<br>


</span>
<br>
			  <?php
				
				
			  /*
		  		if($currentpost['service'] == "ICU"){
			
		  			display_post($id, 'post', 'service', 'display_time','save_post', 'point_count', 'give_point', 'reply_share', 'comment_share');
			
		  		}
		  		if($currentpost['service'] == "Bone"){
		
		  			display_post($id, 'post', 'service', 'display_time', 'point_count', 'give_point', 'reply_share', 'comment_share');
		
		  		}
		
		*/
		  		if($currentpost['service'] == "Events"){
		
		  			display_post($id, 'title', 'location', 'start_time', 'post', 'service', 'reply_share', 'comment_share', 'point_count', 'give_point', 'image_corner', 'free_food', 'save_post', 'duration', 'start_time_full');
		
		  		}
				if($currentpost['service'] != "Events"){
		  			
					create_display_set($id, 'share', 'load');
					
		  		}
				
			  ?>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	
	<?php
}

?>

