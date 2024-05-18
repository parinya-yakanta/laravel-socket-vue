import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';
const app = express();
import cors from 'cors';

const http = createServer(app);

const allowedOrigins = ['http://localhost:8000', 'http://192.168.1.35:8000'];

app.use(cors({
    origin: function (origin, callback) {
        if (!origin) return callback(null, true);
        if (allowedOrigins.indexOf(origin) === -1) {
            const msg = 'The CORS policy for this site does not allow access from the specified origin.';
            return callback(new Error(msg), false);
        }
        return callback(null, true);
    },
    methods: ['GET', 'POST'],
}));

const io = new Server(http, {
    cors: {
        origin: allowedOrigins,
        methods: ['GET', 'POST']
    },
});

io.on('connection', function (socket) {
    console.log('Server socket connected ', socket.id)

    socket.on('chatMessage', function (msg) {
        console.log('socket by : ', socket.id, ' message: ' + msg)
        io.emit('chatMessage', msg)
    })

    socket.on('scanner', function (msg) {
        console.log('socket by : ', socket.id, ' message: ' + msg)
        io.emit('scanner', msg)
    })

});

var port = process.env.PORT || 6999;

http.listen(port, function () {
    console.log('Run Port // localhost:', port)
})
