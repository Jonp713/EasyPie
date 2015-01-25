<div id = 'navbar' class = "navbar thenav" style = "background-color:<?php 
if(isset($_GET['service'])){

	echo(get_service_color_from_service_name($_GET['service']));

}else{
	
	echo('#303030;');

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
  
	//echo('<span class = "pull-left corntext">'.strtoupper($_GET['service']).'</span>');
	//echo('<span class = "pull-left corntext">'.strtoupper($_GET['c']).'</span>');
	echo('<span class = "hidden-xs">');
  
  
	if(isset($_GET['service']) && display_name_type($_GET['service']) == "sercom"){
	
	
		if(!empty($service_in)){
		
			echo('<span class = "pull-left corntext white">'.strtoupper($_GET['service']).'</span>');
	
		}else{
		
			echo('<span class = "pull-left corntext white">MATROPOLIX</span>');
	
		}  
		
		
		if(!empty($community_in)){
		
		  	echo('<span class = "pull-left corntext">'.strtoupper($_GET['c']).'</span>');
	
		}  


	}else{
		
		
		if(!empty($community_in)){
		
		  	echo('<span class = "pull-left corntext">'.strtoupper($_GET['c']).'</span>');
	
		}  
	
	
		if(!empty($service_in)){
		
			echo('<span class = "pull-left corntext white">'.strtoupper($service_in).'</span>');
	
		}else{
		
			echo('<span class = "pull-left corntext white">MATROPOLIX</span>');
	
		}  
	
	
	}
	
	echo('</span>');
	
	/*
  if(!isset($_GET['c'])){
	    	
	  	if(isset($session_user_id)){
			
			echo('<span class = "pull-left corntext">'.strtoupper(get_home_from_user_id($session_user_id)).'</span>');
		
		}
		
		if(!isset($_GET['service'])){
			
		
			echo('<span class = "pull-left corntext white">MATROPOLIX</span>');
			
		
		}else{
		

			echo('<span class = "pull-left corntext white">'.strtoupper($_GET['service']).'</span>');
		
		}
			

  }else{
	
		if(!isset($_GET['service'])){
			
		  	echo('<span class = "pull-left corntext">'.strtoupper($_GET['c']).'</span>');
			
			echo('<span class = "pull-left corntext white">MATROPOLIX</span>');
	
	  	
	
		}else{
		
	  		echo('<span class = "pull-left corntext">'.strtoupper($_GET['c']).'</span>');
		
	  		echo('<span class = "pull-left corntext white">'.strtoupper($_GET['service']).'</span>');
		
		}
		
	}

	*/
	
	
	?>
		
	    <span class="navbar-header text-center">
				  
	        <button type="button" class="navbar-toggle collapsed">
				
	          <span class="sr-only text-center">Toggle navigation</span>
		  
	  		   <?php
		   	
	  		if(isset($_GET['service'])){
			
	    		$url = get_logo_picture_url_from_service_name($_GET['service']);
		   		   
				   
					if(empty($url)){
					
	 echo('<span class = "menu-toggle btn btn-lg btn-default sm-navlogo pull-right navlogocollapse"><span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span></span>');	
	 				
					}else{
				   
	  	  			 echo('<img class = "menu-toggle img-responsive no-padding btn btn-lg btn-default sm-navlogo pull-right navlogocollapse" src = "'.$url.'">');
					 
					 }
					 
					 
					 

			  	
	   		  }else{

			  
	   			  ?>
		   
<span class = "menu-toggle btn btn-lg btn-default sm-navlogo pull-right navlogocollapse"> <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span></span>	
   
	  			  <?php
   	   
	  			}

	  			  ?>
	        
	        </button>
	      </span>
		 
		  
	      <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-2">
	         <ul class="nav navbar-nav immovingthisfuckingtext">	
				 
				 
	  		<!--<li><a href = "search.php" data-toggle="tooltip" title="Pretty self-explanatory..." data-placement="bottom">SEARCH</a></li>-->
			
					<li><a href = "explore.php" data-toggle="tooltip" title="Find other habbitats" data-placement="bottom">EXPLORE</a></li>
			  
			   
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