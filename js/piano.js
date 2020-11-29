var notes = [
    21, 23, 24, 26, 28, 29,
    31, 33, 35, 36, 38, 40,
    41, 43, 45, 47, 48, 50,
    52, 53, 55, 57, 59, 60,
    62, 64, 65, 67, 69, 71,
    72, 74, 76, 77, 79, 81,
    82, 84, 86, 88, 89, 91,
    93, 95, 96, 98, 100, 101,
    103, 105, 107, 108
];

var blacks = [
    22, 25, 27, 30, 32, 34,
    37, 39, 42, 44, 46, 49,
    51, 54, 56, 58, 61, 63,
    66, 68, 70, 73, 75, 78,
    80, 82, 85, 87, 90, 92,
    94, 97, 99, 102, 104, 106
];

var x_grid = [];
var y_grid = [];
var w = 25;
var col = [];

var keys = notes.concat(blacks);
keys = keys.sort(function (a, b) {
    return a - b;
});

var canvasWidth = document.getElementById('piano').offsetWidth;
var canvasHeight = document.getElementById('piano').offsetHeight;
var totalScroll = 0;

function setup() {
    let renderer = createCanvas(canvasWidth, notes.length * 44.7);
    renderer.parent('piano');
    background(100);

    for (var i = 0; i < 1100; i++) {
        x_grid[i] = w + i * w;
    }

    for (var i = 0; i < keys.length; i++) {
        y_grid[i] = w + i * w;
    }

    for (var i = 0; i < 1100 * keys.length; i++) {
        col[i] = true;
    }
}

function playNote(note) {
    delay = 0;
    velocity = 127;
    MIDI.setVolume(0, 127);
    MIDI.noteOn(0, note, velocity, delay);
    MIDI.noteOff(0, note, delay + 0.75);
}

function draw() {
    var keyHeight = 25;

    for (var j = 0; j < y_grid.length; j++) {
        for (var i = 0; i < 100; i++) {
            if (col[j * 10 + i]) fill("white");
            else fill("black");
            rect(175 + x_grid[i], y_grid[j] - 25, w, w);
        }
    }

    for (var i = 0; i < keys.length; i++) {
        var y = i * keyHeight;

        if (mouseY > y && mouseY < y + keyHeight && mouseX > 0 && mouseX < 200) {
            if (mouseIsPressed) {
                fill(150);
            } else {
                fill(200);
            }
        } else {
            if (blacks.indexOf(keys[i]) > -1) {
                fill(0);
            }
            else {
                fill(255);
            }
        }

        rect(0, y, 200, keyHeight - 1);
    }
}

function mousePressed() {
    var key = floor(map(mouseY, 0, height, 0, keys.length));
    playNote(keys[key]);
}

function mouseWheel(event) {
    console.log("Movimiento: " + event.delta);

    // if (totalScroll < canvasHeight) {
    //     $('#piano').css('transform', 'translateY(' + totalScroll + 'px)');
    // } else {
    //     totalScroll = canvasHeight;
    // }
}