<div id = 'navbar' class = "navbar thenav">

    <span class="container-fluid">
		
	    <span class="navbar-header text-center">
				  
	        <button type="button" class="navbar-toggle collapsed">
				
	          <span class="sr-only text-center">Toggle navigation</span>
		  
	  		   <?php
		   	
	  			   if(isset($_GET['c'])){
			
	  				  $url = get_logo_picture_url_from_community_name($_GET['c']);
		   
		   
	  	  			 echo('<img class = "menu-toggle btn btn-lg btn-default sm-navlogo pull-right navlogocollapse" src = "'.$url.'">');
		   
	
			  	
	   		  }else{

			  
	   			  ?>
		   
	  	<img class = 'menu-toggle btn btn-lg btn-default sm-navlogo pull-right navlogocollapse' src = "images/logonotext.png" >
	
   
	  			  <?php
   	   
	  					}

	  			  ?>
	        
	        </button>
	      </span>
		 
		  
	      <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-2">
	         <ul class="nav navbar-nav immovingthisfuckingtext">		 
				 
		      <li><a data-toggle="tooltip" title="Look at other college's posts
"  data-placement="bottom" href = 'explore.php'>EXPLORE</a></li>
			   
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
	   
		   <?php
		   	
			   if(isset($_GET['c'])){
			
		   ?>
		   
	       <button type="submit" style = "background-color:<?php echo(get_community_color_from_community_name($_GET['c']))?>" class="btn btn-custom2">
			   
			  <?php
			  	
		  }else{

			  
			  ?>
		   
	       <button type="submit" style = "background-color:#aab341" class="btn btn-custom2">
		   
			   
 			  <?php
			   	   
		  		}
		  
			  ?>
			  
   		   <span class = "glyphicon glyphicon-search"></button>
			  
			  
			  
     </form>
	   
     </ul>
	
	
	<ul class="collapse navbar-collapse pull-left">
		
		   <?php
		   	
			   if(isset($_GET['c'])){
			
				  $url = get_logo_picture_url_from_community_name($_GET['c']);
		   
		   
	  			 echo('<a href = "index.php"><img class = "cornlogo" src = "'.$url.'"></a>');
		   
	
			  	
 		  }else{

			  
 			  ?>
		   
	<a href = "index.php"><img class = "cornlogo" src = "images/logonotext.png" ></a>
	
   
			  <?php
   	   
					}

			  ?>
	
	<span class = "corntext">ICU</span>

	</ul>
	
	        </ul>
 		   </div><!-- /.navbar-collapse -->
			

	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	  <hr class = "navhr">
	</nav>
	
</div>