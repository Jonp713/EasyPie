<?php

function get_random_ad($type){
	
	$type = sanitize($type);

	$result = mysql_fetch_assoc(mysql_query("SELECT id FROM ads WHERE expired = 0 AND type = '$type' ORDER BY RAND() LIMIT 1"));

	return $result['id'];

}

function display_full_page_ad($ad_id){
	
	$ad_id = sanitize($ad_id);
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ads WHERE id = '$ad_id' LIMIT 1"));
	
	echo("<div id = 'overlay'><button class = 'xbutton btn btn-lg btn-default glyphicon glyphicon-remove-sign'></button><a href = 'http://www.hampshirehungergames.com' target ='_blank'><img src = 'images/bla/".$data['img']."' class = 'bla img-responsive col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4'></a></div>");
	
	
}

function display_side_ad($ad_id){
	
	$ad_id = sanitize($ad_id);
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ads WHERE id = '$ad_id' LIMIT 1"));
	
	echo("<br><a href = 'http://www.hampshirezombledon.com' target ='_blank'><img src = 'images/bla/".$data['img']."' class = ' img-responsive'></a>"); 
	
	
}

function increment_display_count($ad_id){
	
	$ad_id = sanitize($ad_id);
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM ads WHERE id = '$ad_id' LIMIT 1"));
	
	$newcount = $data['displayed_count'] + 1;
	
	mysql_query("UPDATE ads SET displayed_count = '$newcount' WHERE id = '$ad_id'");
	
}


?>