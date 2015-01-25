	<?php
		
	echo('<span class = "col-xs-12 links">');
	
	$links = get_links($_GET['c']);

	echo($_GET['c'] . '\'s Links<br>');
		
	foreach ($links as $currentlink) {
		
		echo('<a data-toggle="tooltip" data-container = "body" title="'.$currentlink['description'].'"  data-placement="right" href = "'.$currentlink['URL'].'" target = "_blank">'.$currentlink['name'].'</a><br>');
		
	}
	
	echo('<span class = "col-xs-12 no-padding addlink"><a  href = "addlink.php?c='.$_GET['c'].'" >+ Add a Link</a></span>');
	
	echo('</span>');
		
		
	?>