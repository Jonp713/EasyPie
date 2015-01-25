<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';


echo('<span class = "col-xs-12 col-sm-6 col-sm-offset-3 security">');

include 'includes/widgets/recover.php';

echo('</span>');

include 'includes/overall/footer.php'; ?>