	</div></div></div>
	<footer>
		
 <center>
<!--<span style = "padding-bottom:6px" class = "col-xs-12"> &copy; 2014 ICU-5 Connections LLC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = "mailto:contact@icu.university">Contact</a></span>-->
</center>
 
	</footer>
  
    <script src = 'js/jquery.js' type = 'text/javascript'></script>
    <script src = 'js/posts.js' type = 'text/javascript'></script>
    <script src = 'js/bla.js' type = 'text/javascript'></script>
    <script src = 'js/communities.js' type = 'text/javascript'></script>
    <script src = 'js/messages.js' type = 'text/javascript'></script>
    <script src = "js/bootstrap.js" type = 'text/javascript'></script>
    <script src = "js/sidebar.js" type = 'text/javascript'></script>
	<?php include 'js/servicesjs.php' ?>	
	<?php include 'js/coordinatesjs.php' ?>		
    <script src = "js/comments.js" type = 'text/javascript'></script>	
    <script src = "js/points.js" type = 'text/javascript'></script>	
    <script src = "js/users.js" type = 'text/javascript'></script>		
    <script src = "js/mods.js" type = 'text/javascript'></script>	
	<?php include 'js/geolockjs.php' ?>		

	
	<script>
	
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();
		$('[data-toggle="tooltip"]').tooltip({ container: 'body' });
		
		
		if(getURLParameter('submitpost') == "go"){
 

			$('#myModal').modal('show');
	 
	 
 		}
			

	</script>
	
	<?php
	//share stuff
	
	if(empty($_GET['share']) == false){?>
	
	<script type = "text/javascript">

		$('#sharepostmodal').modal('show');
		
	
		
		
	</script>
	
	<?php }?>
	
	
	<?php
	
	//analytics stuff
	if(!$session_local){?>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-42122616-2', 'auto');
	  ga('send', 'pageview');

	</script>
	
	<?php }?>
	
	<?php 
	
	
	if(isset($_GET['success'])){ ?>
		
		
		<script type = "text/javascript">
				
		
			if(getURLParameter('success') == "post"){
				 
				 check = Math.random();
				 
				 if(check <= .2 && check > 0){
				 
				 html = '<span class="alert alert-success" role="alert">Post submitted! Party later?</span>';
				 
			 		}
   				 if(check <= .4 && check > .2){
					
					
					 html = '<span class="alert alert-success" role="alert">Post submitted!</span>';
					
				 }
   				 if(check <= .6 && check > .4){
					
					
					 html = '<span class="alert alert-success" role="alert">Post submitted! But will it be approved?</span>';
					
				 }
   				 if(check <= .8 && check > .6){
					
					
					 html = '<span class="alert alert-success" role="alert">Post submitted! Great computer skills!</span>';
					
				 }
   				 if(check <= 1 && check > .8){
					 
					 html = '<span class="alert alert-success" role="alert">Post submitted! You won!</span>';
					 
					 
				 }
				 
				 	
				 	
				 				 
			 }
			 
 			if(getURLParameter('success') == "board"){
			 
				html = '<span class="alert alert-success" role="alert">Board created! Life is good!</span>';
				 
			 }
  			if(getURLParameter('success') == "franchise"){
			 
	
				 html = '<span class="alert alert-success" role="alert">Franchise added! The posts are coming...</span>';
				 
				 
			 }
   			if(getURLParameter('success') == "update_board"){
			 
	
 				 html = '<span class="alert alert-success" role="alert">Board updated! Will anyone care?</span>';
				 
				 
 			 }
		
    		if(getURLParameter('success') == "defranchise_board"){
			 
	
  				 html = '<span class="alert alert-success" role="alert">Aaaaaaaaand... it\'s gone!</span>';
				 
				 
  			 }
     		if(getURLParameter('success') == "deactivate_board"){
			 
	
   				 html = '<span class="alert alert-success" role="alert">There comes a time when everyone must say goodbye</span>';
				 
				 
   			 }
			 
 			if(getURLParameter('success') == "mod_quit"){
		 

			 	html = '<span class="alert alert-success" role="alert">You\'re free! Get nude</span>';
			 
			 
			 }
			if(getURLParameter('success') == "add_mod"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Help will always come for those who ask</span>';
		 
		 
	 		}
			if(getURLParameter('success') == "already_mod"){
	 

		 	   html = '<span class="alert alert-danger" role="alert">That user is already a moderator c\'mon now</span>';
		 
		 
	 		}
			if(getURLParameter('success') == "transfer_owner"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Hehe...sucker</span>';
		 
		 
	 		}
			if(getURLParameter('success') == "confirmed_email"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Roger that email confirmed, Over</span>';
		 
		 
	 		}
			if(getURLParameter('success') == "change_password"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Password changed...write it down</span>';
		 
		 
	 		}
			if(getURLParameter('success') == "identity_updated"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Your secret identity is safe with us</span>';
		 
		 
	 		}
			if(getURLParameter('success') == "info_updated"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Your info has been updated, it is still just as boring as it was before</span>';
		 
		 
	 		}
			
			if(getURLParameter('success') == "addlink"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Link added!</span>';
		 
		 
	 		}
		
		
			if(getURLParameter('success') == "newbie"){
	 

		 	   html = '<span class="alert alert-success" role="alert">Hi :) </span>';
		 
		 
	 		}
			
			if(getURLParameter('success') == "added_home"){
	 

		 	   html = '<span class="alert alert-success" role="alert"> Yes, hello, welcome home.</span>';
		 
		 
	 		}
		
		
			$("#topalert").html(html);
			

			$("#topalert").fadeIn("slow", function() { $(this).delay(7000).fadeOut("slow");
			 
			 });
				 
	
		</script>
	
	<?php }
	
	
	
	
	if (logged_in() === true) {
		?>
	
		<script>
	
			var logged_in = true;
	
		</script>
	
		<?php
	
	}else{
	
	
		?>
	
		<script>
	
			var logged_in = false;
	
		</script>
	
		<?php
	}?>
	
	

</body>

</html>