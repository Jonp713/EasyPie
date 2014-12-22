var http = require('http');

var express = require("express"),
    app = express(),
    formidable = require('formidable'),
    util = require('util')
    fs   = require('fs-extra'),
    qt   = require('quickthumb'),
	fsog = require('fs'),

	upvote = fsog.readFileSync(__dirname + '/index.html');
	stylejs = fsog.readFileSync(__dirname + '/includes/stylejs.html');
	chatbox = fsog.readFileSync(__dirname + '/includes/chatbox.html');
	player = fsog.readFileSync(__dirname + '/player.html');
	admin = fsog.readFileSync(__dirname + '/admin.html');
	characteradmin = fsog.readFileSync(__dirname + '/characteradmin.html');
	countdown = fsog.readFileSync(__dirname + '/includes/countdown.html');
	modal1 = fsog.readFileSync(__dirname + '/includes/modal1.html');
	
	
var nodemailer = require('nodemailer');

// create reusable transporter object using SMTP transport
var transporter = nodemailer.createTransport({
    service: 'Gmail',
    auth: {
        user: 'jonathanrobertpedigo@gmail.com',
        pass: 'Qweqwe123'
    }
});


var url=require('url');

var server = app.listen(process.env.PORT || 3000);

var io = require('socket.io').listen(server);

// Use quickthumb
app.use(qt.static(__dirname + '/'));

//MONGO CLIENT!!!
var MongoClient = require('mongodb').MongoClient;
var database;

MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {

	database = db;

});

