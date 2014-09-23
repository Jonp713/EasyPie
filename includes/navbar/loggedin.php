

    <li class="active"><a href='feed.php'>FEED</a></li>
	
	<?php $notcount = count_notifications($session_user_id); ?>

    <li><a href='dashboard.php?t=notifications'><?php echo(strtoupper($user_data['username'])); ?>&nbsp;<?php if($notcount > 0){ echo('(&nbsp;<span class = "notcount">'.$notcount.'</span>&nbsp;)'); }?></a></li>
	
 


 