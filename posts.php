<?php
include 'core/init.php';
active_protect($_GET['c']);

include 'includes/overall/header.php';

?>



<?php 


include 'includes/widgets/subscribe.php';
include 'includes/communityinfo.php';
include 'includes/adminposts.php';
include 'includes/submitpost.php';
include 'includes/displayposts.php';


?>

<?php include 'includes/overall/footer.php'; ?>