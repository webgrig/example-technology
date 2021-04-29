const express =  require('express');
const app = express();

const http =  require('http').Server(app);
const io = require('socket.io')(http, {
    cors: {}
});
const Redis = require('ioredis');

const clientAddEvent = new Redis(6379, "127.0.0.1");
const clientConnectEvent = new Redis(6379, "127.0.0.1");
const redisClient = new Redis(6379, "127.0.0.1");

let curCurrencies = [];

clientAddEvent.psubscribe("currency", (err, count) => {});
clientConnectEvent.psubscribe("connection", (err, count) => {});

async function hgetallCallback(result) {
    for (var i = 0; i < result.length; i++) {
        await redisClient.hgetall(result[i], (err, object) => {
            let curData = [];
            let date = result[i].split('_')[1];
            curData[date] = JSON.stringify(object);
            curCurrencies[date] = curData[date];
        });
    }
    return curCurrencies;
}
function getRedisCurrencies(){
    redisClient.keys('currency_*').then(function (result) {
        hgetallCallback(result).then(function (res){
            clientConnectEvent.on("pmessage", function (pattern, channel, message) {
                for (date in res){
                    io.emit(channel, [date, res[date]]);
                }
            });
        });
    });
}

getRedisCurrencies();


clientAddEvent.on("pmessage", (pattern, channel, message) => {
    message = JSON.parse(message);
    redisClient.hgetall('currency_' + message.data.date).then((result) => {
        let date = message.data.date;
        curCurrencies[date] = JSON.stringify(result);
        io.emit(channel, [date, curCurrencies[date]]);
    });
});

http.listen(3000, function (){
    console.log('Listening on Port: 3000')
});
