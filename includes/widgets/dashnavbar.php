<?php

if($_GET['t'] == "notifications"){
	
	echo('<span class = "dashlink currentlink">');
	
}else{
	
	echo('<span class = "dashlink">');
	
}


?>


<a href = 'dashboard.php?t=notifications'>Notifications</a>

</span>


<?php

if($_GET['t'] == "messages"){
	
	echo('<span class = "dashlink currentlink">');
	
}else{
	
	echo('<span class = "dashlink">');
	
}

?>


<a href = 'dashboard.php?t=messages'>Messages</a>

</span>


<?php

if($_GET['t'] == "submissions"){
	
	echo('<span class = "dashlink currentlink">');
	
}else{
	
	echo('<span class = "dashlink">');
	
}

?>

<a href = 'dashboard.php?t=submissions'>Submissions</a>

</span>


<?php

if($_GET['t'] == "saved"){
	
	echo('<span class = "dashlink currentlink">');
	
}else{
	
	echo('<span class = "dashlink">');
	
}

?>

<a href = 'dashboard.php?t=saved'>Saved</a>

</span>

<hr class = "messagehr">