<!-- Sidebar -->
<div id="sidebar-wrapper" class = "topcornerstuck hidden-sm hidden-md hidden-lg hidden-xl ">
    <ul class="sidebar-nav">
	
	<li>
		<button class="menu-toggle btn btn-custom btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Close</button>			
		
	</li>
		<hr class = "sidebarhr">
		
        <li>
			
			
		<?php
		
		//This is where youd put the other services
		
		?>
        </li>
		
		<li><a href = 'posts.php?c=Hampy'>POSTS</a></li>
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
		
		//Moderator PIC THING IN HERE!!
		


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