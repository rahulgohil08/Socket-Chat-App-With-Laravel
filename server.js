const express = require('express');

const app = express();

const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: {origin: "*"}
});


app.get('/', () => {
    return "Hello From express"
})

let socketsConnected = []


io.on('connection', (socket) => {
    console.log('Connected', socket.id);

    socketsConnected.push(socket.id)
    io.emit('total-sockets', socketsConnected.length);


    socket.on('chat-message', (message) => {
        console.log("Catched Message on server is ::: " + message);

        io.emit('chat-message', message);
        // socket.broadcast.emit('chat-message', message);
    });


    socket.on('disconnect', () => {
        console.log('Disconnected', socket.id);

        socketsConnected.pop(socket.id)
        io.emit('total-sockets', socketsConnected.length);

    });
});

server.listen(3000, () => {
    console.log('Server is running');
});
