<div class = "col-xs-12 no-padding bottomland" style = "height:100%">
	<div class = "logoandlogin col-xs-12">
		<br>
		
		<img src = "images/landinglogo.png" class = "landinglogo col-xs-6 col-xs-offset-3">
	
	<form class="form-inline col-xs-12" method = "POST" action = "login.php" role="form"><strong>
	 <div class="form-group">
		  Username:<br>
	    <div class="input-group">
	      <label class="sr-only" for="exampleInputEmail2">Username:</label>
	      <input type="text" name = "username" id = "username" class="form-control" id="exampleInputEmail2" placeholder="Username">
	    </div><br>
  	    <label class = "notblue">
			Forgotten your <a href="recover.php?mode=username">username</a>?
			
  	    </label>
	  </div>
	  <div class="form-group">
  	    <div class="input-group">
		  Password:<br>
	    <label class="sr-only" for="exampleInputPassword2">Password</label>
		
	    <input type="password" name = "password" id = "password" class="form-control" id="exampleInputPassword2" placeholder="Password">
		</div>
		<br>
    	  <div class="checkbox">
		
  	      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"> Remember me
	  	  </div>
		  
	  </div>
	  
	  <button type="submit" class="btn btn-default">Login</button></strong>
	  <br><br>
	</form>
	
	
</div>

		 <div class = "col-xs-12 landcopy"><br>
			 
			 <span class = "landdescription">Sign Up Now</span><br>
			 It's free! Someone may have already posted about you.<br>
			 <span class = "row">

<form action = "register.php" method = "POST" class="form-horizontal" role="form">
	
  <div class="form-group">
    <div data-container="body" data-toggle="popover" data-placement="left" data-content="Your information will never be seen by other users" class="col-sm-10">
      <input type="text" class="form-control" id="username" name = 'username' placeholder="Username">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name = "password" placeholder="Password">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password_again" name = "password_again" placeholder="Confirm Password">
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name = "email" placeholder="Email (Optional)">
      </div>
    </div>
	
	<div class="form-group">
	    <div class="col-sm-10">
<button class="col-xs-12 btn btn-info btn-large">Go!</button>	    
</div>
	  </div>

</form>

<span class = "continuelink"> or <a href = "explore.php">Continue to site</a></span>

</span>