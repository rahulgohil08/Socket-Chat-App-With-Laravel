@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card py-3 mt-3">


                <div class="card-body">
                    <h5 class="card-title">Socket Playground</h5>


                    <p>Total Players : @{{total_sockets}}</p>

                    <form class="mt-4" @submit.prevent="sendMessage">


                        <div class="form-group">
                            <label for="msg">Enter Message</label>
                            <input v-model="msg" type="text" class="form-control" id="msg" required>
                        </div>


                        <button type="submit" class="btn btn-primary p-2 mt-3">Let's Play</button>


                    </form>


                    <ul class="mt-5">
                        <li v-for="message in messages">

                            <div v-if="message.sender_id == user_id">
                                @{{ message.message }} (You)
                            </div>

                            <div v-else>
                                @{{ message.message }} ({{$receiver->name}})
                            </div>

                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>



@endsection


@section('scripts')
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"
            integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU"
            crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
            integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        // const server = '192.168.0.140';
        const server = "https://laravel-socket-app.herokuapp.com";
        // const port = '3000';

        // const socket = io(server + ":" + port);
        const socket = io(server);


        // const hostUrl = server
        // const hostPort = "8000"

        // let url = "http://" + hostUrl + ":" + hostPort + "/api"
        let url = server


        const app = new Vue({
            el: '#app',

            mounted() {

                this.fetchOldMessages()





                socket.on('connect', function () {
                    console.log('Socket Connected Client Side')
                });


                socket.on('total-sockets', (count) => {
                    console.log('Total Connections ::: ', count)
                    this.total_sockets = count
                });


                socket.on('chat-message', (message) => {
                    console.log('Message Received Client Side ::: ', message)


                    if ((message.sender_id == {{auth()->id()}} && message.receiver_id == {{$receiver->id}}) || (message.receiver_id == {{auth()->id()}} && message.sender_id == {{$receiver->id}}) ) {

                        this.messages.push(message);

                    }
                });
            },

            data: {
                messages: [],
                msg: '',
                total_sockets: '0',
                user_id: {{auth()->id()}},
                receiver_id: {{$receiver->id}},
            },

            methods: {
                sendMessage: function () {

                    let data = {
                        sender_id: this.user_id,
                        receiver_id: this.receiver_id,
                        message: this.msg,
                    }

                    socket.emit('chat-message', data);

                    this.msg = ''
                },

                fetchOldMessages: function () {

                    let self = this

                    axios.get(url + '/chat/fetch', {
                        params: {
                            sender_id: {{auth()->id()}},
                            receiver_id: {{$receiver->id}},
                        }
                    })
                        .then(function (response) {
                            console.log(response.data);

                            self.messages = response.data

                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                }

            }
        });


    </script>

@endsection
