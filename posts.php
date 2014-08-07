<?php
include 'core/init.php';
active_protect($_GET['c']);

include 'includes/overall/header.php';

?>



<?php 


include 'includes/widgets/subscribe.php';
include 'includes/content/communityinfo.php';
include 'includes/content/adminposts.php';
include 'includes/widgets/submitpost.php';
include 'includes/content/displayposts.php';


?>

<?php include 'includes/overall/footer.php'; ?>