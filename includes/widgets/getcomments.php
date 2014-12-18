<?php
	
	
if(empty($_GET['comment']) == false){
	
	$id = sanitize($_GET['comment']);
	
	echo('
	<script>
	open_comments('.$id.', "#");
	
	</script>
	
	');
}

?>

