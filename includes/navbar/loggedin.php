

    <li data-toggle="tooltip" title="View the posts from services you are subscribed to"  data-placement="bottom"><a href='feed.php'>FEED</a></li>
	
	<?php $notcount = count_notifications($session_user_id); ?>

    <li data-toggle="tooltip" title="Look at things like your messages, points and old shit"  data-placement="bottom"><a href='dashboard.php?t=notifications'><?php echo(strtoupper($user_data['username'])); ?>&nbsp;<?php if($notcount > 0){ echo('(&nbsp;<span class = "notcount">'.$notcount.'</span>&nbsp;)'); }?></a></li>
	
 