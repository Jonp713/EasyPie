<?php

$communities = get_communities(1, '');

echo("<span class = 'communities col-xs-12 col-sm-8 col-sm-offset-2'>");

echo("<h1 class = 'text-center'>Expanding at our own pace :)</h1><br><br>");

foreach ($communities as $currentcommunity){
	
	if($currentcommunity['status'] == 2){}else{		
		
		echo("<span class = 'col-xs-12'>");
		echo("<span class = 'col-xs-12 col-sm-6'>");
		
		$name = strtoupper($currentcommunity["name"]);

		echo('<a class = "communitynamecom" href = "posts.php?c=' . $currentcommunity['name'] . '"><span class ="communityname">ICU<font color = "'.$currentcommunity["color"].'">'. $name  .'</font></span></a>');
		
		echo('<span class = "hidden-sm hidden-md hidden-lg hidden-xl upalittle">');
				
		echo('<a class="btn btn-info btn-md" href = "posts.php?c=' . $currentcommunity['name'] . '">VIEW POSTS</a>');
				
		echo('</span>');
		
		echo('</span>');
		
		echo("<span class = 'col-sm-6 col-xs-12'>");
		
		
		if($currentcommunity['hole'] == 1){
		
			echo('<span class = "hidden-xs pull-right holecompage">');
		
			echo('<a class=" pull-right btn btn-custom btn-md" href = "hole.php?c=' . $currentcommunity['name'] . '">ENTER HOLE</a>');
		
			echo('</span>');
	
		}
		

		
		
		echo('<span class = "hidden-xs pull-right postcompage">');
		
		echo('&nbsp;&nbsp;&nbsp;');
		
		echo('<a class="pull-right btn btn-info btn-md" href = "posts.php?c=' . $currentcommunity['name'] . '">VIEW POSTS</a>');
		
		echo('</span>');

		
		
		echo('</span>');

		
		echo('<br><span class = "col-xs-12 col-sm-12 communityinfo">');
	
		echo($currentcommunity['description'].'');
		
	
		echo("</span>");
		
		$randompostid = random_post($currentcommunity['name']);
		
		if(isset($randompostid)){
			
			echo("<hr class = 'messagehr col-xs-11'><span class = 'hidden-xs'>");
			
			display_post($randompostid, 'post', 'display_time', 'site', 'share_post', 'save_post', 'reply');
		
			echo('<br><br><br><br></span>');
		
		}
		
	
		echo("</span>");
	
	}
	

}
echo("</span>");

	
?>