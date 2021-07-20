const express = require('express');
const axios = require('axios');


const port = process.env.PORT || 5000

const hostUrl = "http://192.168.0.140"
const hostPort = "8000"

const app = express();

const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: {origin: "*"}
});

app.get('/', function (req, res) {
    res.send('Hello From Express : ', port);
})


/*---------------- Server Listening ---------------*/

server.listen(port, () => {
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

        message.created_at = new Date().toISOString();

        console.log("Message to be Stored ::: " + message);

        // io.emit('chat-message', message);

        sendChat(message)


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

    let url = hostUrl + ":" + hostPort + "/api"
    // let url = hostUrl

    let axiosConfig = {
        headers: {
            'Content-Type': 'application/json;charset=UTF-8',
            "Access-Control-Allow-Origin": "*",
        }
    };

    axios.post(url + '/chat/store', data, axiosConfig)
        .then(function (response) {
            console.log("Axios from server :: ", response.data);

            io.emit('chat-message', response.data);

        })
        .catch(function (error) {
            console.log(error.response.data);
        });

}
