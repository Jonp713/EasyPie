

<?php 		$home = get_home_from_user_id($session_user_id);
?>


	
	<li><a data-toggle="tooltip" title="View your habbitats home page"  data-placement="bottom" href = 'posts.php?c=<?php echo($home) ?>'>HOME</a></li>
	
    <li data-toggle="tooltip" title="View the boards you have subscribed to"  data-placement="bottom"><a href='feed.php'>FEED</a></li>

	
	<?php $notcount = count_notifications($session_user_id); ?>

    <li <?php if($notcount > 0){ echo('style = ""');} ?> data-toggle="tooltip" title="Look at things like your messages, points and old shit."  data-placement="bottom"><a href='dashboard.php?t=notifications'><?php if($notcount > 0){ echo('<span class = "notcount badge">'.$notcount.'</span>'); }?><?php if($notcount > 0){ echo('<span class = "username">');} echo('DASHBOARD'); if($notcount > 0){ echo('</span>'); }?></a></li>
	
	
	
 