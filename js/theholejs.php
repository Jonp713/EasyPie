<script type = 'text/javascript'>

// Create the canvas
var can = document.createElement("canvas");
var ctx = can.getContext("2d");
can.width = $(window).width();
can.height = $(window).height();
document.getElementById("hole").appendChild(can);


///set posts
<?php $hole['posts'] = get_posts(2, $community_in, 1, false);?>

//display posts
var posts = <?php echo json_encode($hole['posts']); ?>;

var ambientLight = 0;
var intensity = .8;
var radius = 100;
var amb = 'rgba(0,0,0,' + (1-ambientLight) + ')';
var mouse = {};

can.addEventListener('mousemove', function(e) {
	
    mouse = getMouse(e, can);
    redraw(mouse);
	
}, false);

function cameraMove(){
	
	if(camera.y <= postsparse.length * 50 - $(window).width()/2.2){
	
		if(mouse.y >= ($(window).height() - 200)){
		
			camera.y += .3;
		
		}
		if(mouse.y >= ($(window).height() - 150)){
		
		
			camera.y += .6;
		
		}
		if(mouse.y >= ($(window).height() - 100)){
		
		
			camera.y += 1;
		
		}
	
	}
	
	if(camera.y >= 0){
		if(mouse.y <= 200){
		
			camera.y -= .3;
		
		}
		if(mouse.y <= 150){
		
		
			camera.y -= .6;
		
		}
		if(mouse.y <= 100){
		
		
			camera.y -= 1;
		
		}
	}
	
} 

var camera = {};
camera.y = 0;

var postlinelength = $(window).width()/40;
var count = 0;
var count2 = 0;
var postsparse = [];
var words = [];
var totalcharcount = 0;
var totallines = 0;
var dontnewline = false;

var debugparse = [];

function prepPosts(){
	
	for(var i=0;i< posts.length; i++){
		
		newArray = posts[i].post.split(" ");
		
		array = [];
		
		words.push(array);
		
		for(var j = 0; j< newArray.length; j++){
			
			if(newArray[j] != undefined){
					
				words[i].push(newArray[j]);
			
			}
		
		}
		
	}
	
	for(var i=0; i < words.length; i++){
						
		postsparse.push("");
		
		for(var j = 0; j < words[i].length; j++){
								
			if(words[i][j] != undefined){
					
				totalcharcount = totalcharcount + words[i][j].length + 1;
			
			}
			
		}
		
		buildString = '';
		for(var j = 0; j < words[i].length; j++){
			
			if(count < postlinelength){
				
				if(words[i][j] != undefined){

					buildString += words[i][j] + ' ';
				
					count = count + words[i][j].length + 1;
					count2 = count2 + words[i][j].length + 1;
					
				
				}
				
				if(count >= postlinelength || count2 >= totalcharcount){
					
					debugparse.push([count, totalcharcount, words[i][j]]);
								
					postsparse.push(buildString);
				
					buildString = '';
				
					count = 0;
				
				}
								
			}
			
	
		
		}
		count = 0;
		count2 = 0;
		totalcharcount = 0;
		
		
	}
	
}
function displayPosts(){
	
	for(var i=0;i<postsparse.length;i++){

	       ctx.fillText(postsparse[i], $(window).width()/10, ((i * 50) + 50) - camera.y);
		   
	 }
	
}


function redraw(mouse) {
    can.width = can.width;
	ctx.fillStyle = 'black';
	ctx.font = "40px Titillium";
    //ctx.drawImage(img, 0, 0);
	displayPosts();
	
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
   // ctx.fillText('The Hole', 30, 50);
	
}

var img = new Image();
img.onload = function() {
    redraw({x: -500, y: -500})
}
        //img.src = 'http://placekitten.com/200/200';

// Creates an object with x and y defined,
// set to the mouse position relative to the state's canvas


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

prepPosts();

ctx.fillStyle = 'black';
ctx.font = "20px Titillium";

//ctx.fillText('The Hole is loading...', (can.width/2) - 100,(can.height/2) - 40);

setInterval(cameraMove, 0);


</script>