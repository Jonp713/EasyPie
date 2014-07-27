<?php
include 'core/init.php';

active_protect($_GET['c']);
has_hole($_GET['c']);
clear_old_posts($_GET['c']);

$hole = array();
$hole['posts'] = array();


?>
<html>
<head>
	<title>ICUHampy - The Hole</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/screen.css">
</head>
<body>
<header>
</header>
</body>
<?php

include 'includes/navbar.php';

?>

<div id = 'hole'>
	
<script src = 'js/jquery.js' type = 'text/javascript'></script>
<script src = 'js/posts.js' type = 'text/javascript'></script>
<script src = 'js/communities.js' type = 'text/javascript'></script>
<script src = 'js/messages.js' type = 'text/javascript'></script>


<?php 
include 'js/theholejs.php';
 ?>

</div>
</body>
</html>
