<?php
	
	
if(empty($_GET['comment']) == false){
	
	$id = sanitize($_GET['comment']);
	
	if(user_owns_post($id)){
	
		echo('
		<script>
		open_comments('.$id.', "#");
	

		//$("#post'.$id.'").parent(".hole-post").css("z-index", "10000");
		//$("#post'.$id.'").parent(".hole-post").css("color", "white");

		//$("#post'.$id.'").parent(".hole-post").css("background-color", "black");
		
		
	
		</script>
	
		');
		
		echo('<span class = "commenting-on hidden-xs col-xs-5">');
		
		display_hole_post($id, 'post', 'title', 'meme', 'image', 'video', 'website','give_point', 'point_count');
	
		echo('</span>');
	
	}


}



?>



