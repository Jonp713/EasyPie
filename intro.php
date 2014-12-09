<?php
include 'core/init.php';
?>

<!doctype html>
<html>
<head>
	<title>ICU <?php if(!empty($community_in)){echo($community_in);} ?></title>
	<meta charset="UTF-8">
	
	<meta name="description" content="Posts that should never be seen">
	<meta name="keywords" content="<?php if(!empty($community_in)){echo($community_in.',');} ?> ICU, I see you, compliments, crushes, confessions, missed connections, college, school, hookups, dating, Ucrush, Tinder, FML, MLIA">
	
	
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/screen2.css" rel="stylesheet">
	
	
	<link rel="shortcut icon" type="image/png" href="https://icu.university/images/logonotext.png"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
</head>
<body>
<header>
		<script src="js/moments.js"></script>
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300italic,400italic,600,200,200italic,300,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
		<script>
		    moment().format();
		</script>
		<div class="clear"></div>
		
		<div id = "topalert" class="topalert col-md-4 col-md-offset-4"></div>
		
</header>
<div class="container-fluid">

<div class = "homepage col-xs-12">
	<br><br><br>
	
	<span class = "col-sm-10 col-sm-offset-1 col-xs-12">
		
	<img class = "img-responsive col-sm-10 col-sm-offset-1 col-xs-12" src = "images/icuamherst.png"><br>
	
	</span>
	<br>

	<span class = "hometext col-sm-10 col-sm-offset-1 col-xs-12 text-center">
		<span class = "firsthome col-sm-10 col-sm-offset-1 col-xs-12 text-left">
		
	<center><span class = "hometitle">What is ICU?</span></center><br>
		
	</span>

	<span class = "col-sm-6 col-sm-offset-3 col-xs-12 text-left">
		
	<center><span class = "homecat">ICU</span></center>ICU is a missed connections network for the 5 colleges. It’s a place where college students can anonymously post about that attractive person they saw on the PVTA, at the last Zü party, or in their econ class. 
	
	</span><br><br><br>

<span class = "row text-left">
	<span class = "sectors col-sm-6 col-sm-offset-0 col-xs-12">


	<center><span class = "glyphicon glyphicon-user"></span><br><span class = "homecat">Accounts</span></center>Having an account will let you get much more out of the ICU experience. You can save posts, subscribe to feeds, receive points, and send messages. Your username does not show up anywhere, its just so that you can login :)
	</span>
	
	<span class = "sectors col-sm-6 col-sm-offset-0 col-xs-12">


	<center><span class = "glyphicon glyphicon-comment"></span><br><span class = "homecat">Messages</span></center> Reconnect. Click reply to send direct messages to the author of a post. Our messages are designed to be completely anonymous and fleeting. Your username does not show up attached to a message, nor does it anywhere.

	
	</span>
	
</span>
<span class = "row text-left">
	
	<span class = "sectors col-sm-6 col-sm-offset-0 col-xs-12">
	

	<center><span class = "glyphicon glyphicon-star"></span><br><span class = "homecat">Saving Posts</span></center>Like a post? Save it for later.


	</span>

	<span class = "sectors col-sm-6 col-sm-offset-0 col-xs-12">

	<center><span class = "glyphicon glyphicon-list"></span><br><span class = "homecat">Personal Feed</span></center>Taking an off campus class just got more interesting. As we expand to the other 5 colleges, you can subscribe to specific campus feeds. 
	
	</span>
	
</span>

<span class = "row text-left">
	
	<span class = "sectors col-sm-6 col-sm-offset-0 col-xs-12">
	

	<center><span class = "glyphicon glyphicon-bullhorn"></span><br><span class = "homecat">Moderators</span></center> With ICU, anonymous doesn’t equal dangerous. We’ve designed a way for a member(s) of the Amherst community to vet content before it gets posted using a set of criteria made public to the user. 
	
	</span>
	
	<span class = "sectors col-sm-6 col-sm-offset-0 col-xs-12">

	<center><span class = "glyphicon glyphicon-flag"></span><br><span class = "homecat">Flagging posts</span></center> This is a way to let ICU management know that you think a moderator isn’t following policy when vetting posts. With this community feedback you help keep ICU a fun place for everyone.
	
	</span>
</span>
<br><br>

	<span class = "col-sm-6 col-sm-offset-3 col-xs-12 text-left">
		
	<center><span class = "homecat">The Hole</span></center>Because sometimes train-wrecks are too hard to look away from, we’ve come up with a way to share the posts that don’t make the cut. This page has been designed to show, but limit sharing the lewd, crude and downright offensive of ICU Amherst. Enter at your own risk.

	
	
	</span><br><br>

</span><br>

<span class = "col-sm-8 col-sm-offset-2 col-xs-12">
	<span class = "lasthome col-xs-12 text-center">
		<hr class = "messagehr"><br>

	We hope you have a great time. 
	<br>
	 
	 
 	</span>
	<span class = "lasthomesign col-sm-10 col-sm-offset-1 col-xs-12 text-right">
	
		 - THE ICU TEAM
	 
	</span>
</span>

	<span class = "buttonhome col-sm-4 col-sm-offset-4 col-xs-12">

<a href="posts.php?c=Amherst" style = "background-color:#4a2783;" class="btn btn-custom2 btn-lg btn-block">Lets dig in</a>	
	
	</span>
</div>

<div style = "background-color:#4a2783;" class = "topthing col-xs-12">
	
</div>


<?php include 'includes/overall/footer.php'; ?>