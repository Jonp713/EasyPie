	
<?php
include 'core/init.php';
active_protect($_GET['c']);


?>

<html>
<head>
	<title>The Hole - <?php echo($_GET['c']);?></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/screen2.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="shortcut icon" type="image/png" href="https://www.icu.university/images/blackhole.png"/>
	<meta name="description" content="Posts that should never be seen">
	<meta name="keywords" content="<?php echo($_GET['c'].',');?> ICU, I see you, hole, denied, posts, drama, gossip, compliments, crushes, confessions, missed connections, college, school, hookups, dating, Ucrush, Tinder, FML, MLIA">
	<meta name="author" content="The Devil">
	
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300italic,400italic,600,200,200italic,300,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
			<script src="js/moments.js"></script>

			<script>
			    moment().format();
			
			
			</script>
	
	<style>
	body{
	    -moz-user-select: none;
	      -khtml-user-select: none;
	      -webkit-user-select: none;

	      /*
	        Introduced in IE 10.
	        See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
	      */
	      -ms-user-select: none;
	      user-select: none;
		  cursor:none;
	}
	::-webkit-scrollbar {
	    width: 10px;
	}
 
	::-webkit-scrollbar-track {
	   background-color:rgba(0,0,0,1); 
	}
 
	::-webkit-scrollbar-thumb {
	    background-color:rgba(255,255,255,1); 
		
	}
	
	body{
	  background: #000000;
	}

	.ploatjeClass{
	  position:absolute;
	  width: 100%;
	  background-color:white;
  
	}

	#log{
	  color:#ffffff;
	  position:absolute;
	  opacity:0;  
	}

	#logDetails{
	  color:#ffffff;
	  position:absolute;
	  opacity:0;
	}

	

	</style>

	
	
	
</head>
<body>
<header>
</header>
</body>

<div id = "holeoverlay-left">
	
	<a href = "posts.php?c=<?php echo($_GET['c']); ?>" class = "btn btn-md btn-default"><span class = "glyphicon glyphicon-arrow-left"></span>&nbsp;EXIT</a>
	
</div>

<div id = "holeoverlay-right">
	
	<!-- Button trigger modal -->
	<button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal">
		What the Hell Is This?
	</button>


	
</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title text-center" id="myModalLabel"><span class = "holename">THE HOLE</span></h4>
	      </div>
	      <div class="modal-body">
	        So, what you are viewing is all the posts that the <?php echo($_GET['c']); ?> Moderator has denied. Therefore, this content was never intended to be seen, and in many cases, should never be shared publicly. This page is designed in a way that prevents sharing of the content beyond this setting.
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

<div id="ploatje" class="ploatjeClass">
	
	<?php include 'includes/content/displayholeposts.php'; ?>
	<?php include 'includes/content/displayholecomments.php'; ?>
	
	
	
</div>
<div id="log"></div>  
<div id="logDetails"></div>  


