<footer>
 <?php echo $user_data['active']; ?>
 <?php echo $user_data['username']; 
 
 $timestamp = date('g:i A \ \ D, M d, Y' , time());
 
 echo($timestamp);
 
 echo(time());
 
 ?>
 
</footer>