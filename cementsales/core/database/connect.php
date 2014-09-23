<?php

if($session_local){

	$connect_error = 'Sorry, we\'re experiencing connection problems.';
	mysql_connect('localhost', 'root', '');
	mysql_select_db('lr');

}else{
	
	$connect_error = 'Sorry, we\'re experiencing connection problems.';
	mysql_connect('localhost', 'root', 'YSSC2r@Q#3smAkz&ztURNAVgM3WhS^DH*W@GTH%%g!pHe$AHC6');
	mysql_select_db('lr');
	
}

?>