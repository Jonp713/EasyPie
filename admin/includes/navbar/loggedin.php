Hello, <?php echo $admin_data['initials']; ?>&nbsp;

<?php

if(check_admin_power($session_admin_id) == 1){

?>

<a href="communities.php">Communities</a>&nbsp;
<a href="admins.php">Admins</a>&nbsp;
<a href="creation.php">Creation</a>&nbsp;
<a href="server.php">Server</a>&nbsp;
<a href="pics.php">Pics</a>&nbsp;


<?php
	
}else{

	
?>
<a href="queue.php">Queue</a>&nbsp;
<a href="denied.php">Denied Posts</a>&nbsp;
<a href="approved.php">Approved Posts</a>&nbsp;
<a href="community.php">Community</a>&nbsp;
<a href="me.php">Me</a>&nbsp;
<a href="points.php">High Scores</a>&nbsp;

<?php

	
}
?>

<a href="logout.php">Log out</a>

