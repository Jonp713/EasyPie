<div id = "navbar2">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar2links">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
  	  </button>
        <a class="navbar-brand" href="#">
		<?php
			echo('Moderator '. $_GET['codename']);
		?>
      </a>
    </div>

	<div id = 'navbar2links' class = 'collapse navbar-collapse'>
		<ul class="nav navbar-nav">

		<li><a href = "profile.php?codename=<?php echo($_GET['codename']); ?>">Profile</a></li>
		<li><a href = "approved.php?codename=<?php echo($_GET['codename']); ?>">Approved</a></li>
		<li><a href = "denied.php?codename=<?php echo($_GET['codename']); ?>">Denied</a></li>
		<li><a href = "adminposts.php?codename=<?php echo($_GET['codename']); ?>">Admin Posts</a></li>
		<li><a href = "flagged.php?codename=<?php echo($_GET['codename']); ?>">Flagged Posts</a></li>

		</ul>
	</div>
  </div>
</nav>
</div>