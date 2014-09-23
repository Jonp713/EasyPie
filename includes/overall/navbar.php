<div id = 'navbar' class = "navbar thenav">

	
    <span class="container-fluid">
		
	    <span class="navbar-header text-center">
				  
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
	          <span class="sr-only text-center">Toggle navigation</span>
          <img class = 'sm-navlogo pull-right navlogocollapse' src = "images/logonotext.png">
	        
	        </button>
	      </span>
		 
		  
	      <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-2">
	         <ul class="nav navbar-nav immovingthisfuckingtext">		 
				 
		        <li><a href = 'explore.php'>EXPLORE</a></li>
			   
				<?php
				if (logged_in() === true) {
					include 'includes/navbar/loggedin.php';
				} else {
					include 'includes/navbar/login.php';
				}
				?>		
				
    <ul class="collapse navbar-collapse pull-left">
     <form action = 'search.php' method = 'GET' class="navbar-form navbar-left navsearch" role="search">
       <div class="form-group">
         <input type="text" name = "p" class="form-control" >
       </div>
       <button type="submit" class="btn btn-custom2"><span class = "glyphicon glyphicon-search"></button>
     </form>
	   
     </ul>
	
	
	<ul class="collapse navbar-collapse pull-left">

	<a href = "index.php"><img  class = "cornlogo" src = "images/logowicu.png" ></a>


	</ul>
	
	        </ul>
 		   </div><!-- /.navbar-collapse -->
			

	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	  <hr class = "navhr">
	</nav>
	
</div>