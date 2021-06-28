const express = require('express');
const axios = require('axios');
const ip = require('ip');


const port = process.env.PORT || 3000

const hostUrl = "192.168.0.140"
const hostPort = "8000"

const app = express();

const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: { origin: "*" }
});


/*---------------- Server Listening ---------------*/

server.listen(port, hostUrl, () => {
    console.log('Server is running');
});


/*---------------- Socket Connection Established ---------------*/

let socketsConnected = []

io.on('connection', handleSocket);


/*---------------- Handle Socket  ---------------*/


function handleSocket(socket) {

    console.log('Connected', socket.id);

    socketsConnected.push(socket.id)
    io.emit('total-sockets', socketsConnected.length);


    socket.on('chat-message', (message) => {
        console.log("Catched Message on server is ::: " + message);


        // let data = {
        //     sender_id: 1,
        //     receiver_id: 2,
        //     message: message,
        // }

        console.log("Received From Client ::: ", message)

        sendChat(message)


        io.emit('chat-message', message);
        // socket.broadcast.emit('chat-message', message);
    });


    socket.on('disconnect', () => {
        console.log('Disconnected', socket.id);

        socketsConnected.pop(socket.id)
        io.emit('total-sockets', socketsConnected.length);

    });

}


/*---------------- Send Chat to DB using Axios ---------------*/

function sendChat(data) {

    let url = "http://" + hostUrl + ":" + hostPort + "/api"

    axios.post(url + '/chat/store', data)
        .then(function(response) {
            console.log(response.data);
        })
        .catch(function(error) {
            console.log(error);
        });

}