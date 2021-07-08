require('./jquery.min.js');
require('./bootstrap.min.js');



import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// import Echo from "laravel-echo"
// window.io = require('socket.io-client');

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001' // this is laravel-echo-server host
// });
