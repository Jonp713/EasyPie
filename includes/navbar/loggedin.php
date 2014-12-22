

    <li data-toggle="tooltip" title="View only the posts from services you are subscribed to"  data-placement="bottom"><a href='feed.php'>FEED</a></li>
	
	<?php $notcount = count_notifications($session_user_id); ?>

    <li <?php if($notcount > 0){ echo('style = ""');} ?> data-toggle="tooltip" title="Look at things like your messages, points and old shit"  data-placement="bottom"><a href='dashboard.php?t=notifications'><?php if($notcount > 0){ echo('<span class = "notcount badge">'.$notcount.'</span>'); }?><?php if($notcount > 0){ echo('<span class = "username">');} echo(strtoupper($user_data['username'])); if($notcount > 0){ echo('</span>'); }?></a></li>
	
 