<script src = 'js/posts.js' type = 'text/javascript'></script>
<script src = 'js/jquery.js' type = 'text/javascript'></script>
	<script>
	var logDiv = document.getElementById("log");
	var logDetailsDiv = document.getElementById("logDetails");

	// Div containing our image
	var divPloatje = document.getElementById('ploatje');

	// Initial Mouse coords
	var mouse = {
	    x: -100,
	    y: -100
	};

	// Fire of the Mask function so the mask is automagically following whatever is in the mouse var.
	fixMask();


	if ('ontouchstart' in document.documentElement) {
	    // Touch events available, wire to touchStart and touchMove
	    divPloatje.addEventListener('touchmove', touchMove, false);
	    divPloatje.addEventListener('touchstart', touchStart, false);
	    divPloatje.addEventListener('touchend', touchEnd, false);
	} else {
	    // Touch events not available, wire to touchMove only
	    divPloatje.addEventListener('mousemove', touchMove, false);
	}


	function touchStart(e) {
	    console.debug("Touch Start! " + e.type + " event=" + inspect(e));
	    //logDetails( inspect( e.touches.item(0) ) );  
	    e.preventDefault(); // PreventDefault prevents native scrolling on device
	    return false;
	}

	function touchMove(e) {

	    if (e.touches == null) {
	        // No touch available fallback to mouse
	        mouse = getMouse(e, divPloatje);
	        console.debug("Mouse Move");
	    } else {
	        //Touch available
	        var targetEvent = e.touches.item(0);
	        //log("[x,y] from target=" + targetEvent.clientX + "," + targetEvent.clientY );  
	        // Assign clientX and ClientY values to mouse.x,y 
	        mouse.x = targetEvent.clientX;
	        mouse.y = targetEvent.clientY;
	        // console.debug("Touch Move");  
	    }

	    //log("[x,y] in mouse=" + mouse.x + "," + mouse.y );  

	    //logDetails( inspect( e ) );  
	    e.preventDefault(); // Kill native scroll again, might be double measure, not shure... ;-)
	    return false;
	}

	function touchEnd(e) {
	    console.debug("touchEnd (!)");
	    //  var strImage = '-webkit-radial-gradient('+ mouse.x+'px '+mouse.y+'px,10px 10px, rgba(0, 0, 0, 1) 0%,rgba(0, 0, 0, 1) 30%, rgba(255, 255, 255, 0.1) 80%, rgba(255, 255, 255, 0.1) 100%)';
	    //divPloatje.style.WebkitMaskImage = strImage;
	}


	// This function is scheduled by using RequestAnimationFrame
	// Should provide smoother animation but I'm on the fence here.
	// My S3 is loving it, my Tegra tablet seems slower...


	function fixMask() {
	    requestAnimationFrame(fixMask);
	    // Create string for -webkit-mask-image CSS attribute
	    var strImage = '-webkit-radial-gradient(' + mouse.x + 'px ' + mouse.y + 'px,300px 200px, rgba(0, 0, 0, 1) 0%,rgba(0, 0, 0, 1) 40%, rgba(255, 255, 255, 0.1) 90%, rgba(255, 255, 255, 0.05) 100%)';
	    divPloatje.style.WebkitMaskImage = strImage;


	    //log("WebKitMaskImage:" + strImage);
	}

	// Util Functions


	function getMouse(e, canvas) {
	    var element = canvas,
	        offsetX = 0,
	        offsetY = 0,
	        mx, my;

	    // Compute the total offset. It's possible to cache this if you want
	    if (element.offsetParent !== undefined) {
	        do {
	            offsetX += element.offsetLeft;
	            offsetY += element.offsetTop;
	        } while ((element = element.offsetParent));
	    }

	    mx = e.pageX - offsetX;
	    my = e.pageY - offsetY;

	    // We return a simple javascript object with x and y defined
	    return {
	        x: mx,
	        y: my
	    };
	}

	function log(text) {
	    logDiv.innerHTML = text;
	}

	function inspect(obj) {
	    if (typeof obj === "undefined") {
	        return "undefined";
	    }
	    var _props = [];

	    for (var i in obj) {
	        _props.push(i + " : " + obj[i]);
	    }
	    return " {" + _props.join(",<br>") + "} ";
	}

		
	$(document).mousemove(function( mouse ) {
			 
		if(mouse.clientY >= ($(window).height() - 200)){
			window.scrollBy(0, .8);
	
		}
		if(mouse.clientY  >= ($(window).height() - 150)){
	
			window.scrollBy(0, 2);
		
		}
		if(mouse.clientY >= ($(window).height() - 100)){
	
	
			window.scrollBy(0, 5);
	
		}
		if(mouse.clientY >= ($(window).height() - 50)){
	
	
			window.scrollBy(0, 10);
	
		}
		if(mouse.clientY >= ($(window).height() - 20)){
	
	
			window.scrollBy(0, 30);
	
		}

		if(mouse.clientY <= 200){
	
			window.scrollBy(0, -.8);
	
		}
		if(mouse.clientY <= 150){
	
	
			window.scrollBy(0, -2);
	
		}
		if(mouse.clientY <= 100){
	
	
			window.scrollBy(0, -5);
	
		}
		if(mouse.clientY <= 50){
	
	
			window.scrollBy(0, -10);
	
		}
		if(mouse.clientY <= 20){
	
	
			window.scrollBy(0, -30);
	
		}
	
	
	
	 
	});
	
	
	</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42122616-2', 'auto');
  ga('send', 'pageview');

</script>
<script src = 'js/bootstrap.js' type = 'text/javascript'></script>

</body>
</html>