<div id = 'navbar' class = "navbar thenav" style = "background-color:<?php 
if(isset($_GET['service'])){

	echo(get_service_color_from_service_name($_GET['service']));

}else{
	
	echo('black;');

}

 ?>" >
	
	
		   <?php
		   /*
		   	
		  if(isset($_GET['service'])){
			
  			$url = get_logo_picture_url_from_service_name($_GET['service']);
	   		   
	  		echo('<a href = "index.php"><img class = "pull-left img-responsive cornlogo" src = "'.$url.'"></a>');
			  	
 		  }else{

 			  ?>
		   
	<a href = "index.php"><img class = "pull-left img-responsive cornlogo" src = "images/logonotext.png" ></a>
	
   
			  <?php
   	   
					}
		   */

			  ?>
	
  <?php 
  
  if((isset($_GET['service']) && $_GET['service'] == "ICU") || ( (isset($_GET['service']) == false) && isset($_GET['c']) && ($_GET['c'] == "Hampy")  ) || ((isset($_GET['service']) == false) && (isset($_GET['c']) == false))){
	  
  	if(isset($_GET['service'])){
  	
	echo('<span class = "pull-left corntext">'.strtoupper($_GET['service']).'</span>');
	echo('<span class = "pull-left corntext white">HAMPY</span>');
	
	}else if(isset($_GET['service'])){
		
		echo('<span class = "pull-left corntext white">ICU</span>');
		echo('<span class = "pull-left corntext">'.strtoupper($_GET['c']).'</span>');
		
	}else{
		echo('<span class = "pull-left corntext">ICU</span>');
		echo('<span class = "pull-left corntext white">HAMPY</span>');
		
		
	}
	
	
  }else{
	
		if(isset($_GET['c'])){
		
			echo('<span class = "pull-left corntext white">'.strtoupper($_GET['c']).'</span>');
		
		
		}else{
		
			echo('<span class = "pull-left corntext white">HAMPY</span>');
		
		
		}
		
	  	if(isset($_GET['service'])){
		
			echo('<span class = "pull-left corntext">'.strtoupper($_GET['service']).'</span>');

	
		}else{
		
			echo('<span class = "pull-left corntext">ICU</span>');
		
		}
	
	}
	
	?>
		
	    <span class="navbar-header text-center">
				  
	        <button type="button" class="navbar-toggle collapsed">
				
	          <span class="sr-only text-center">Toggle navigation</span>
		  
	  		   <?php
		   	
	  		if(isset($_GET['service'])){
			
	    		$url = get_logo_picture_url_from_service_name($_GET['service']);
		   		   
	  	  			 echo('<img class = "menu-toggle btn btn-lg btn-default sm-navlogo pull-right navlogocollapse" src = "'.$url.'">');

			  	
	   		  }else{

			  
	   			  ?>
		   
		   
	  	<img class = 'menu-toggle btn btn-md btn-default sm-navlogo pull-right navlogocollapse' src = "images/logonotext.png" >
	
   
	  			  <?php
   	   
	  			}

	  			  ?>
	        
	        </button>
	      </span>
		 
		  
	      <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-2">
	         <ul class="nav navbar-nav immovingthisfuckingtext">	
				 
				 	 
				 
		      <li><a data-toggle="tooltip" title="View all of your communities posts and services"  data-placement="bottom" href = 'posts.php?c=Hampy'>HOME</a></li>
	  		<li><a href = "search.php" data-toggle="tooltip" title="Pretty self-explanatory..." data-placement="bottom">SEARCH</a></li>
			  
			   
				<?php
				if (logged_in() === true) {
					include 'includes/navbar/loggedin.php';
				} else {
					include 'includes/navbar/login.php';
				}
				?>		
				
    <ul class="collapse navbar-collapse pull-left">
    
   <!--
	
	
	 <form action = 'search.php' method = 'GET' class="navbar-form navbar-left navsearch" role="search">
       <div class="form-group">
         <input type="text" name = "p" class="form-control" >
       </div>
	   
	   
	   
		   <?php
		   	
			  // if(isset($_GET['service'])){
			
		   ?>
		   
	       <button type="submit" style = "background-color:<?php //echo(get_service_color_from_service_name($_GET['service']))?>" class="btn btn-custom2">
			   
			  <?php
			  	
		 // }else{

			  
			  ?>
		   
	       <button type="submit" style = "background-color:#aab341" class="btn btn-custom2">
		   
			   
 			  <?php
			   	   
		  		//}
		  
			  ?>
			  
   		   <span class = "glyphicon glyphicon-search"></button>
			  
			  
     </form>
	  -->
	   
     </ul>
	
	
	<ul class="collapse navbar-collapse pull-left">
		
	
	</ul>
	
	        </ul>
 		   </div><!-- /.navbar-collapse -->
			

	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	
</div>