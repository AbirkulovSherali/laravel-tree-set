// let io = require('socket.io')(6001);
let Redis = require('ioredis');
let redis = new Redis();

redis.psubscribe('*', function(error, count){
    console.log(error, count)
});

redis.on('pmessage', function(pattern, channel, data){
    // data = JSON.parse(data);
    // io.emit(channel, "I'm alive!");
    console.log(channel);
})

// io.on('connection', function(socket){
//     socket.on('chat', function(data){
//         socket.broadcast.emit('new-message', data);
//         console.log(data);
//     });
// })
