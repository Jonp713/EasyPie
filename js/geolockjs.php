<script>

function positionNotFound(error){
	
  alert("To see this board we need to access your location, brah. You gotta go change your browser settings");
  window.location.replace("posts.php?c="+ getURLParameter('c'));
	
}

function positionFound(pos, from){
	
  var latitude = <?php echo(get_latitude($_GET['c'])); ?>;

  var longitude = <?php echo(get_longitude($_GET['c'])); ?>;

  if(latitude < pos.coords.latitude + .08 && latitude > pos.coords.latitude - .08 && longitude < pos.coords.longitude + .08 && longitude > pos.coords.longitude - .08){
	  
	  	if(from == "geo-locked-page"){

		  $('body').show();

		  if(getURLParameter('service') == "Zombledon"){

		  		startZomble();

	  		}
		
		}
							
		//$('.geo-locked-board').show()			

  }else{
	  
	  	if(from == "geo-locked-page"){

		  alert("This board can only be viewed if you are within the radius of the community it belongs to!");
	  
		  window.location.replace("posts.php?c="+ getURLParameter('c'));
		
		}
							
		//$('.geo-locked-board').hide()

  }

}

</script>


		<?php
		
		if(isset($_GET['c']) && !isset($_GET['service'])){
			
		?>
		
		<script>
		
		//window.navigator.geolocation.getCurrentPosition(function(pos){positionFound(pos, 'home');} , function(){ $('.geo-locked-board').hide() });
		
		</script>
		
		
		<?php	
			
		}
		
		
		if(isset($_GET['service']) && isset($_GET['c']) && is_geo_locked($_GET['service']) == 1 && $current_file == "posts.php" || $current_file == "zombledon.php" ){

		?>


		<script>
				
		window.navigator.geolocation.getCurrentPosition(function(pos){positionFound(pos, 'geo-locked-page')}, positionNotFound);
		
		</script>



		<?php 

		}
		
		?>