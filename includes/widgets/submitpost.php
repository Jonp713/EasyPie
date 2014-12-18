



<?php

include('includes/widgets/postrecieve.php');

if(isset($_GET['service'])){

	$desc = get_service_description_from_service_name($_GET['service']);	

	echo('<span class = "col-xs-12 service-desc">'.$desc.'<br></span>');

}else{	
	
	echo('<span class = "col-xs-12 service-desc">Submit anything that comes to mind using this button<br></span>');
	
}


?>


<!-- Button trigger modal -->
<button class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModal">SUBMIT POST</button>

	
