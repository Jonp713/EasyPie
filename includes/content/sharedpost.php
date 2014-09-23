<?php
	
	
if(empty($_GET['share']) == false){
	
	//$id = md5($_GET['share']);
	
	$id = $_GET['share'];

	
	mysql_query("SELECT * FROM posts WHERE id = '$id' LIMIT 1");
	
	?>
	
	
	<div class="modal fade" id="sharepostmodal" tabindex="-1" role="dialog" aria-labelledby="sharepostmodal" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	     
	      <div class="modal-body">
			  

			  <?php
								
	  			display_post($id, 'post', 'display_time', 'reply_share', 'save_post', 'flag');
				
			  ?>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	
	<?php
}

?>

