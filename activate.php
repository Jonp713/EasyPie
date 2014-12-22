<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

echo('<span class = "col-xs-6 col-xs-offset-3 security">');

include 'includes/widgets/activateemail.php';

echo('</span>');

include 'includes/overall/footer.php';
?>