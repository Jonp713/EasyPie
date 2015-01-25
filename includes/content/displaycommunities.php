<?php

if(isset($_GET['selecthome'])){
	
	select_home($session_user_id, $_GET['selecthome']);
	
	header('location: posts.php?c='.$_GET['selecthome'].'&success=added_home');
}

if(empty($user_data['home']) && isset($session_user_id)){
	
	$needs_home = true;
	
}else{
	
	$needs_home = false;
}



$communities = get_communities(1, '');

echo("<span class = 'communities col-xs-12 col-sm-8 col-sm-offset-2'>");

if($needs_home){
	
	echo('<span class = "col-xs-12 speaking"><h1>You need to choose your home habbitat before we release you</h1><h4>Theres only one habbitat right now it should be an easy decision...</h4></span>');
	
}

$every_other = 0;

foreach ($communities as $currentcommunity){
	
	if($currentcommunity['status'] == 2){}else{		
		
		if($every_other == 0){
			
			echo('<span class = "col-xs-12 no-padding">');
		}
		
		echo("<span class = 'col-xs-12 col-sm-6 community-block'>");
		
		
		echo("<span class = 'col-xs-6'>");
		
		$name = strtoupper($currentcommunity["name"]);

		echo('<a class = "communitynamecom" href = "posts.php?c=' . $currentcommunity['name'] . '">'. $name  .'</a>');
		
		echo("</span>");
		echo("<span class = 'col-xs-6 community-loc'>");
		
		echo($currentcommunity["real_name"] . ' <br> '.$currentcommunity["city"] . ', '. $currentcommunity["state"] );
		
		echo("</span>");
		
		
		echo('<br><span class = "col-xs-12 col-sm-12 communityinfo">');
	
		echo($currentcommunity['description']);
		
		echo("</span>");
		
		
		if($needs_home){
		
			echo('<a href = "explore.php?selecthome='.$currentcommunity['name'].'" onclick = "selecthome(\''.$currentcommunity['name'].'\')" class = "btn-block btn btn-info" style = "width:80%; margin:5% 0% 0% 10%;">Choose as Home</a>');
		
		}
		
		echo("</span>");
		
		
		$every_other = $every_other + 1;
		
		if($every_other == 2){
			
			echo('</span>');
			
			$every_other = 0;
		}
		
		
		
		/*
		
		$randompostid = random_post($currentcommunity['name']);
		
		if(isset($randompostid)){
			
			echo("<hr class = 'messagehr col-xs-11'><span class = 'hidden-xs'>");
			
			create_display_set($randompostid, 'home',  'load');
		
			echo('<br><br><br><br></span>');
		
		}
		
		*/
		
	}
	

}
echo("</span>");

	
?>