<!-- Sidebar -->
<div id="sidebar-wrapper" class = "topcornerstuck hidden-sm hidden-md hidden-lg hidden-xl ">
    <ul class="sidebar-nav">
	
	<li>
		<button class="menu-toggle btn btn-custom btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Close</button>			
		
	</li>
		<hr class = "sidebarhr">
		
        <li>
			
			
		<?php
		
		if(isset($_GET['c'])){
		
			$community = $_GET['c'];
			
			$community = sanitize($community);
		
			$result = mysql_fetch_assoc(mysql_query("SELECT * FROM communities WHERE name = '$community'"));
		
			$name = strtoupper($result['name']);
	
			echo('<span style = "color:white; font-size:20px; !important" class ="communityname">ICU<font color = "'.$result['color'].'">'.$name.'</font></span><br>');
			
	
		}
		
		?>
        </li>
		
		<li><a data-placement="bottom" href = 'explore.php'>EXPLORE</a></li>
  				<?php
  				if (logged_in() === true) {
  					include 'includes/navbar/loggedin.php';
  				} else {
  					include 'includes/navbar/login.php';
  				}
  				?>

		<li><a href = "search.php">SEARCH</a></li>

		<hr class = "sidebarhr">
		
        <li>
			
			
		<?php
		
		if(isset($_GET['c'])){
		
		
			echo('<span style = "color:#fff;">');
			
			if($result['needs_moderator'] == 0){
	
				$id = $result['head_admin_id'];
				
				$id = sanitize($id);
	
				$admin = mysql_fetch_assoc(mysql_query("SELECT profile, initials FROM cementsalesmen WHERE id = '$id'"));
	
				echo('<span style = "color:white; font-size:30px;" class = "modtitle">Mod '.$admin['initials'].'</span><br>');
	
				$url = get_mods_picurl($id);
	
				echo '<img class = "col-xs-6 col-sm-12 img-responsive" src="'. $url . '"><br><br>';
				
			}
			
			$admin_posts = admin_posts($_GET['c']);
			
			echo('<span class = "col-xs-12" style = "width:200px;">');
			
			foreach ($admin_posts as $currentpost) {
		
				echo('<br><span class = "pull-left adminpost" style = "padding-left:0px; text-indent:0px; line-height:15px !important;">');
		
				echo($currentpost['message'] . '<br><br>');
		
				echo('');
		
				$id = $currentpost['admin_id'];
				
				$id = sanitize($id);
				
				$codename = mysql_result(mysql_query("SELECT `initials` FROM `cementsalesmen` WHERE `id` = '$id'"), 0, 'initials');
		
				echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-".$codename);
		
				echo('</span><br><br>');
				
			
			}	
			echo('</span>');
		
		
		}

echo('</span>');

		?>
		
        </li>
		
		
		<?php if ($current_file == "feed.php" || $current_file == "index.php"){
			
			echo('<span class = "col-xs-6 subscriptionstitle" style = "color:white; font-size:20px;">SUBSCRIPTIONS</span>&nbsp;&nbsp;&nbsp;&nbsp;');

			$communities = get_subscriptions(0, $session_user_id, '');

			foreach ($communities as $currentcommunity){
	
				echo('<li><span style = "padding:0px;" class = "subscription col-xs-10">');

				echo('<a href = "posts.php?c=' . $currentcommunity['name'] . '">ICU' . $currentcommunity['name'] .'</a>');		
	
				echo('&nbsp;&nbsp;&nbsp;&nbsp;');
	
				echo('<button class = "btn btn-danger btn-sm" onclick="delete_subscription(\''.$currentcommunity['name'].'\', this, 1)">REMOVE</button>');
	
	
				echo('<span >&nbsp;&nbsp;</span>');
	
				if($currentcommunity['hole'] == 1){
	
	
				echo('<a class="hidden-xs pull-right btn btn-custom btn-sm" href = "hole.php?c=' . $currentcommunity['name'] . '">HOLE</a>');
	
	
				}
	
				echo('<hr class = "subsidehr"></span></li>');
	

			}

			
		}?>
       
   
    </ul>
</div>