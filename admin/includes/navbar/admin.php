<?php
echo('Moderator '. $_GET['codename']. '&nbsp;');
echo('<a href = "profile.php?codename=' . $_GET['codename'] . '">Profile</a>&nbsp;');
echo('<a href = "approved.php?codename=' . $_GET['codename'] . '">Approved</a>&nbsp;');
echo('<a href = "denied.php?codename=' . $_GET['codename'] . '">Denied</a>&nbsp;');
echo('<a href = "adminposts.php?codename=' . $_GET['codename'] . '">Admin Posts</a>&nbsp;');

?>