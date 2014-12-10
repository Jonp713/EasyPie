<?php

moderator_protect_page();

?>

<li><a><span class = "hello_user">Hello, <?php echo $admin_data['initials']; ?></span></a></li>

<?php

moderator_protect_page();

if(check_admin_power($session_admin_id) == 1){

?>
<li><a href="communities.php">Communities</a></li>
<li><a href="admins.php">Admins</a></li>
<li><a href="creation.php">Creation</a></li>
<li><a href="server.php">Server</a></li>
<li><a href="pics.php">Pics</a></li>
<li><a href="submit.php">Submit</a></li>
<li><a href="service.php">Services</a></li>



<?php
	
}else{

	
?>

<li><a href="queue.php">Queue</a></li>
<li><a href="denied.php">Denied Posts</a></li>
<li><a href="approved.php">Approved Posts</a></li>
<li><a href="community.php">Community</a></li>
<li><a href="me.php">Me</a></li>
<li><a href="points.php">High Scores</a></li>

<?php

	
}
?>

<li><a href="logout.php">Log out</a></li>

