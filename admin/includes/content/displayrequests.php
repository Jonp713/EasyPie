<h1>Blacklist</h1>

<?php

$blacklist = get_blacklist(0);

foreach ($blacklist as $currentip){
	
	echo('IP Address: '.$currentip['ip'].'<br>');
	echo('<span class = "'.$currentip['id'].'remove" onclick="remove_blacklist(\''.$currentip['ip'].'\')">Remove Blacklist</span><br><br>');
	
}
?>

<h1>Suspicious Requests</h1>

<?php

$requestlist = get_requests(6);

foreach ($requestlist as $currentrequest){
	
	echo('<span class = "row">');
	echo('<span class = "well well-sm col-xs-6">');
		
	echo('IP Address: '.$currentrequest['ip'].'<br>');
	
	echo('Requests: ' . $currentrequest['count'] . '<br>');
		
	echo('Type: '.$currentrequest['type'].'<br>');
	
	echo('<span class = "'.$currentrequest['id'].'blacklist" onclick="blacklist(\''.$currentrequest['ip'].'\')"><span class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Blacklist</span></span><br>');
	echo('<span class = "'.$currentrequest['id'].'ok" onclick="ok_requests(\''.$currentrequest['id'].'\')"><span class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span> Ok Requests</span></span><br><br>');
	
	echo('</span></span>');
	
}

	
?>