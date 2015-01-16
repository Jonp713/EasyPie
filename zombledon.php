<?php
include 'core/init.php';
active_protect($_GET['c']);

include 'includes/overall/header.php';

?>

								
				

			
			
	


<?php 

if($_SESSION['seen_ad'] == 0){
	
	if($_GET['c'] == "Hampy"){
	
		include 'includes/content/fullpagead.php';
	
		$_SESSION['seen_ad'] = 1;
	
	}
}

echo('<span class = "communitymoderator pull-right hidden-xs">');


	
	echo('<span class = "lowerandscroll">');
	
	include 'includes/content/servicedescription.php';
	
	include 'includes/widgets/subscribe.php';
	

?>

<button id="ruletta" onclick="client.ruletta();" class="zombleon btn btn-custom2 btn-lg btn-block">ZOMBLE ON<span class="glyphicon glyphicon-step-forward"></span></button>

<div>
	<span class = "img-responsive" id="ruletteBox"></span>
</div>


<br>
<?php



$user_count = get_user_count($_GET['service'], $_GET['c']);

if($user_count > 1){
	
	$user_count -= 1;
}

echo('<span class = "community-desc col-xs-12"><span class = "user-count"><span style = "color:'.$colortouse.'">'.$user_count.'</span> other users online</span><br>(Reload to see current count)</span>');

include 'includes/content/displaymoderator.php';

if($_GET['c'] == "TrapCity"){
	
	//$adid = get_random_ad(2);

	//display_side_ad($adid);

	//increment_display_count($adid);	
		
}

echo('</span></span>');

//$rgb = hex2rgb($colortouse);

//echo('<span class = "communitynav col-xs-12" style = "background-color:rgba('.implode($rgb,',').',0.5)">');

echo('<span class = "communitynav col-xs-12">');

echo('<span class = "lowerandscroll">');

include 'includes/content/servicelist.php';

echo('</span></span>');

echo('<span class = "postfeed">');

echo('<span class = "hidden-sm hidden-md hidden-lg">');

echo('</span>');

?>

<br>

<div id="theirBox">	

<video class = "col-xs-12 img-responsive slight-circle" style="display:none;" id="remotevideo" autoplay></video>

</div>
			<br>
				
<div class="col-xs-12 chatbox">

<span class = "form-inline">
	
<span class="writemexbox"><input onkeypress="return diop(event)" type="text" style = "width:90%" class = "form-control" value="" placeholder="Chat with them..." id="toSend"  disabled="disabled"></span><button class = "btn btn-info form-control" type="submit" style = "width:10%;" value="Send" onclick="client.sendMsg()" >Send</button>

</span>

<div id="chat" class="form-control notbg-color"></div>			
<br><br><br>



</div>

<?php

echo('</span>');

?>

<div class="statusbox">
	<span style = "display:none;" id="statusbox" ></span>
<div>
<div style = "display:none;" class="warn" id="warnbox">
	Devi accettare la webcam segaiolo <b>segaiolo!</b>
</div>
<div id="nickbox" style="display:none;">
	Nickname <input value="Managgia" type="text" id="nickbox-nickname" name="nickname" >
	<button onclick="client.joinRulette()">Join the Rulette</button>
</div>


<?php include 'includes/overall/footer.php'; ?>

	<script type="text/javascript" src="js/socket.io.js"></script>
	<script type="text/javascript" src="js/rulette.js"></script>
