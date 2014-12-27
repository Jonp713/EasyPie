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
		
		<li><a href = 'posts.php?c=Hampy'>HOME</a></li>
  				<?php
  				if (logged_in() === true) {
  					include 'includes/navbar/loggedin.php';
  				} else {
  					include 'includes/navbar/login.php';
  				}
  				?>

		<li><a href = "search.php">SEARCH</a></li>

		<hr class = "sidebarhr">
		
		<?php if ($current_file == "dashboard.php"){
		
		
			?>
			
						<span class = "col-xs-6 subscriptionstitle" style = "color:white; font-size:20px;">DASHBOARD</span><br><br>
		
        <li>
			

			<a href = 'dashboard.php?t=notifications'>NOTIFICATIONS</a>

        </li>

        <li>


			<a href = 'dashboard.php?t=inbox'>INBOX</a>

        </li>

        <li>



			<a href = 'dashboard.php?t=sent'>SENT</a>

        </li>

        <li>


			<a href = 'dashboard.php?t=submissions'>SUBMISSIONS</a>

        </li>

        <li>

			<a href = 'dashboard.php?t=saved'>SAVED</a>
			
		
        </li>
		<br>
        <li>
		
			<a href="logout.php">LOGOUT</a>
			
	        </li>
			
		
		<?php } ?>
		
		
		<?php if ($current_file == "feed.php" || $current_file == "index.php"){
			
			echo('<span class = "col-xs-6 subscriptionstitle" style = "color:white; font-size:20px;">SUBSCRIPTIONS</span>&nbsp;&nbsp;&nbsp;&nbsp;');

			$services = get_subscriptions(0, $session_user_id, '');
			
			if(count($services) > 0){

			foreach ($services as $currentservice){
	
				echo('<span style = "padding:0px;" class = "subscription col-xs-12">');
	
				 $color = get_service_color_from_service_name($currentservice['service']);

				 $url =  get_logo_picture_url_from_service_name($currentservice['service']);

				 $desc = get_service_description_from_service_name($currentservice['service']);
 
				 if($currentservice['service'] == "Hole"){
	 
						$link = 'hole.php?c='.$currentservice['community_name'].'&service='.$currentservice['service'];
	 		
				}else{
 	
				 	$link = 'posts.php?c='.$currentservice['community_name'].'&service='.$currentservice['service'];
	
				}

				switch($currentservice['service']){
					case "ICU":		
		
						echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['community_name'].'-container">');
		
		
						echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-12 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
	
						echo('<span class = "service-list-name2"><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span></span></a>');



					break;
					case "Zombledon":		
		
					
		
					break;
					case "Events":		
		
						echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['community_name'].'-container">');
			
						echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-12 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
 		
					 	$live_count = count_total_live_events($currentservice['community_name']);
		
		
						echo('<span class = "service-list-name2"><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span></span></a>');
		
		
						if($live_count > 0){ 
				
							echo('<span class = "badge user-count-badge-feed" style = "color:'.$color.'">'.$live_count.'</span>');
				
						}
		
					break;
					default:
			
						echo('<span class = "col-xs-12 no-padding aservice-list '.$currentservice['community_name'].'-container">');
			
			
						echo('<a href="'.$link.'" style = "background-color:'.$color.'" class="btn btn-custom2 no-padding btn-sm col-xs-12 servicebutton-feed"><img class = "service-logo col-xs-2 no-padding" src = "'.$url.'">'); 
		
		
						echo('<span class = "service-list-name2"><span class = "service-name-sub white">'.strtoupper($currentservice['community_name']).'</span><span class = "service-name-sub">'.strtoupper($currentservice['service']).'</span></span></a>');
		
					}

	
						echo('<button class = "pull-right btn btn-danger btn-sm col-xs-12" onclick="delete_subscription(\''.$currentservice['community_name'].'\', \''.$currentservice['service'].'\', this, 1)">REMOVE</button>');
		
	
						echo('</span></span>');
	
			}
			}

			
		}?>
       
   
    </ul>
</div>