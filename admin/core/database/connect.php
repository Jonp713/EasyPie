<?php

if($session_local){

	$connect_error = 'Sorry, we\'re experiencing connection problems.';
	mysql_connect('localhost', 'root', '') or die($connect_error);
	mysql_select_db('lr') or die($connect_error);

}else{
	
	$connect_error = 'Sorry, we\'re experiencing connection problems.';
	mysql_connect('girlsngals.db.10967359.hostedresource.com', 'girlsngals', 'Number1!') or die($connect_error);
	mysql_select_db('girlsngals') or die($connect_error);
	
}

?>