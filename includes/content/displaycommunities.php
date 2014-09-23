<?php

$communities = get_communities(1, '');

echo("<span class = 'communities col-xs-8 col-xs-offset-2'>");

echo("<h1 class = 'text-center'>Expanding at our own pace :)</h1><br><br>");

echo("<h4 class = 'text-center'>We have only have one community right now, but soon you'll be able to explore other schools' drama</h4><br><br>");



foreach ($communities as $currentcommunity){
	
	if($currentcommunity['status'] == 2){}else{		
		
		echo("<span class = 'col-xs-12'>");

		$name = strtoupper($currentcommunity["name"]);

		echo('<a class = "communitynamecom" href = "posts.php?c=' . $currentcommunity['name'] . '"><span class ="communityname">ICU<font color = "#aab341">'. $name  .'</font></span></a>');
		
		if($currentcommunity['hole'] == 1){
		
		
			echo('<span class = "hidden-xs pull-right holecompage">');
		
			echo('<a class=" pull-right btn btn-custom btn-md" href = "hole.php?c=' . $currentcommunity['name'] . '">ENTER HOLE</a>');
		
			echo('</span>');
	
		}
		
		echo('<span class = "pull-right postcompage">');
		
		echo('&nbsp;&nbsp;&nbsp;');
		
		echo('<a class="pull-right btn btn-info btn-md" href = "posts.php?c=' . $currentcommunity['name'] . '">VIEW POSTS</a>');
		
		echo('</span>');
	
		
		
		echo('<br><span class = "communityinfo">');
	
		echo($currentcommunity['description'].'');
		
	
		echo("</span>");
		
		
		$randompostid = random_post($currentcommunity['name']);
		
		if(isset($randompostid)){
			
			echo("<hr class = 'messagehr'><span class = 'hidden-xs'>");
			
			display_post($randompostid, 'post', 'display_time', 'site', 'share_post', 'save_post', 'reply');
		
			echo('<br><br><br><br></span>');
		
		}
		
	
		echo("</span>");
	
	}
	

}
echo("</span>");

	
?>