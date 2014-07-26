<footer>
 <?php echo $user_data['active']; ?>
 <?php echo $user_data['username']; 
 
 $timestamp = date('g:i A \ \ D, M d, Y' , time());
 
 echo($_SESSION['ddos']. '&nbsp;');
 echo(get_request_count($_SERVER['REMOTE_ADDR'], 'login'));
  
 echo('&nbsp;');
 
?>
 
 
</footer>