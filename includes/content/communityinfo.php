<?php

$community = $_GET['c'];

$community = sanitize($community);

$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));

echo($result['description'].'');


$name = strtoupper($result['name']);

echo('<span class ="communityname">'.$name.'</span><br>');

echo('<span class = "community-desc col-xs-12">');

echo('<span class = "communityinfo">');

echo($result['description'].'');

echo("</span></span>");

?>
