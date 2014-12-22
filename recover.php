<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';


echo('<span class = "col-xs-6 col-xs-offset-3 security">');

include 'includes/widgets/recover.php';

echo('</span>');

include 'includes/overall/footer.php'; ?>