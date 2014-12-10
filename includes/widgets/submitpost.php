<?php

if (empty($_POST) === false) {
			
	$required_fields = array('post');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'A post cannot be blank';
			break 1;
		}
	}
	
	$count = get_request_count($_SERVER['REMOTE_ADDR'], 'submit_post');		
	
	if(!$session_local && $count >= 10){
    $privatekey = "6LcXHfYSAAAAANnTCLXRiag_cz0BijZII2_ysboN";
     $resp = recaptcha_check_answer ($privatekey,
                                   $_SERVER["REMOTE_ADDR"],
                                   $_POST["recaptcha_challenge_field"],
                                   $_POST["recaptcha_response_field"]);

     if (!$resp->is_valid) {
       // What happens when the CAPTCHA was entered incorrectly
	   	//$errors[] = $resp->error;
		$errors[] = 'Incorrect Captcha';
     }
 
 	}
	
	if ((empty($_POST['email']) === false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)) {
		$errors[] = 'A valid email address is required';
	}
	
}

?>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true && (empty($errors) === false)) {
	
	
}
		
if (empty($_POST) === false && empty($errors) === true) {

    $timestamp = date('g:i A \ \ D, M d, Y' , time());
				
	if(!empty($_GET['c'])){			
	
		$post_data = array(
			'post'	 		=> $_POST['post'],
			'site'			=> $community_in,
			'display_time'	=> $timestamp,
			'second'		=> time()
		);
	
	}else{
		
		$post_data = array(
			'post'	 		=> $_POST['post'],
			'site'			=> $_POST['community'],
			'display_time'	=> $timestamp,
			'second'		=> time()
		);
		
		
	}
	
	if(logged_in() === true){
	
		if($_POST['reply_on'] == 'on'){
	
			$post_data['reply_on'] = 1;
		
		}	
		
		$post_data['user_id'] = $session_user_id;
		
	}
	
	$success = submit_post($post_data);
	
	if($success){
		
		if(empty($errors) === true){
				
			if(!empty($_GET['c'])){			
				
				if(!empty($_GET['service'])){
					
					header('Location: posts.php?c='.$community_in.'&service='.$service_in.'&s');
				
				}else{
					
					header('Location: posts.php?c='.$community_in.'&s');
					
				}
		
			}else{
			
				header('Location: feed.php?s');
			
			}
			exit();
	
	
		}
	}else{
		
		//echo($success);
		
	}
	
}else if (empty($errors) === false) {

	echo output_errors($errors);
}
	
?>


<!-- Button trigger modal -->
<button class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModal">SUBMIT POST</button>

<!-- Modal -->
<span class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Submit A Post</h4>
      </div>
      <div class="modal-body">
	
		  <form class = "submit_post form-horizontal" role="form" action="" method="post">
			  
			
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
			
		    <div class="form-group">
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
				
			<?php 
			}
			
			?>
			
			
		
				
			<?php
			
			if(empty($_GET['c'])){
				
				
				echo('
			   	 	<div class="form-group">
			   	 	<div class="col-sm-6">
				
				');
				
				echo('<br>Which community are you posting to?: <select class = "form-control" name = "community">');
				
				$communities = get_subscriptions(0, $session_user_id, '');

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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Submit</button>
		
		</form>
      </div>
    </div>
  </div>
</span>

<br>

	
