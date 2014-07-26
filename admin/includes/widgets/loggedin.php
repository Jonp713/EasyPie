<div class="widget">
	<h2>Hello, <?php echo $user_data['username']; ?>!</h2>
	<div class="inner">
		<div class="profile">
			
		</div>
		<ul>
			<li>
				<a href="information.php">My information</a>
			</li>
			
			<?php if ($user_data['active'] <= 2){ ?>
				<li>
					<a href="confirmemail.php">Confirm an email</a>
				</li>
			<?php   } ?>
			<li>
				<a href="logout.php">Log out</a>
			</li>
		</ul>
	</div>
</div>