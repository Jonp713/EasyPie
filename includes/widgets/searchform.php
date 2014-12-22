
			
<?php

echo('<span class = "col-xs-12 col-sm-6 col-sm-offset-3 no-padding searchedposts lowerandscroll">');

?>

<form class="form-inline" action="" method = "get" role="form">
		<input class = "form-control" style = "width:90% !important" id = "p" type="text" name="p">
 		<button type="submit" class="btn btn-custom2"><span class = "glyphicon glyphicon-search"></button>
</form>

<?php

echo('<h1>Search Results</h1>');

if (empty($_GET) === false) {
	
	$query = $_GET['p'];
	
	$posts = search_posts($_GET['p']);
	
	if(count($posts) <= 0){

		echo("<h4>No results for: \"".$_GET['p']."\"</h4>");
		
	}
	
	if($query === ""){
		
		echo("You must enter a search query");
		
	}else{
	
		foreach ($posts as $currentpost) {
	
			if($currentpost['service'] == "ICU"){
			
				display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'save_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
			
			}
			if($currentpost['service'] == "Bone"){
		
				display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
			}
		
		
			/*
		
			if($currentpost['service'] == "Hole"){
		
				display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
			
				echo('<br>');
		
		
			}
		
			*/
	
		}
	
	}

}else{
	
	echo("Search for something!");
	
}

echo('</span>');

?>