	
<?php
echo('ICU'. $_GET['community']. '&nbsp;');
echo('<a href = "queue.php?community=' . $_GET['community'] . '">Queue</a>&nbsp;');
echo('<a href = "denied.php?community=' . $_GET['community'] . '">Denied</a>&nbsp;');
echo('<a href = "approved.php?community=' . $_GET['community'] . '">Approved</a>&nbsp');
echo('<a href = "overview.php?community=' . $_GET['community'] . '">Overview</a>&nbsp');
echo('<a href = "stats.php?community=' . $_GET['community'] . '">Stats</a>&nbsp');
echo('<a href = "points.php?community=' . $_GET['community'] . '">Points</a>&nbsp;');

?>
	