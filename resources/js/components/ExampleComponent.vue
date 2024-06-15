<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h1>Online Users: <span id="onlineUsersCount"></span></h1>
                    <div class="card-header">
                        Chat
                    </div>
                    <div class="card-body">
                        <div v-for="(message, index) in state.messages" :key="index">
                            <li>{{ message.text }}</li>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="display:flex;" class="form-group">
                            <input type="text" class="form-control" placeholder="Type your message" v-model="state.text"
                                @keyup.enter="sendMessage">
                            <button class="btn btn-primary" @click="sendMessage">Send</button>
                        </div>
                    </div>
                </div>
                <br />
                <p>To Scanner or <a href="http://localhost:8000/camera/scanners"> Click </a> </p>
                <p>To CCTV <a href="http://localhost:8000/camera/cctv"> Click </a> </p>
                <qrcode-vue :value="state.value" :size="state.size" level="H" />
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, watchEffect, onMounted } from 'vue';
import axios from 'axios';
import io from 'socket.io-client';
import QrcodeVue from 'qrcode.vue'

const socket = io(':6999');

export default {
    components: {
        QrcodeVue,
    },
    setup() {
        const state = reactive({
            text: '',
            messages: [],
            value: JSON.stringify({'text': 'Scanner Success!', 'status': 'success', 'type': 'qr'}),
            size: 200,
        });

        onMounted(() => {
            socket.on("connect", () => {
                console.log('Socket Connect Status: ' + socket.connected);
                console.log('Socket ID: ' + socket.id);
            });

            socket.on('chatMessage', function () {
                fetchMessages();
            });

            socket.on('scanner', function (msg) {
                alert(msg);
            });

            socket.on('updateOnlineUsers', (count) => {
                document.getElementById('onlineUsersCount').innerText = count;
            });
        });

        const fetchMessages = () => {
            axios.get('/api/fetch/messages')
                .then(res => {
                    state.messages = res.data;
                })
                .catch(err => {
                    console.error('Error fetching messages:', err);
                });
        };

        const sendMessage = () => {
            axios.post('/api/create/message', { text: state.text })
                .then(res => {
                    console.log('Message sent:', res.data.text);
                    socket.emit('chatMessage', res.data.text);
                    fetchMessages();
                    state.text = '';
                })
                .catch(err => {
                    console.error('Error sending message:', err);
                });
        };

        watchEffect(() => {
            fetchMessages();
        });

        return {
            state,
            sendMessage,
        };
    },
};
</script>
