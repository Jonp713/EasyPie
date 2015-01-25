
		<?php
		
		function addhttp($url) {
		    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
		        $url = "http://" . $url;
		    }
		    return $url;
		}
		
		
		if (empty($_POST) === false) {
			
			$_POST['url'] = addhttp($_POST['url']);
			
			$update_data = array(
				'url' => $_POST['url'],
				'name'	=> $_POST['link_name'],
				'description' => $_POST['desc'],
				'community'	=> $_GET['c'],
			);
			
			add_link($update_data);
			
			header('location: posts.php?c='.$_GET['c'].'&success=addlink');
			
			
		}
		
		?>
		
		
		 <h1>Add Link</h1>
		 
		  <form class = "form-horizontal" role="form" action="" method="post">
			  
			  
			  <div class="form-group">
				
				
	  		      <div class="col-xs-12">
					  <label >Link Name:</label>
	  				<input type = "text" class = "form-control" name="link_name" id = "link_name">
	  			</div>
			</div>
			
			  <div class="form-group">
				
				
	  		      <div class="col-xs-12">
					  <label >URL:</label>
	  				<input type = "text" class = "form-control" value = "http://" name="url" id = "url">
	  			</div>
			</div>
			
			  <div class="form-group">
				
				
	  		      <div class="col-xs-12">
					  <label >Description:</label>
	  				<input type = "text" class = "form-control" name="desc" id = "desc">
	  			</div>
			</div>
			
			
	    	  <div class="form-group col-xs-12">
			
	   	 <button type="submit" class="btn btn-info">SUBMIT</button><br>
		 
	 </div>
			
		</form>
		
	 

			
			