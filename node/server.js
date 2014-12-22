var namespace = '/chatroulette';

function searchPartner(socket) {
	//socket.randomClient = '';

	if ( io.of(namespace).clients('hell').length == 0 ) {
		socket.join('hell');
		socket.emit('onWait',{data: 'suca'});
	} else {

		var amigo = io.of(namespace).clients('hell')[0];
		if (amigo.id == socket.randomClient){
			socket.join('hell');
			socket.emit('onWait',{data: 'suca'});			
			return;
		}
		amigo.leave('hell');

		socket.randomClient = amigo.id;
		amigo.randomClient = socket.id;
		if (amigo.id == socket.id){
				socket.join('hell');
				socket.emit('onWait',{data: 'suca'});
				return;
		} 
		
		socket.emit('callUser',{nickname: amigo.nickname});
		amigo.emit('onUser',{nickname: socket.nickname})
	}
}

try {
	var io = require('socket.io').listen(1240);
}catch(e){
}

io.of(namespace).on('connection', function (socket) {

		socket.randomClient = '';
		socket.nickname = '';
		socket.canrulet = 1;
		socket.on('joinRulette', function (data) {
			socket.nickname = data.nickname.length == 0 ? 'Spippottato' : data.nickname;
			searchPartner(socket);
		
		});
	
	socket.on('ruletta', function() {

		var rom = io.of(namespace).manager.roomClients[socket.id][namespace+'/hell'];
		if (typeof rom != 'undefined' || !socket.canrulet || rom){
			return;
		}
		if (socket.randomClient.length > 0){
			searchPartner(io.of(namespace).socket(socket.randomClient));
		}
		searchPartner(socket);
	});	

	socket.on('onAnswer',function(data){
		var amigofrogio = io.of(namespace).socket(socket.randomClient);
		amigofrogio.json.emit('recAnswer',data);
	});
	
	socket.on('onOffer', function(data) {
		var amigofrogio = io.of(namespace).socket(socket.randomClient);
		amigofrogio.json.emit('recOffer',data);
	});
	
	socket.on('onIceCandidate', function(data){
		var amigofrogio = io.of(namespace).socket(socket.randomClient);
		amigofrogio.json.emit('recIce',data);
	});
	
	socket.on('disconnect',function(){
		if (socket.randomClient.length > 0){

			searchPartner(io.of(namespace).socket(socket.randomClient));
		}
	//	console.log(socket.broadcast.emit('userDisconnect', {client: socket.id}));
	//	console.log('--------SOCKET STRUCTURE AFTER DISCONNECT -------');			
	});
});
