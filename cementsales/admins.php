<?php
include 'core/init.php';
admin_protect_page();

include 'includes/overall/header.php';


?>

<h1>Admins</h1>

<?php
		
include("includes/content/displayadmins.php")


?>

<?php include 'includes/overall/footer.php'; ?>