var debugMode = 0;
var client;
/*
	Application class
*/

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

if (typeof navigator.getUserMedia != 'function') {
}else{
}
// window.URL
window.URL = window.URL || window.webkitURL;
// Session Descriptor
try {
	SessionDescription = RTCSessionDescription || mozRTCSessionDescription;
} catch(e) {
	SessionDescription = mozRTCSessionDescription;
}


function Rulette(){
	this.namespace = '/chatroulette';
	this.socket;this.iceReady = 0;
	this.socketURL = 'http://localhost:1240'+this.namespace;
	this.media = {"audio": true, "video": {"mandatory": {}, "optional": [{RtpDataChannels: true}]}};
	this.idStatusBox = 'statusbox';
	this.nickname = 'Spippotato';
	this.idNickBox = 'nickbox';
	this.idWarnBox = 'warnbox';
	this.idRuletteBox = 'ruletteBox';
	//this.pc_config = {"iceServers":[{"url":"stun:23.21.150.121"}]};
	this.localstream;this.pc;this.remotestream;this.sendChannel;
}

Rulette.prototype.validateInput = function (str){
     return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

Rulette.prototype.onConnect = function () {
	
	//set nickname
	client.socket.emit('joinRulette',{nickname: client.nickname, com: getURLParameter('c')});
	//client.showNickbox();	
}

Rulette.prototype.onDisconnect = function () {
	
}

Rulette.prototype.showbutton = function (){
	document.getElementById('ruletta').style.display = 'block';
}

Rulette.prototype.onUser = function (data) {
	client.showbutton();
	debug('- onUser called) ');
	debug('- recived data:', data);
	client.setStatusBox(''+client.nickname+' <b>'+client.validateInput(data.nickname)+'</b>');

}

Rulette.prototype.onRemoteStream = function (data) {
	debug('- Remote Stream Attached! OK) ');
	debug(data);
	var remoteCam = document.getElementById("remotevideo");
	remoteCam.style.display = 'block';
	//remoteCam.style.height = '43%';
  	remoteCam.autoplay = true;
	remoteCam.src = window.URL ? window.URL.createObjectURL(data.stream) : data.stream;
	document.querySelector('input#toSend').disabled = false;

	
}

Rulette.prototype.onIceCandidate = function (data) {
	client.socket.emit('onIceCandidate',data);
}

Rulette.prototype.createPeer = function() {
	client.iceReady = 0;
	try{
		if (typeof client.pc == 'object'){
			try { client.pc.close(); } catch(e) {}
		}
		if (typeof RTCPeerConnection == 'function') {
			client.pc = new RTCPeerConnection(client.pc_config);
		}else if (typeof mozRTCPeerConnection == 'function') {
			client.pc = new mozRTCPeerConnection(client.pc_config);			
		}else if (typeof webkitRTCPeerConnection == 'function') {
			client.pc = new webkitRTCPeerConnection(client.pc_config);
		}
		//attacco i porcodiohandledemmerda 
		client.pc.onicecandidate = this.onIceCandidate;
		client.pc.onconnection = function(){};
		client.pc.onaddstream = this.onRemoteStream;
		client.pc.onremovestream = function(){
			document.getElementById('toSend').disabled = 'disabled';
		};
		client.pc.ondatachannel = function(){};
		//client.pc.ongatheringchange = function(){};
		client.pc.onstatechange = function(){};
		//client.pc.onicechange = function(){};
		client.pc.onnegotiationneeded = function(){};
		//attacco lo stream locale porco-dio-canaglia.
		client.pc.addStream(client.localstream);
		client.pc.ondatachannel = this.onDataChannel;
		this.sendChannel = client.pc.createDataChannel('Chan',{reliable: false});
		this.sendChannel.onmessage = this.onChannelMessage;
		return true;
	}catch(e){ debug(e);return false; }
}
/* SDP MERDAFUNCTION */
Rulette.prototype.onChannelMessage = function (event){
	try {
		console.log(event,event.data,event.data.length);
		var chatbox = document.getElementById('chat');	
		if (event.data.toString() == 'Chan') {
			chatbox.value = ''+"\n";
		}else{	
			$(chatbox).prepend('<span class = "friend-chat-name">Friend</span>: '+event.data+ "<br>");
		}
	}catch(e){
		console.log(e);
	}
}
Rulette.prototype.onDataChannel = function (event) {
	rchan = event.channel;
	console.log('event',event,event.channel);
	rchan.onmessage = client.onChannelMessage;
}
Rulette.prototype.sendMsg = function () {
	var text = document.getElementById('toSend').value;
	var chatbox = document.getElementById('chat');
	
	$(chatbox).prepend('<span class = "you-chat-name">You</span>: '+text + '<br>');
	
	this.sendChannel.send(text);
	document.getElementById('toSend').value = '';
}

Rulette.prototype.makeOffer = function (desc) {
	client.pc.setLocalDescription(desc);
	client.socket.emit('onOffer',desc);
}

Rulette.prototype.makeAnswer = function (desc) {
	client.pc.setLocalDescription(desc);
	client.socket.emit('onAnswer',desc);
	client.iceReady = 1;
}

Rulette.prototype.recAnswer = function (data) {
	client.iceReady = 1;
	debug(data);
	client.pc.setRemoteDescription(new SessionDescription(data));
}

Rulette.prototype.recOffer = function(data) {
	client.createPeer();
	client.pc.setRemoteDescription(new SessionDescription(data));
	client.pc.createAnswer(client.makeAnswer,function(e){ debug('error'); debug(e); },{mandatory:{OfferToReceiveAudio:true,OfferToReceiveVideo:true}});
}

Rulette.prototype.recIce = function (data) {
	if (!client.iceReady) { debug('Not working');return; }
	debug('--- Set ICE server candidate');
	//debug(data);
	if (data.candidate === null) {debug('no-candidate'); return; }
	try {
		var RTCIceCandidate = window.mozRTCIceCandidate || window.webkitRTCIceCandidate || window.RTCIceCandidate;
		var oDioPorco = new RTCIceCandidate({ sdpMLineIndex: data.candidate.sdpMLineIndex, candidate: data.candidate.candidate });
		client.pc.addIceCandidate(oDioPorco);
	} catch(e){
		console.log(e);
	}
}

Rulette.prototype.callUser = function (data) {
	client.showbutton();
	//ora devi chiamare cazzaro
	if (client.createPeer()){
		debug('- Peer object Creation OK! )');
		client.pc.createOffer(client.makeOffer,function(e){ debug('error'); debug(e); },{mandatory:{OfferToReceiveAudio:true,OfferToReceiveVideo:true}});	
	}else{
		debug('Peer object creation filed');	
	}
}

Rulette.prototype.onWait = function (data) {
	if (typeof client.pc == 'object'){
		try { client.pc.close(); } catch(e) {}
	}
	var remoteCam = document.getElementById("remotevideo");
	remoteCam.style.display = 'none';
	document.getElementById('chat').value = '';
	document.getElementById('toSend').disabled = "disabled";
}

Rulette.prototype.onConnectError = function(){
	debug(this);
}

Rulette.prototype.onConnection = function () {
}

Rulette.prototype.setStatusBox = function (msg) {
	debug('[STATUS] : '+msg);
	try{ document.getElementById(this.idStatusBox).innerHTML = msg; } catch(e){
	}
}

Rulette.prototype.showNickbox = function () {
	debug(this.idNickBox);
	
	try {
		document.getElementById(this.idNickBox).style.display = 'block';
		document.getElementById(this.idWarnBox).style.display = 'none';
		this.joinRulette();
		
	} catch (e) {
	}
}

Rulette.prototype.getUserMedia = function () {
	try {
		navigator.getUserMedia(this.media,this.onMediaSuccess,this.onMediaFailure);
	}catch (e){

	}	
	
}

var wasAvailable = false;
var didOnce = false;

Rulette.prototype.onMediaSuccess = function (localStream) {


	client.localstream = localStream;
 	var myvideo = document.createElement("video");
  	myvideo.autoplay = true;
  	myvideo.setAttribute("id",'mycam');
	myvideo.muted = 'muted';
//	myvideo.style.height = '43%';
	myvideo.setAttribute('muted',true);
	$(myvideo).addClass('myCamera');
	$(myvideo).addClass('img-responsive');
		
	myvideo.src = window.URL ? window.URL.createObjectURL(localStream) : localStream;
	document.getElementById(client.idRuletteBox).appendChild(myvideo);

	client.showNickbox();
	
	if(didOnce == false){
	
		user_enter(getURLParameter('service'), getURLParameter('c'));
	
	}
	
	wasAvailable = true;
	
	didOnce = true;
}

Rulette.prototype.onMediaFailure = function (err) {
	alert('We need your webcam dude');
}

Rulette.prototype.connect = function(){
	try {
		this.socket = io.connect(this.socketURL);

		this.socket.on('connecting',this.onConnection);
		this.socket.on('connect',this.onConnect);
		this.socket.on('disconnect',this.onDisconnect);
		this.socket.on('connect_failed', function () {  });
		this.socket.on('error', this.onConnectError);
		this.socket.on('reconnect_failed', function () {});
		this.socket.on('reconnect', function () {});
		this.socket.on('reconnecting', function () {});
		this.socket.on('message', function (message, callback) {});
		this.socket.on('anything', function(data, callback) {});

		this.socket.on('onUser',this.onUser);
		this.socket.on('callUser',this.callUser);
		this.socket.on('onWait',this.onWait);
		
		//s.d.p =  sesso dio porco
		this.socket.on('recOffer', this.recOffer);
		this.socket.on('recAnswer',this.recAnswer);
		this.socket.on('recIce',this.recIce);
	} catch (e){
		return false;
	}

	return true;
}

Rulette.prototype.showBrowserIncompatibleMessage = function () {
	alert('You browser is not supported for Zombledon , please use Chrome.');
}

Rulette.prototype.checkBrowser = function (){
	try{
		debug('--Checking UserMedia--');
		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia || navigator.msGetUserMedia;
		
		if (typeof navigator.getUserMedia != 'function') {
			return false;
		}else{
			debug('- UserMedia OK) ');
		}
		// window.URL
		window.URL = window.URL || window.webkitURL;
		// Session Descriptor
		SessionDescription = RTCSessionDescription || mozRTCSessionDescription;
		
		
		
	}catch(e){ 
		return false; 
	}
	return true;
}


Rulette.prototype.joinRulette = function () {

	try {

		this.nickname = this.validateInput((document.getElementsByName('nickname')[0].value.length > 0 ? document.getElementsByName('nickname')[0].value : client.nickname));	
		debug(this.nickname);
		document.getElementById(this.idNickBox).style.display = 'none';
		this.connect();
	} catch(e) {
	}

}

Rulette.prototype.ruletta = function () {
	document.querySelector('input#toSend').disabled = true;

	client.socket.emit('ruletta', {com: getURLParameter('c')});
}

Rulette.prototype.fsendMsg = function () {
	console.log(e);
	if(e.keyCode == 13) {
		this.sendMsg();
	}
}

function debug(arg) {
	if (!debugMode) { return false; }
	console.log(arg);
}

function startZomble(){

	try {
		client = new Rulette();
		//debug('- Play browser check )');
		if (!client.checkBrowser()) {
			client.showBrowserIncompatibleMessage();
		}else{
			
			client.getUserMedia();
			
		}
	}catch(e){ 
		alert('You browser is not supported for Zombledon, please use Chrome.');
	}

	
}
function diop (e) {
	if (e.keyCode == 13) {
		client.sendMsg();
	}
}
