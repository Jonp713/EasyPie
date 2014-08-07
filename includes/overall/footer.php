	</div>
	<footer>
	 <?php echo $user_data['active']; ?>
	 <?php echo $user_data['username']; 
 
	 $timestamp = date('g:i A \ \ D, M d, Y' , time());
 
	 echo($_SESSION['ddos']. '&nbsp;');
	 echo(get_request_count($_SERVER['REMOTE_ADDR'], 'login'));
  
	 echo('&nbsp;');
 
	?>
 
 
	</footer>
    <script src = '../rl/js/jquery.js' type = 'text/javascript'></script>
    <script src = '../rl/js/posts.js' type = 'text/javascript'></script>
    <script src = '../rl/js/communities.js' type = 'text/javascript'></script>
    <script src = '../rl/js/messages.js' type = 'text/javascript'></script>
    <script src = "../rl/js/bootstrap.min.js" type = 'text/javascript'></script>

</body>
</html>