<form class="hidden-md hidden-lg hidden-sm form-inline" action="" method = "get" role="form">
  <div class="form-group">
    <div class="col-sm-10">
		<input class = "form-control" id = "p" type="text" name="p">
    </div>
  </div>
  <div class="form-group">
     <div class="col-sm-offset-2 col-sm-10">
 		<button type="submit" class="btn btn-custom2"><span class = "glyphicon glyphicon-search"></button>
  	</div>
	</div>
</form>

			
<?php

echo('<span class = "col-xs-12 col-sm-6 col-sm-offset-3 searchedposts">');

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
	
			display_post($currentpost['id'], 'post', 'site', 'display_time', 'save_post', 'reply', 'flag');	
	
			echo('<br>');

		}
	
	}

}else{
	
	echo("Search for something!");
	
}

echo('</span>');

?>