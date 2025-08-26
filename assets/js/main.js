// Preload logic
function none() {
    preload.style.display = "none";
}

var preload = document.getElementById("preload");

window.addEventListener("load", function () {
    preload.style.opacity = "0";
    console.log("Loaded !")
    setTimeout(none, 1000);

})
// Preload Logic End

// Graph api inisiate
const ls = document.getElementById("listrik");
const room1 = document.getElementById("room1");
const room2 = document.getElementById("room2");

const lisrik = new Chart(ls, {
    type: 'line',
    data: {
        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        datasets: [{
            label: 'Tegangan',
            data: monitorTegangan,
            borderColor: 'red',
            tension: 0.1
        }, {
            label: 'Arus',
            data: monitorArus,
            borderColor: 'green',
            tension: 0.1
        }, {
            label: 'Daya',
            data: monitorDaya,
            borderColor: 'blue',
            tension: 0.1
        }]
    }
});
const r1 = new Chart(room1, {
    type: 'line',
    data: {
        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        datasets: [{
            label: 'Suhu',
            data: room1Suhu,
            borderColor: 'red',
            tension: 0.1
        }, {
            label: 'Kelembaban',
            data: room1Kelembaban,
            borderColor: 'green',
            tension: 0.1
        }, {
            label: 'Kualitas udara',
            data: room1Udara,
            borderColor: 'blue',
            tension: 0.1
        }]
    }
});

const r2 = new Chart(room2, {
    type: 'line',
    data: {
        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        datasets: [{
            label: 'Suhu',
            data: room2Suhu,
            borderColor: 'red',
            tension: 0.1
        }, {
            label: 'Kelembaban',
            data: room2Kelembaban,
            borderColor: 'green',
            tension: 0.1
        }, {
            label: 'Kualitas udara',
            data: room2Udara,
            borderColor: 'blue',
            tension: 0.1
        }]
    }
});
// Graph done

function download(type){
    window.location.href = "assets/api/download.php?type=" + type;
}

function hapusAkun(id) {
    window.location.href = "assets/api/delete.php?id=" + id;
}

function accessInit(){
    var p1 = document.getElementById("pub-r1");
    var p2 = document.getElementById("pub-r2");

    if (p1.className == "box-bottom on") {
        document.getElementById("access1").style.display = "none";
    } else if (p1.className == "box-bottom off") {
        document.getElementById("access1").style.display = "flex";
    }

    if (p2.className == "box-bottom on") {
        document.getElementById("access2").style.display = "none";
    } else if (p2.className == "box-bottom off") {
        document.getElementById("access2").style.display = "flex";
    }
return 0;
}

function access(id) {
    var selector = document.getElementById(id);
    var kelas = selector.classList;

    if (kelas.contains("on")) {
        fetch('assets/api/accessRoom.php?room=' + id + '&value=0')
        selector.classList.add("off");
        selector.classList.remove("on");
    } else {
        fetch('assets/api/accessRoom.php?room=' + id + '&value=1')
        selector.classList.add("on");
        selector.classList.remove("off");
    }
    
    var p1 = document.getElementById("pub-r1");
    var p2 = document.getElementById("pub-r2");

    if (p1.classList.contains("on")) {
        document.getElementById("access1").style.display = "none";
    } else{
        document.getElementById("access1").style.display = "flex";
    }

    if (p2.classList.contains("on")) {
        document.getElementById("access2").style.display = "none";
    } else{
        document.getElementById("access2").style.display = "flex";
    }
}

function openAdd() {
    var add = document.getElementById("form");
    if (add.style.display == "flex") {
        add.style.display = "none";
    } else {
        add.style.display = "flex";
    }
}

function updateChart(type) {
    if (type == "myEsp/lucio/monitor") {
        if (room1Suhu.length >= 10) {
            room1Suhu.shift();
        };
        if (room1Kelembaban.length >= 10) {
            room1Kelembaban.shift();
        };
        if (room1Udara.length >= 10) {
            room1Udara.shift();
        };
        if (room2Suhu.length >= 10) {
            room2Suhu.shift();
        };
        if (room2Kelembaban.length >= 10) {
            room2Kelembaban.shift();
        };
        if (room2Udara.length >= 10) {
            room2Udara.shift();
        };
        room1Suhu.push(data.suhu1);
        room1Kelembaban.push(data.hum1);
        room1Udara.push(data.co1);

        room2Suhu.push(data.suhu2);
        room2Kelembaban.push(data.hum2);
        room2Udara.push(data.co2);
    }
    if(type == "myEsp/lucio/elec"){
        if (monitorTegangan.length >= 10) {
            monitorTegangan.shift();
        };
        if (monitorArus.length >= 10) {
            monitorArus.shift();
        };
        if (monitorDaya.length >= 10) {
            monitorDaya.shift();
        };
        monitorTegangan.push(data.tegangan);
        monitorArus.push(data.arus);
        monitorDaya.push(data.daya);
    
        
    }
    r1.update();
    r2.update();
    lisrik.update();
}

accessInit()