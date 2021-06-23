<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Socket Chat APP</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
          integrity="undefined" crossorigin="anonymous">
</head>


<body>

<div class="container" id="app">

    <div class="row">
        <div class="col-12">
            <div class="card py-3 mt-3">


                <div class="card-body">
                    <h5 class="card-title">Socket Playground</h5>


                    <p>Total Players : @{{total_sockets}}</p>

                    <form class="mt-4" @submit.prevent="sendMessage">


                        <div class="form-group">
                            <label for="msg">Enter Message</label>
                            <input v-model="msg" type="text" class="form-control" id="msg">
                        </div>


                        <button type="submit" class="btn btn-primary p-2 mt-3">Let's Play</button>


                    </form>


                    <ul class="mt-5">
                        <li v-for="message in messages">@{{ message}}</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>


</div>


</body>
</html>

<script src="https://cdn.socket.io/4.0.1/socket.io.min.js"
        integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>


<script>

    const server = '127.0.0.1';
    const port = '3000';

    const socket = io(server + ":" + port);

    const app = new Vue({
        el: '#app',

        mounted() {

            socket.on('connect', function () {
                console.log('Socket Connected Client Side')
            });


            socket.on('total-sockets', (count) => {
                console.log('Total Connections ::: ', count)
                this.total_sockets = count
            });


            socket.on('chat-message', (message) => {
                console.log('Message Received Client Side ::: ', message)
                this.messages.push(message)
            });
        },

        data: {
            messages: [],
            msg: '',
            total_sockets: '0',
        },

        methods: {
            sendMessage: function () {

                socket.emit('chat-message', this.msg);
                this.msg = ''
            }
        }
    });


</script>


