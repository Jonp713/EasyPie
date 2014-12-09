<?php

if($session_local){

	$connect_error = 'Sorry, we\'re experiencing connection problems.';
	mysql_connect('localhost', 'root', '');
	mysql_select_db('lr');

}else{
	
	$connect_error = 'Sorry, we\'re experiencing connection problems.';
	mysql_connect('localhost', 'icu', 'vxP38zBwPFXNTJZ6');
	mysql_select_db('lr');
	
}

?>