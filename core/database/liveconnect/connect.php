<?php
$connect_error = 'Sorry, we\'re experiencing connection problems.';
mysql_connect('girlsngals.db.10967359.hostedresource.com', 'girlsngals', 'Number1!') or die($connect_error);
mysql_select_db('girlsngals') or die($connect_error);
?>