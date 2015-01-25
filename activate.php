<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

echo('<span class = "col-xs-12 col-sm-6 col-sm-offset-3 security">');

include 'includes/widgets/activateemail.php';

echo('</span>');

include 'includes/overall/footer.php';
?>