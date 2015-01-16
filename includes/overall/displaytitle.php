<?php
	
	
	
if(isset($_GET['service']) && display_name_type($_GET['service']) == "sercom"){
	
	
	if(!empty($service_in)){
		
		echo($service_in);
	
	}else{
		
		echo('MATROPOLIX');
	
	}  
		
		
	if(!empty($community_in)){
		
		echo($community_in);
	
	}  


}else{
		
		
	if(!empty($community_in)){
		
		echo($community_in);
	
	}  
	
	
	if(!empty($service_in)){
		
		echo($service_in);
	
	}else{
		
		echo('MATROPOLIX');
	
	}  
	
	
}
	
	
	
	
?>