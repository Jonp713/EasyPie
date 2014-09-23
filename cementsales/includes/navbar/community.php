<?php

moderator_protect_page();

?>

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
			echo('ICU'. $_GET['community']);
		?>
      </a>
    </div>

	<div id = "navbar2links" class = 'collapse navbar-collapse'>
		<ul class="nav navbar-nav">
			
		<li><a href = "queue.php?community=<?php echo($_GET['community']); ?>">Queue</a></li>
		<li><a href = "denied.php?community=<?php echo($_GET['community']); ?>">Denied</a></li>
		<li><a href = "approved.php?community=<?php echo($_GET['community']); ?>">Approved</a></li>
		<li><a href = "overview.php?community=<?php echo($_GET['community']); ?>">Overview</a></li>
		<li><a href = "stats.php?community=<?php echo($_GET['community']); ?>">Stats</a></li>
		<li><a href = "points.php?community=<?php echo($_GET['community']); ?>">Points</a></li>

		</ul>
	</div>
  </div>
</nav>
</div>
	