// MQTT Start
const clientId = "mqttjs_" + Math.random().toString(16).substr(2, 8);
const host = "wss://broker.emqx.io:8084/mqtt";
const options = {
    keepalive: 60,
    clientId: clientId,
    protocolId: "MQTT",
    protocolVersion: 4,
    clean: true,
    reconnectPeriod: 1000,
    connectTimeout: 30 * 1000,
    will: {
        topic: "WillMsg",
        payload: "Connection Closed abnormally..!",
        qos: 0,
        retain: false,
    },
};

function saklar(id, value) {
    var tombol = document.getElementById(id);
    if (value == 1) {
        tombol.classList.add("on");
        return "on";
    } else {
        tombol.classList.remove("on");
        return "off";
    }

}

function monitor(id, value) {
    var container = document.getElementById(id);
    container.innerHTML = value;
}

const client = mqtt.connect(host, options);

// Start settings here
client.on("connect", function () {
    console.log("Connected to MQTT broker");
    client.subscribe("myEsp/lucio/monitor");
    client.subscribe("myEsp/lucio/state");
    client.subscribe("myEsp/lucio/elec");
});

var data = {
    "suhu1": "...",
    "suhu2": "...",
    "hum1": "...",
    "hum2": "...",
    "co1": "...",
    "co2": "...",
    "acState1": "...",
    "acState2": "...",
    "plnState1": "...",
    "plnState2": "...",
    "lampState1": "...",
    "lampState2": "...",
    "pumpState": "...",
    "tegangan": "...",
    "arus": "...",
    "daya": "...",
    "air": "..."
}

var monitorTegangan = [];
var monitorArus = [];
var monitorDaya = [];

var room1Suhu = [];
var room1Kelembaban = [];
var room1Udara = [];

var room2Suhu = [];
var room2Kelembaban = [];
var room2Udara = [];

function updateData(msg, topic) {
    switchData();
    switch (topic) {
        case "myEsp/lucio/monitor":
            data.suhu1 = msg.suhu1;
            data.hum1 = msg.hum1;
            data.co1 = msg.co1;
            data.suhu2 = msg.suhu2;
            data.hum2 = msg.hum2;
            data.co2 = msg.co2;
            fetch('http://luciocontrol.mooo.com/assets/api/history.php', {
                method: 'POST', // HTTP method
                headers: {
                    'Content-Type': 'application/json' // Type of data being sent
                },
                body: '{"type": "room1","suhu": ' + data.suhu1 + ',"hum": ' + data.hum1 + ',"co": ' + data.co1 +'}'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Request failed: ' + response.status);
                    }
                    return response; // Parse the JSON from the response
                })
                .then(data => {
                    console.log('Success:', data); // Handle the response
                })
                .catch(error => {
                    console.error('Error:', error);
                })

            fetch('assets/api/history.php', {
                method: 'POST', // HTTP method
                headers: {
                    'Content-Type': 'application/json' // Type of data being sent
                },
                body: '{"type": "room2","suhu": ' + data.suhu2 + ',"hum": ' + data.hum2 + ',"co": ' + data.co2 +'}'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Request failed: ' + response.status);
                    }
                    return response; // Parse the JSON from the response
                })
                .then(data => {
                    console.log('Success:', data); // Handle the response
                })
                .catch(error => {
                    console.error('Error:', error);
                })
            break;
        case "myEsp/lucio/elec":
            data.tegangan = msg.tegangan;
            data.arus = msg.arus;
            data.daya = msg.daya;
            data.air = msg.air;
            fetch('http://luciocontrol.mooo.com/assets/api/history.php', {
                method: 'POST', // HTTP method
                headers: {
                    'Content-Type': 'application/json' // Type of data being sent
                },
                body: '{"type": "electric","tegangan": ' + data.tegangan + ',"arus": ' + data.arus + ',"daya": ' + data.daya +'}'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Request failed: ' + response.status);
                    }
                    return response; // Parse the JSON from the response
                })
                .then(data => {
                    console.log('Success:', data); // Handle the response
                })
                .catch(error => {
                    console.error('Error:', error);
                })

            break;
        case "myEsp/lucio/state":
            data.plnState1 = msg.plnState1;
            data.lampState1 = msg.lampState1;
            data.acState1 = msg.acState1;
            data.plnState2 = msg.plnState2;
            data.lampState2 = msg.lampState2;
            data.acState2 = msg.acState2;
            data.pumpState = msg.pumpState;
            break;
    }



}

function switchData() {
    monitor("room-1-monitor-kondisi", data.suhu1 + "°C<br>" + data.hum1 + "%<br>" + data.co1 + "PPM");
    monitor("room-2-monitor-kondisi", data.suhu2 + "°C<br>" + data.hum2 + "%<br>" + data.co2 + "PPM");
    monitor("room-1-monitor-listrik", data.tegangan + "V<br>" + data.arus + "A");
    monitor("room-2-monitor-listrik", data.tegangan + "V<br>" + data.arus + "A");
    monitor("pb-monitor-listrik", data.daya + "W");
    monitor("pb-monitor-kondisi", data.air + "%");
    saklar("room-1-listrik", data.plnState1);
    saklar("room-1-lampu", data.lampState1);
    saklar("room-1-ac", data.acState1);
    saklar("room-2-listrik", data.plnState2);
    saklar("room-2-lampu", data.lampState2);
    saklar("room-2-ac", data.acState2);
    saklar("pub-pompa", data.pumpState);
}


// Special topic
client.on("message", function (topic, message) {
    msg = JSON.parse(message.toString());
    updateData(msg, topic);
    switchData();
    updateChart(topic);
    console.log(msg);
});

updateData("", "");