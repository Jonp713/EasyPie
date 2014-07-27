<h1>Blacklist</h1>

<?php

$blacklist = get_blacklist();

foreach ($blacklist as $currentip){
	
	echo('IP Address: '.$currentip.'<br>');
	echo('<span onclick="remove_blacklist(\''.$currentip.'\')">Remove Blacklist</span><br><br>');
	
}
?>

<h1>Suspicious Requests</h1>

<?php

$requestlist = get_requests(6);

foreach ($requestlist as $currentrequest){
		
	echo('IP Address: '.$currentrequest['ip'].'<br>');
	
	echo('Requests: ' . $currentrequest['count'] . '<br>');
		
	echo('Type: '.$currentrequest['type'].'<br>');
	
	echo('<span onclick="blacklist(\''.$currentrequest['ip'].'\')">Blacklist</span><br>');
	echo('<span onclick="ok_requests(\''.$currentrequest['id'].'\')">Ok Request</span><br><br>');
	
}

	
?>