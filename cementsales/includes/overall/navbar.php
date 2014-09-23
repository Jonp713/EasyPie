<div id = "navbar1">
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1links">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Common Cement Inc.</a>
    </div>

	<div id="navbar1links" class = 'collapse navbar-collapse'>
		<ul class="nav navbar-nav">
		<?php
		if (admin_access() === true) {
			include 'includes/navbar/loggedin.php';
		} else {
			include 'includes/navbar/login.php';
		}
		?>	
		</ul>
	</div>
</div>	
</nav>
</div>

<?php
if (isset($_GET['community'])) {
	include 'includes/navbar/community.php';
}
if (isset($_GET['codename'])) {
	include 'includes/navbar/admin.php';
}
?>		