//index
app.get('/', function (req, res){
  
    res.writeHead(200, {'content-type': 'text/html'});
	
	res.write(stylejs);
	//res.write(countdown);
	
	res.write(modal1);
	
	res.write('<div id = "topbar" onClick = "showThing()" class = "hidden-xs col-sm-12 firsttime text-center"">First time here? No idea what you\'re looking at? Click here</div>');
	
	res.write('<div id = "leftsidebar" class = "col-sm-2 hidden-xs nopadding"><img src = "sagalogo.png" class = "img-responsive nopadding" class = "logo">');
		
	res.write('<span class = "timeto col-xs-12">Chapter will be up, today, Saturday, im slacking a bit!</span><br>');
	
	res.write('<span class = "instructionswrapper col-xs-12"><span class = "instructions"><strong><h4>No more planned deaths, I believe, the rest is a free-for-all. The bus arrives in less than 2 days. There is only one spot<br><br>Anyone needs 77,777 votes to wield the Sword of Social Justice<br><br></h4></strong></span></span>');
	
	res.write('</div><div id = "rightsidebar" class = "col-sm-2 hidden-xs"><span class = "makesaga">Saga Chatroom</span><br>'+ chatbox + '</div>');
	
	res.write("<span class = 'col-xs-12 col-sm-8 col-sm-offset-2 nopadding'>");
	
	res.write('<span class = "row"><div class = "col-xs-12 nopadding" id = "chapter">');
		
	res.write('<img class = "col-xs-12 col-sm-6 nopadding img-responsive" src = "../uploads/' + currentChapter.imgsrc + '">');	
	
	res.write('<span class = "col-xs-12 col-sm-6 nopadding">');
	
	res.write('<span class = "col-xs-12 whitewrapper somepadding"><span class = "chaptertitle">' + currentChapter.cname + '</span></span>');
	
	res.write('<span class = "col-xs-12 greyback morepadding"><span class = "chaptertext">' + currentChapter.text + '</span></span>');
	
	res.write('</span></div>');
	
	res.write('</span><br>');
	
	res.write('<h3 class = "previously text-center col-xs-12 makesaga">Characters</h3><br>')
	
	res.write('<span class = "row">');
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "ben"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Ben</span></span></span>');
	
	res.write('<div id = "ben-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + ben.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(ben.posts[ben.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + ben.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + ben.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + ben.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + ben.item + '</span></span>');
	
	
	res.write('</span>');

	
	res.write('</div>');
	
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "beryl"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Beryl</span></span></span>');
	
	res.write('<div id = "beryl-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + beryl.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(beryl.posts[beryl.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + beryl.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + beryl.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + beryl.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + beryl.item + '</span></span>');
	
	
	res.write('</span>');
	res.write('</div>');
	
	
	
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "isaiah"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Isaiah</span></span></span>');
	
	res.write('<div id = "isaiah-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + isaiah.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(isaiah.posts[isaiah.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + isaiah.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + isaiah.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + isaiah.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + isaiah.item + '</span></span>');
	
	
	res.write('</span>');

	
	res.write('</div>');
	
	
	
	
	
	
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "kahari"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Kahari</span></span></span>');
	
	res.write('<div id = "kahari-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + kahari.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(kahari.posts[kahari.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + kahari.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + kahari.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + kahari.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + kahari.item + '</span></span>');
	
	
	res.write('</span>');

	
	res.write('</div>');
	
	
	res.write('</span><span class = "row">');
	
	
	
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "mike"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Mike</span></span></span>');
	
	res.write('<div id = "mike-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + mike.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(mike.posts[mike.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + mike.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + mike.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + mike.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + mike.item + '</span></span>');
	
	
	res.write('</span>');

	
	res.write('</div>');
	
	
	
	
	
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "christopher"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Christopher</span></span></span>');
	
	res.write('<div id = "christopher-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + christopher.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(christopher.posts[christopher.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + christopher.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + christopher.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + christopher.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + christopher.item + '</span></span>');
	
	
	res.write('</span>');

	
	res.write('</div>');
	
	
	
	
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "fig"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Fig</span></span></span>');
	
	res.write('<div id = "fig-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + fig.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(fig.posts[fig.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + fig.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + fig.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + fig.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + fig.item + '</span></span>');
	
	
	res.write('</span>');

	
	res.write('</div>');
	
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "sam"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Sam</span></span></span>');
	
	res.write('<div id = "sam-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + sam.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(sam.posts[sam.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + sam.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + sam.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + sam.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + sam.item + '</span></span>');
	
	
	res.write('</span>');
	
	res.write('</div>');
	
	
	
	res.write('</span>');
	
	res.write('<span class = "row">')
	
	res.write('<div class = "col-xs-6 col-sm-3 charactercard smaller margin"  id = "sam"><span class = "greyback"><span class = "charnamewrapper col-xs-12"><span class = "charactername">Izzy</span></span></span>');
	
	res.write('<div id = "izzy-insert"><img class = "img-responsive col-xs-12" src = "../uploads/' + izzy.imgsrc + '">');	
	
	res.write('<span class = "postspre col-xs-12 nopadding">\"');
		
	res.write(izzy.posts[izzy.posts.length - 1].post);
	
	res.write('\"');
	
	res.write('</span></div>');
	
	res.write('<span class = "charstats">');
	
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "heart.png">' + '<span class = "astat col-xs-9 nopadding">' + izzy.health + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "body.png">' + '<span class = "astat col-xs-9 nopadding">' + izzy.status + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "location.png">' + '<span class = "astat col-xs-9 nopadding">' + izzy.location + '</span></span>');
	res.write('<span class = "row"><img class = "img-responsive col-xs-3 staticon" src = "item.png">' + '<span class = "astat col-xs-9 nopadding">' + izzy.item + '</span></span>');
	
	
	res.write('</span>');
	
	res.write('</div>');
	
	res.write('</span>');
	
	
	
	
	
	
	
	res.write(upvote);
	
	res.write('<h3 class = "previously text-center col-xs-12 makesaga">Previously on The Hunger Games SAGA</h3>')
	
	for (i = chapters.length - 2; i >= 0; i--) { 
		
		res.write('<span class = "row"><div class = "col-xs-12 nopadding" id = "chapter">');
		
		res.write('<img class = "col-xs-12 col-sm-6 nopadding img-responsive" src = "../uploads/' + chapters[i].imgsrc + '">');	
	
		res.write('<span class = "col-xs-12 col-sm-6 nopadding">');
	
		res.write('<span class = "col-xs-12 whitewrapper somepadding"><span class = "chaptertitle">' + chapters[i].cname + '</span></span>');
	
		res.write('<span class = "col-xs-12 greyback morepadding"><span class = "chaptertext">' + chapters[i].text + '</span></span>');
	
		res.write('</span></div>');

	}
	
	res.write('</span>');
	
	
	
	res.end();
	
	
		
});

app.get('/admin/', function (req, res){

  res.end(admin); 
  
}); 


app.get('/player/', function (req, res){

  res.end(player); 
  
}); 

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////
//Chapters

var currentChapter = {};

MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {
	
	var collection = db.collection('chapters');

	 collection.findOne({sentinel: true}, function(err, item) {

	  	 collection.findOne({sentinel: false, number: item.number}, function(err, item) {

			 currentChapter = item;
		 
	         db.close();
		 
 
		 });

	 });

});

var sendto = {}
var doNothing = false;

app.post('/upload/', function (req, res){
 
  var form = new formidable.IncomingForm();
 
  form.parse(req, function(err, fields, files) {
	  
    res.writeHead(200, {'content-type': 'text/html'});
	
	if(fields.password != "Kittens"){
		
		doNothing = true;
	}else{
		
		doNothing = false;
	    res.write('received upload:\n\n');
	}
	
	
	sendto = fields;
	
    res.end(fields.newchapter);
	
  });

  form.on('end', function(fields, files) {
	  
	  if(doNothing == false){
	  
	    /* Temporary location of our uploaded file */
	    var temp_path = this.openedFiles[0].path;
	    /* The file name of the uploaded file */
	    var file_name = this.openedFiles[0].name;
	    /* Location where we want to copy the uploaded file */
	    var new_location = 'uploads/';
	
	
		MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {

			  if(err) { return console.log(err); }else{}

			  	  var collection = db.collection('chapters');
		
		 	   //sentinel
		 	 // var sentinel = {sentinel:true, currentchapter: "prologue", number:0};
   
		 	  //collection.insert(sentinel, {w:1}, function(err, result) {}); 
   
		 	  	   collection.update({sentinel: true}, {$set:{currentchapter: sendto.chaptername}, $inc:{number:1}}, {w:1}, function(err, result) {
 	  	   	
					   collection.findOne({sentinel: true}, function(err, item) {
   		   
							//chapters
			   
						   chapters.push({sentinel: false, text: sendto.newchapter, cname: sendto.chaptername, imgsrc: file_name, number: item.number});
				   
						   currentChapter = {sentinel: false, text: sendto.newchapter, cname: sendto.chaptername, imgsrc: file_name, number: item.number};

						   var newchapter = {sentinel: false, text: sendto.newchapter, cname: sendto.chaptername, imgsrc: file_name, number: item.number};

						   collection.insert(newchapter, {w:1}, function(err, result) {});
						   
					 		  var mailOptions = {
					 		      from: 'Reminder <hunger@saga.com>', // sender address
					 		      to:  'jonathanrobertpedigo@gmail.com, gdg10@hampshire.edu, ajf10@hampshire.edu, cjp12@hampshire.edu, mvd14@hampshire.edu, seg12@hampshire.edu, ibm13@hampshire.edu, kjm13@hampshire.edu, brb12@hampshire.edu, brf11@hampshire.edu, chrisjporz@gmail.com, Isabella.van.ingen@gmail.com', // list of receivers
					 		      subject: 'Theres a new chapter! ' + sendto.chaptername, // Subject line
					 		      text: 'Please tell us your next action using the form @ http://hampshirehungergames.com/player/' + sendto.newchapter, // plaintext body
					 		      html: 'Please tell us your next action using the form @ http://hampshirehungergames.com/player/' + sendto.newchapter, // html body
					 		  };

					 		  
					 		  transporter.sendMail(mailOptions, function(error, info){
					 		      if(error){
					 		          console.log(error);
					 		      }else{
					 		          console.log('Message sent: ' + info.response);
					 		      }
					 		  });
						   
							  
							  
					 		  var mailOptions = {
					 		      from: 'Reminder <hunger@saga.com>', // sender address
					 		      to:  '5857039854@vtext.com, 9739340581@vtext.com, 8023435254@txt.att.net, 8184891884@vtext.com, 9497358743@txt.att.net, 8454052381@vmobl.com, 7743643062@vtext.com, 8479773717@vtext.com, 9175763975@vtext.com, 4135043322@txt.att.net', // list of receivers
					 		      subject: 'Theres a new chapter!', // Subject line
					 		      text: 'View the chapter @ http://hampshirehungergames.com/ Please tell us your next action using the form @ http://hampshirehungergames.com/player/', // plaintext body
					 		      html: 'View the chapter @ http://hampshirehungergames.com/ Please tell us your next action using the form @ http://hampshirehungergames.com/player/'  // html body
					 		  };

					 		  
					 		  transporter.sendMail(mailOptions, function(error, info){
					 		      if(error){
					 		          console.log(error);
					 		      }else{
					 		          console.log('Message sent: ' + info.response);
					 		      }
					 		  });
						   
				           db.close();
						     //', 
					   });
	
			
		 	  	   });
	
	
		 
			 });

		    fs.copy(temp_path, new_location + file_name, function(err) {  
		      if (err) {
		        console.error(err);
		      } else {
		        console.log("success!")
		      }
		    });
	
		}
	
	
	  });
    
});


//////////////////////////////////////////////////
/////////////////////////
//History - Chapters Display

var chapters = [];

MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {
  
	var collection = db.collection('chapters');
	
	collection.find({sentinel:false}).toArray(function(err, items) {
		
		chapters = items;
		
        db.close();
		
		
	});

});


app.get('/history/', function (req, res){
	
    res.writeHead(200, {'content-type': 'text/html'});
  	  
	res.end();
	
});


/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////
//Voting Data Initialization


var votes = {};
// Connect to the db
MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {
	
  if(err) { return console.log(err); }else{  }

  var collection = db.collection('votes');
  
 	//var newvotes = {key: 2,'beryl':0,'sam':0, 'fig':0,'mike':0,'kahari':0, 'isaiah':0, 'ben':0, 'christopher':0};

 	//collection.insert(newvotes, {w:1}, function(err, result) {});
  
	collection.findOne({key:2}, function(err, item) {
			
		votes = item;
			
	});
		
		
});


function updateMongo(){

		var votec = database.collection('votes');	
	
	    votec.update({key:2}, {$set:{fig:votes.fig, mike:votes.mike, beryl:votes.beryl, isaiah:votes.isaiah, kahari:votes.kahari, sam:votes.sam, christopher:votes.christopher, ben:votes.ben, izzy: votes.izzy}}, {w:1}, function(err, result) {
			if(err){ console.log(err); }
	
			console.log('just saved votes');
				
		 });   
	   
		
	 	var chat = database.collection('chat');
		

		for(i = 0; i < userChat2DB.length; i++){	

		    chat.insert({ text: userChat2DB[i].text, nickname: userChat2DB[i].nickname}, {w:1}, function(err, result) {
	
				if(err){ console.log(err); }
	
				console.log('just saved chat');
	
				userChat2DB.pop(i);
								
	
			 });

		}
		

}

setInterval(updateMongo, 50000);

//////////////////////////////////////////////////
/////////////////////////

//Voting and Chat Sockets

io.sockets.on('connection', function(socket) {
	
    socket.emit('update', { votes: votes });
	
	socket.emit('startChat', { chat: userChat.slice(userChat.length - 100, userChat.length) });
	
    socket.on('upVote', function(data){
		
		if(data.name == "fig"){
			
			votes.fig += 1;
			
		}
		if(data.name == "beryl"){
			
			
			votes.beryl += 1;
			
		}
		if(data.name == "mike"){
		
			
			votes.mike += 1;
			
		}	
		
		if(data.name == "kahari"){
			
			votes.kahari += 1;
			
		}
		if(data.name == "isaiah"){
			
			
			votes.isaiah += 1;
			
		}
		if(data.name == "ben"){
			
			
			votes.ben += 1;
			
		}		
    			
		
		if(data.name == "christopher"){
		
		
			votes.christopher += 1;
		
		}
		if(data.name == "sam"){
		
			votes.sam += 1;
		
		}
		if(data.name == "izzy"){
		
			votes.izzy += 1;
		
		}
		
	    io.sockets.emit('update', { votes: votes });
		
	});
	
	
	
    socket.on('downVote', function(data){
		
		if(data.name == "fig"){
			
			votes.fig -= 1;
			
		}
		if(data.name == "beryl"){
			
			votes.beryl -= 1;
			
		}
		if(data.name == "mike"){
			
			votes.mike -= 1;
			
		}	
		
		if(data.name == "kahari"){
			
			
			votes.kahari -= 1;
			
		}
		if(data.name == "isaiah"){
			
			
			votes.isaiah -= 1;
			
		}
		if(data.name == "ben"){
			
			votes.ben -= 1;
			
		}		
    			
		
		if(data.name == "christopher"){
		
			votes.christopher -= 1;
		
		}
		if(data.name == "sam"){
		
			votes.sam -= 1;
		
		}
		
		if(data.name == "izzy"){
		
			votes.izzy -= 1;
		
		}
		
	    io.sockets.emit('update', { votes: votes });
		
	});
	
	
	//recive chats
    socket.on('submitChat', function(data){		
		
	  	  switch(data.nickname){
	  	
	  		  case 'milkshake4me':
		  
	  			  data.nickname = "<span class = 'charnickname'>Beryl</span>";
		  
	  		  break;
	  		  case 'wolverine':
	  
	  			  data.nickname = "<span class = 'charnickname'>Sam</span>";
			  
	  
	  		  break;
	  		  case 'sockdrawer':
			  
	  			  data.nickname = "<span class = 'charnickname'>Isaiah</span>";
	  
	  		  break;
	  		  case 'Invigorate':
			  
	  			  data.nickname = "<span class = 'charnickname'>Kahari</span>";
	  
	  
	  		  break;
	  		  case '2696':
	  
	  			  data.nickname = "<span class = 'charnickname'>Mike</span>";
			  
	  
	  		  break;
	  		  case 'Bootycoconut':
  
	  			  data.nickname = "<span class = 'charnickname'>Ben</span>";
			  
  
	  		  break;
	  		  case 'fluffmonkey24':

	  			  data.nickname = "<span class = 'charnickname'>Christopher</span>";

	  		  break;
	  		  case 'Andrew16':

	  			  data.nickname = "<span class = 'charnickname'>Fig</span>";
			  

	  		  break;
	  		  case 'Kittens':

	  			  data.nickname = "<span class = 'charnickname'>Admin</span>";
		  

	  		  break;
	  		  case 'obikin5':

	  			  data.nickname = "<span class = 'charnickname'>Izzy</span>";

	  		  break;
  		  case 'tellher':

  			  data.nickname = "<span class = 'charnickname'>Team Fuckboy</span>";

  		  break;
		  	case "":
			  
  			  data.nickname = "Peetah";
			  
			  break;
		 	 case " ":
			  
  			  data.nickname = "Katniss";
			  
			  
			  break;
		  	case "  ":
			  
  			  data.nickname = "Snow";
			  
			  
			  break;
	  	  }
		
		userChat.push({text: data.text, nickname: '<span class = "chatname">' + data.nickname + '</span>&nbsp;'});
		
		userChat2DB.push({text: data.text, nickname: '<span class = "chatname">' + data.nickname + '</span>&nbsp;'});
		
		console.log(userChat2DB[0].text);
			
	    io.sockets.emit('enterChat', { text: data.text, nickname: '<span class = "chatname">' + data.nickname + '</span>&nbsp;' });
	
	});
	
		
});


//loadchat
var userChat = [];

var userChat2DB = [];

MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {

   db.collection('chat').find().toArray(function(err, items) {
	   	   
	   userChat = items;

   });

});



/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////
//Character Post Display


var beryl = {};
var sam = {};
var isaiah = {};
var mike = {};
var kahari = {};
var ben = {};
var christopher = {};
var fig = {};
var izzy = {};

beryl.posts = [];
sam.posts = [];
isaiah.posts = [];
mike.posts = [];
kahari.posts = [];
ben.posts = [];
christopher.posts = [];
fig.posts = [];
izzy.posts = [];



//get character posts

MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {

	  if(err) { return console.log(err); }else{}

	  	var collection = db.collection('playerposts');

 		  //collection.insert({post: newpost.post, player: playername}, {w:1}, function(err, result) {}); 

	  	collection.find({player:"Beryl"}).toArray(function(err, items) {
		
	  		beryl.posts = items;
					
	  	});
		
	  	collection.find({player:"Sam"}).toArray(function(err, items) {
		
	  		sam.posts = items;
		
	  	});
	  	collection.find({player:"Isaiah"}).toArray(function(err, items) {
		
	  		isaiah.posts = items;
		
	  	});
		
	  	collection.find({player:"Kahari"}).toArray(function(err, items) {
		
	  		kahari.posts = items;
		
	  	});
		
	  	collection.find({player:"Mike"}).toArray(function(err, items) {
	
	  		mike.posts = items;
		
	  	});
	  	collection.find({player:"Ben"}).toArray(function(err, items) {
		
	  		ben.posts = items;
		
	  	});
	  	collection.find({player:"Christopher"}).toArray(function(err, items) {
		
	  		christopher.posts = items;
		
	  	});
	  	collection.find({player:"Fig"}).toArray(function(err, items) {
		
	  		fig.posts = items;
		
	  	});
	  	collection.find({player:"Izzy"}).toArray(function(err, items) {
		
	  		izzy.posts = items;
		
	  	});
		
}); 


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////
//Character Post Submission

var newpost = {};

app.post('/submit/', function (req, res){
 
  var form = new formidable.IncomingForm();
 
  form.parse(req, function(err, fields, files) {
	  
	 newpost = fields;
	  
    res.writeHead(200, {'content-type': 'text/html'});
	
	  var playername = "";
	    
	  var dontdo = false;	
		
	  if(fields.type == "action"){
	  
		  switch(fields.password){
  	
			  case 'milkshake4me':
	  
				  playername = "Beryl";
	  
			  break;
			  case 'wolverine':
  
				  playername = "Sam";			  
  
			  break;
			  case 'sockdrawer':
		  
				  playername = "Isaiah";
  
			  break;
			  case 'Invigorate':
		  
				  playername = "Kahari";	  
  
			  break;
			  case '2696':
  
				  playername = "Mike";			  
  
			  break;
			  case 'Bootycoconut':

				  playername = "Ben";			  

			  break;
			  case 'fluffmonkey24':

				  playername = "Christopher";

			  break;
			  case 'Andrew16':

				  playername = "Fig";			  

			  break;
			case 'obikin5':
	  			  playername = "Izzy";
			break;
			default: 
			     res.write("<strong>INCORRECT PASSWORD PLEASE TRY AGAIN</strong>");
				 
				 dontdo = true;
	  
		  }
		  
		  if(!dontdo){
			  
			  res.write("<strong>YOUR ACTION HAS BEEN EMAILED TO US, BASED ON YOUR ACTION CHOICE WE WILL WRITE THE NEXT CHAPTER!</strong>");
			  
	  		
		  	var mailOptions = {
			      from: playername + '<hunger@saga.com>', // sender address
			      to: 'jonathanrobertpedigo@gmail.com, gdg10@hampshire.edu', // list of receivers
			      subject: currentChapter.number + ' ' + currentChapter.cname, // Subject line
			      text: playername + ': ' + fields.post, // plaintext body
			      html: playername + ': ' + fields.post // html body
			  };

			  // send mail with defined transport object
			  transporter.sendMail(mailOptions, function(error, info){
			      if(error){
			          console.log(error);
			      }else{
			          console.log('Message sent: ' + info.response);
			      }
			  });
	  
	 	 }	
	  
	  }
	
	res.end();
	
  });

  form.on('end', function(fields, files) { 
	  
	  var dontdo = false;	
	  
	  
	  if(newpost.type == "quote"){
	  
		  switch(newpost.password){
	  	
			  case 'milkshake4me':
		  
				  playername = "Beryl";
				  beryl.posts.push({post: newpost.post, player: "Beryl"});
		  
			  break;
			  case 'wolverine':
	  
				  playername = "Sam";
				  sam.posts.push({post: newpost.post, player: "Sam"});
			  
	  
			  break;
			  case 'sockdrawer':
			  
				  playername = "Isaiah";
				  isaiah.posts.push({post: newpost.post, player: "Isaiah"});
	  
			  break;
			  case 'Invigorate':
			  
				  playername = "Kahari";
				  kahari.posts.push({post: newpost.post, player: "Kahari"});
	  
	  
			  break;
			  case '2696':
	  
				  playername = "Mike";
				  mike.posts.push({post: newpost.post, player: "Mike"});
			  
	  
			  break;
			  case 'Bootycoconut':
  
				  playername = "Ben";
				  ben.posts.push({post: newpost.post, player: "Ben"});
			  
  
			  break;
			  case 'fluffmonkey24':

				  playername = "Christopher";
				  christopher.posts.push({post: newpost.post, player: "Christopher"});

			  break;
			  case 'obikin5':
				  playername = "Izzy";
				  izzy.posts.push({post: newpost.post, player: "Izzy"});
			  break;
			  case 'Andrew16':

				  playername = "Fig";
				  fig.posts.push({post: newpost.post, player: "Fig"});
			  
			  break;
		  default:
			  dontdo = true;
			  res.write("<strong>INCORRECT PASSWORD PLEASE TRY AGAIN!!</strong>");
	
		  
		  }
		 	 if(dontdo == false){
	  				  
				  res.write("<strong>YOUR QUOTE SHOULD BE CHANGED!</strong>");
				  

				  	  var collection = database.collection('playerposts');
	   
			 		  collection.insert({post: newpost.post, player: playername}, {w:1}, function(err, result) {
		 		  						
			 		  }); 
					  
				  }	


		 }
 
	 });
	
		
    
});

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////
//Player HP and Status


beryl.health = 100;
beryl.status = "Normal";
beryl.location = "Somewhere";
beryl.imgsrc = "charactersprite.png";


sam.health = 100;
sam.status = "Normal";
sam.location = "Somewhere";
sam.imgsrc = "charactersprite.png";


isaiah.health = 100;
isaiah.status = "Normal";
isaiah.location = "Somewhere";
isaiah.imgsrc = "charactersprite.png";


mike.health = 100;
mike.status = "Normal";
mike.location = "Somewhere";
mike.imgsrc = "charactersprite.png";


kahari.health = 100;
kahari.status = "Normal";
kahari.location = "Somewhere";
kahari.imgsrc = "charactersprite.png";


ben.health = 100;
ben.status = "Normal";
ben.location = "Somewhere";
ben.imgsrc = "charactersprite.png";


christopher.health = 100;
christopher.status = "Normal";
christopher.location = "Somewhere";
christopher.imgsrc = "charactersprite.png";


fig.health = 100;
fig.status = "Normal";
fig.location = "Somewhere";
fig.imgsrc = "charactersprite.png";

izzy.health = 100;
izzy.status = "Normal";
izzy.location = "Somewhere";
izzy.imgsrc = "charactersprite.png";



MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {
	

	  if(err) { return console.log(err); }else{}

  	  var collection = db.collection('playerstats');
	  
  	 collection.findOne({character: "Beryl"}, function(err, item) {
		  
		 beryl.health = item.health;
		 beryl.status = item.status;
		 beryl.location = item.location;
		 beryl.imgsrc = item.imgsrc;
		 
		 beryl.item = item.item;
		 
		  
	  });
	  
   	 collection.findOne({character: "Sam"}, function(err, item) {
		  
 		 sam.health = item.health;
 		 sam.status = item.status;
 		 sam.location = item.location;
		 sam.imgsrc = item.imgsrc;
		 sam.item = item.item;
		 
		 
		 
		  
 	  });
   	 collection.findOne({character: "Isaiah"}, function(err, item) {
		  
 		 isaiah.health = item.health;
 		 isaiah.status = item.status;
 		 isaiah.location = item.location;
		 isaiah.imgsrc = item.imgsrc;
		 isaiah.item = item.item;
		 
		  
 	  });
   	 collection.findOne({character: "Mike"}, function(err, item) {
		  
 		 mike.health = item.health;
 		 mike.status = item.status;
 		 mike.location = item.location;
		 mike.imgsrc = item.imgsrc;
		 mike.item = item.item;
		  
 	  });
	  
   	collection.findOne({character: "Kahari"}, function(err, item) {
		  
  		 kahari.health = item.health;
  		 kahari.status = item.status;
  		 kahari.location = item.location;
		 kahari.imgsrc = item.imgsrc;
		 kahari.item = item.item;
		 
		 
		  
  	  });
	  
   	 collection.findOne({character: "Ben"}, function(err, item) {
		  
 		 ben.health = item.health;
 		 ben.status = item.status;
 		 ben.location = item.location;
		 ben.imgsrc = item.imgsrc;
		 ben.item = item.item;
		 
		  
 	  });
	  
    collection.findOne({character: "Christopher"}, function(err, item) {
		  
  		christopher.health = item.health;
  		christopher.status = item.status;
  		christopher.location = item.location;
	 christopher.imgsrc = item.imgsrc;
	 christopher.item = item.item;
		
		 
		  
  	  });
	  
    collection.findOne({character: "Fig"}, function(err, item) {
	  
  		 fig.health = item.health;
  		 fig.status = item.status;
  		 fig.location = item.location;
		 fig.imgsrc = item.imgsrc;
		 fig.item = item.item;
		 
	 
	  
  	  });
	  
      collection.findOne({character: "Izzy"}, function(err, item) {
	  
    		 izzy.health = item.health;
    		 izzy.status = item.status;
    		 izzy.location = item.location;
  		 	izzy.imgsrc = item.imgsrc;
   		 izzy.item = item.item;
		 
	 
	  
    	 });
	  
	  
 });



app.get('/admin/characters/', function (req, res){

    res.end(characteradmin); 

  
}); 


app.post('/updatecharacter/', function (req, res){
 
  var form = new formidable.IncomingForm();
 
  form.parse(req, function(err, fields, files) {
	  
	 characterinfo = fields;
	  
    res.writeHead(200, {'content-type': 'text/html'});
	
	
	if(fields.password != "Kittens"){
		
		doNothing = true;
	}else{
		
		doNothing = false;
	    res.write('received upload:\n\n');
	}
	
	res.end();
	
	
	
  });

  form.on('end', function(fields, files) { 
	  
	  if(!doNothing){
		  	  
      /* Temporary location of our uploaded file */
      var temp_path = this.openedFiles[0].path;
      /* The file name of the uploaded file */
      var file_name = this.openedFiles[0].name;
      /* Location where we want to copy the uploaded file */
      var new_location = 'uploads/';
	  	  
	  
		MongoClient.connect("mongodb://heroku_app32117565:c0a0k9udgdggth2tr9sueje009@ds051720.mongolab.com:51720/heroku_app32117565", function(err, db) {
			
   		  //collection.insert({character: characterinfo.character, status: characterinfo.status, health: characterinfo.health, location: characterinfo.location, imgsrc: characterinfo.imgsrc}, {w:1}, function(err, result) {}); 
		
			  if(err) { return console.log(err); }else{}
			  
			  
		  	  var collection = db.collection('playerstats');
			  
			  if(characterinfo.yesstatus == "checked"){

	 			  collection.update({character: characterinfo.character}, {$set:{status: characterinfo.status}}, {w:1}, function(err, result) {
  	  		       				  
				
				   }); 
			  	
		  		}
				
			  if(characterinfo.yeshealth == "checked"){
		
	 			  collection.update({character: characterinfo.character}, {$set:{health: characterinfo.health}}, {w:1}, function(err, result) { 
		  
			
				  }); 
		
		
			  }
				
			  if(characterinfo.yesloc == "checked"){

	 			  collection.update({character: characterinfo.character}, {$set:{location: characterinfo.location}}, {w:1}, function(err, result) { 
  
					
				  }); 
	
			  }
				
			  if(characterinfo.yesimg == "checked"){

	 			  collection.update({character: characterinfo.character}, {$set:{imgsrc: file_name}}, {w:1}, function(err, result) {					
								
											

				   }); 

			  }
			  
			  if(characterinfo.yesitem == "checked"){

	 			  collection.update({character: characterinfo.character}, {$set:{item: characterinfo.item}}, {w:1}, function(err, result) {					
								
											

				   }); 

			  }
				
	
   	  	 });
		 

      fs.copy(temp_path, new_location + file_name, function(err) {  
        if (err) {
          console.error(err);
        } else {
          console.log("success!")
        }
      });
			  
			  switch(characterinfo.character){
	  	
				  case 'Beryl':
					  
			  
					  if(characterinfo.yesstatus == "checked"){

						  beryl.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  beryl.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  beryl.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  beryl.imgsrc = file_name;
				
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  beryl.item = characterinfo.item;
				
					
					  }
		  
		  
				  break;
				  case 'Sam':
					  
					  if(characterinfo.yesstatus == "checked"){

						  sam.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  sam.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  sam.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  sam.imgsrc = file_name;
				
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  sam.item = characterinfo.item;
				
					
					  }
	  
	  
				  break;
				  case 'Isaiah':
			  
			  
					  if(characterinfo.yesstatus == "checked"){

						  isaiah.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  isaiah.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  isaiah.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  isaiah.imgsrc = file_name;
				
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  sam.item = characterinfo.item;
				
					
					  }
	  
				  break;
				  case 'Kahari':
					  
					  if(characterinfo.yesstatus == "checked"){

						  kahari.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  kahari.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  kahari.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  kahari.imgsrc = file_name;
				
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  kahari.item = characterinfo.item;
				
					
					  }
			  
	  
				  break;
				  case 'Mike':
	  
			  
					  if(characterinfo.yesstatus == "checked"){

						  mike.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  mike.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  mike.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  mike.imgsrc = file_name;
						  						  
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  mike.item = characterinfo.item;
				
					
					  }
	  
				  break;
				  case 'Ben':
  
					  if(characterinfo.yesstatus == "checked"){

						  ben.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  ben.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  ben.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  ben.imgsrc = file_name;
				
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  ben.item = characterinfo.item;
				
					
					  }
			  
  
				  break;
				  case 'Christopher':
					  
					  if(characterinfo.yesstatus == "checked"){

						  christopher.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  christopher.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  christopher.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  christopher.imgsrc = file_name;
				
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  christopher.item = characterinfo.item;
				
					
					  }


				  break;
				  case 'Fig':
					  
					  if(characterinfo.yesstatus == "checked"){

						  fig.status = characterinfo.status;
			  	
				  		}
				
					  if(characterinfo.yeshealth == "checked"){
				
						  fig.health = characterinfo.health;
				
				
					  }
					  if(characterinfo.yesloc == "checked"){
				
						  fig.location = characterinfo.location;
				
					
					  }
					  if(characterinfo.yesimg == "checked"){
				
						  fig.imgsrc = file_name;
				
					
					  }
					  if(characterinfo.yesitem == "checked"){
				
						  fig.item = characterinfo.item;
				
					
					  }

				  break;
			  case 'Izzy':
				  
				  if(characterinfo.yesstatus == "checked"){

					  izzy.status = characterinfo.status;
		  	
			  		}
			
				  if(characterinfo.yeshealth == "checked"){
			
					  izzy.health = characterinfo.health;
			
			
				  }
				  if(characterinfo.yesloc == "checked"){
			
					  izzy.location = characterinfo.location;
			
				
				  }
				  if(characterinfo.yesimg == "checked"){
			
					  izzy.imgsrc = file_name;
			
				
				  }
				  if(characterinfo.yesitem == "checked"){
			
					  izzy.item = characterinfo.item;
			
				  }

			  break;
			  }				  	  
		 
	 }
	  
  });
  
});

