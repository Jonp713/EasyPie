<?php
if($_GET['t'] == "notifications"){
	
	echo('<span class = "col-sm-12 no-padding currentlink">');
	
	echo('<span class = " dashlink ">');
	
}else{
	
	
	echo('<span class = "col-sm-12 no-padding adashlink">');
	
	echo('<span class = " dashlink">');
	
}


?>


<a href = 'dashboard.php?t=notifications'>Notifications</a>

</span></span>


<?php
if($_GET['t'] == "inbox"){
	
	echo('<span class = "col-sm-12 no-padding currentlink">');
	
	echo('<span class = " dashlink ">');
	
}else{
	
	
	echo('<span class = "col-sm-12 no-padding adashlink">');
	
	echo('<span class = " dashlink">');
	
}


?>


<a href = 'dashboard.php?t=inbox'>Inbox</a>

</span></span>


<?php
if($_GET['t'] == "sent"){
	
	echo('<span class = "col-sm-12 no-padding currentlink">');
	
	echo('<span class = " dashlink ">');
	
}else{
	
	
	echo('<span class = "col-sm-12 no-padding adashlink">');
	
	echo('<span class = " dashlink">');
	
}


?>


<a href = 'dashboard.php?t=sent'>Sent</a>

</span></span>




<?php
if($_GET['t'] == "submissions"){

	
	echo('<span class = "col-sm-12 no-padding currentlink">');
	
	echo('<span class = "dashlink">');
	
}else{
	
	
	echo('<span class = "col-sm-12 no-padding adashlink">');
	
	echo('<span class = "dashlink">');
	
}


?>

<a href = 'dashboard.php?t=submissions'>Submissions</a>

</span></span>


<?php
if($_GET['t'] == "saved"){
	
	echo('<span class = "col-sm-12 no-padding currentlink">');
	
	echo('<span class = " dashlink ">');
	
}else{
	
	
	echo('<span class = "col-sm-12 no-padding adashlink">');
	
	echo('<span class = " dashlink">');
	
}


?>

<a href = 'dashboard.php?t=saved'>Saved</a>

</span></span>
