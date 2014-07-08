<script type = 'text/javascript'>

// Create the canvas
var can = document.createElement("canvas");
var ctx = can.getContext("2d");
can.width = $(window).width();
can.height = $(window).height();
document.getElementById("hole").appendChild(can);


///set posts
<?php $hole['posts'] = get_posts(0, $community_in, 1);?>

//display posts
var posts = <?php echo json_encode($hole['posts']); ?>;

var ambientLight = 0;
var intensity = 1;
var radius = 70;
var amb = 'rgba(0,0,0,' + (1-ambientLight) + ')';

can.addEventListener('mousemove', function(e) {
    var mouse = getMouse(e, can);
    redraw(mouse);
}, false);


function redraw(mouse) {
    can.width = can.width;
    //ctx.drawImage(img, 0, 0);
	ctx.fillStyle = 'black';
	ctx.font = "40px Helvetica"
	for(var i=0;i<posts.length;i++){

	       ctx.fillText(posts[i].post, $(window).width()/3, (i * 50) + 50);
	 }
	
	g = ctx.createRadialGradient(mouse.x, mouse.y, 0, mouse.x, mouse.y, radius);
	g.addColorStop(1, amb);
	g.addColorStop(0, 'rgba(0,0,0,' + (1-intensity) + ')');
	 
	ctx.fillStyle = g;
    ctx.beginPath();
    ctx.rect(0,0,can.width,can.height);
    ctx.arc(mouse.x, mouse.y, 50, 0, Math.PI*2, false)
    ctx.clip();
    ctx.fillRect(0,0,can.width,can.height);
	ctx.fillStyle = 'white';
    ctx.fillText('The Hole', 30, 50);

	
}

var img = new Image();
img.onload = function() {
    redraw({x: -500, y: -500})
}
        img.src = 'http://placekitten.com/200/200';

// Creates an object with x and y defined,
// set to the mouse position relative to the state's canvas
// If you wanna be super-correct this can be tricky,
// we have to worry about padding and borders
// takes an event and a reference to the canvas


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

</script>