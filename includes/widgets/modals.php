<!-- Modal -->
<span class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Submit A Post</h4>
      </div>
      <div class="modal-body">
		  
		  <?php include 'submitservices.php'; ?>
	
		  <form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
			  
			<!--
  			<div class="panel-group" id="accordion">
  			  <div class="panel panel-default">
  			    <div class="panel-heading">
  			      <h4 class="panel-title">
  			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
  			          Moderation Policy
  			        </a>
  			      </h4>
  			    </div>
  			    <div id="collapseOne" class="panel-collapse collapse">
  			      <div class="panel-body">
			

  			 A post won’t be published if :<br><br>

  			 It includes a person’s name<br>

  			 It contains threats of suicide or self harm<br>

  			 It contains threats of violence<br>

  			 It is predatory<br>

  			 It is a solicitation of sex<br>

  			 It is a direct reply to another post<br>

  			 It is an ad<br>

  			 It includes racial slurs<br><br>
			 
			 
  			 <span class = "modpolicylegal">The posts on ICU do not reflect the views of ICU-5 Connections, LLC, or that of the moderators.</span><br><br>
			 		 	
  			      </div>
  			    </div>
  			  </div>
  			</div>
				-->
		<span class = "service-form-part">
			
<?php include 'displayform.php'; ?>
			
		</span>
				
			<?php
			
			if(empty($_GET['c'])){
				
				
				echo('
			   	 	<div class="form-group">
			   	 	<div class="col-sm-6">
				
				');
				
				echo('<br>Which community are you posting to?: <select value = "Hampy" class = "form-control" name = "community">');
				
				$communities = get_subscriptions(2, $session_user_id, '');
				
				echo(count($communities));

				foreach ($communities as $currentcommunity){

					echo('<option value = "' . $currentcommunity['name'] . '">'. $currentcommunity['name']  .'</option>');

				}
				
				echo('</select></div></div>');	
				
				
			}
			
			?>
			
			
			<?php
						
				$count = get_request_count($_SERVER['REMOTE_ADDR'], 'submit_post');		
				
				if(!$session_local && $count >= 10){
					
					echo("<br>Captcha:<br>");
	  	 
				   $publickey = "6LcXHfYSAAAAAOSU0ArSOLuYhoLuIB69u5900_M_";
				   echo recaptcha_get_html($publickey);
				   
	   				echo("<br>");
				   
   
				}
				

			?>
		
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        <button type="submit" class="post-submit-button btn btn-info">SUBMIT</button>
		
		</form>
      </div>
    </div>
  </div>
</span>