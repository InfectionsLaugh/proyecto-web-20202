var notes = [
    21, 23, 24, 26, 28, 29,
    31, 33, 35, 36, 38, 40,
    41, 43, 45, 47, 48, 50,
    52, 53, 55, 57, 59, 60,
    62, 64, 65, 67, 69, 71,
    72, 74, 76, 77, 79, 81,
    83, 84, 86, 88, 89, 91, 93,
    95, 96, 98, 100, 101,
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

var key_names = [
    'A0', 'A#0', 'B0',
    'C1', 'C#1', 'D1', 'C#1', 'E1', 'F1', 'F#1', 'G1', 'G#1', 'A1', 'A#1', 'B1',
    'C2', 'C#2', 'D2', 'C#2', 'E2', 'F2', 'F#2', 'G2', 'G#2', 'A2', 'A#2', 'B2',
    'C3', 'C#3', 'D3', 'C#3', 'E3', 'F3', 'F#3', 'G3', 'G#3', 'A3', 'A#3', 'B3',
    'C4', 'C#4', 'D4', 'C#4', 'E4', 'F4', 'F#4', 'G4', 'G#4', 'A4', 'A#4', 'B4',
    'C5', 'C#5', 'D5', 'C#5', 'E5', 'F5', 'F#5', 'G5', 'G#5', 'A5', 'A#5', 'B5',
    'C6', 'C#6', 'D6', 'C#6', 'E6', 'F6', 'F#6', 'G6', 'G#6', 'A6', 'A#6', 'B6',
    'C7', 'C#7', 'D7', 'C#7', 'E7', 'F7', 'F#7', 'G7', 'G#7', 'A7', 'A#7', 'B7',
    'C8'
];

var keys = notes.concat(blacks);
keys = keys.sort(function (a, b) {
    return a - b;
});

function clickableGrid(rows, cols, callback) {
    var i = 0;
    var grid = document.createElement('table');
    grid.className = 'grid';
    for (var r = 0; r < rows; ++r) {
        var tr = grid.appendChild(document.createElement('tr'));
        for (var c = 0; c < cols; ++c) {
            var cell = tr.appendChild(document.createElement('td'));
            cell.setAttribute('data-note', keys[r]);
            cell.setAttribute('data-note-name', key_names[r]);
            cell.addEventListener('click', (function (el, r, c, i) {
                return function () { callback(el, r, c, i); }
            })(cell, r, c, i), false);
        }
    }
    return grid;
}

window.onload = function () {
    var instrument = 'acoustic_grand_piano';
    var note = 0;
    var delay = 0;
    var velocity = 127;

    for (var i = 0; i < keys.length; i++) {
        if (blacks.indexOf(keys[i]) > -1)
            $('#keys').append('<div data-note="' + keys[i] + '" class="key black text-white">' + key_names[i] + '</div>');
        else
            $('#keys').append('<div data-note="' + keys[i] + '" class="key">' + key_names[i] + '</div>');
    }

    var grid = clickableGrid(keys.length, 35, function (el, row, col, i) {
        delay = 0; // play one note every quarter second
        note = $(el).data('note'); // the MIDI note
        velocity = 127; // how hard the note hits
        // play the note
        MIDI.setVolume(0, 127);
        MIDI.noteOn(0, note, velocity, delay);
        MIDI.noteOff(0, note, delay + 0.75);

        $(el).toggleClass('clicked');
        
        if($(el).hasClass('clicked'))
            $(el).html($(el).data('note-name'));
        else
            $(el).html('');
    });

    document.getElementById('main-sequencer').appendChild(grid);

    $('.key').click(function () {
        delay = 0; // play one note every quarter second
        note = $(this).data('note'); // the MIDI note
        velocity = 127; // how hard the note hits
        // play the note
        MIDI.setVolume(0, 127);
        MIDI.noteOn(0, note, velocity, delay);
        MIDI.noteOff(0, note, delay + 0.75);
    })

    MIDI.loadPlugin({
        soundfontUrl: "./soundfonts/",
        instrument: instrument,
        onprogress: function (state, progress) {
            console.log(state, progress);
        },
        onsuccess: function () {
            MIDI.programChange(0, MIDI.GM.byName[instrument].number);
        }
    });

    function loadInstrument(instrumentName) {
        MIDI.loadResource({
            soundfontUrl: "./soundfonts/",
            instrument: instrumentName,
            onprogress: function (state, percent) {
                $('#wait-modal').css('opacity', '0.5');
                $('#wait-modal').css('display', 'block');
            },
            onsuccess: function () {
                $('#wait-modal').css('opacity', '0');
                $('#wait-modal').css('display', 'none');
                MIDI.programChange(0, MIDI.GM.byName[instrumentName].number);
            }
        })
    }

    $('#instruments').change(function (e) {
        console.log('asda');
        loadInstrument($('#instruments').val());
    });

    $('.open-login').click(function (e) {
        $('#login-form').addClass('slidein');
        $('#login-form').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (event) {
            $(this).removeClass('slidein')
        });
        $('#login-form').css('z-index', '9999');
        $('#login-form').css('opacity', '1');
        $('.overlay').css('z-index', '9998');
        $('.overlay').attr('id', 'login');
    });

    $('.open-register').click(function (e) {
        $('#register-form').addClass('slidein');
        $('#register-form').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (event) {
            $(this).removeClass('slidein')
        });
        $('#register-form').css('z-index', '9999');
        $('#register-form').css('opacity', '1');
        $('.overlay').css('z-index', '9998');
        $('.overlay').attr('id', 'register');
    });

    $('.overlay').click(function (e) {
        var id = $(this).attr('id');
        console.log(id);
        $('#' + id + '-form').addClass('slideout');
        $('#' + id + '-form').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (event) {
            $(this).removeClass('slideout')
            $('#' + id + '-form').css('z-index', '-1');
            $('#' + id + '-form').css('opacity', '0');
            $('.overlay').css('z-index', '-1');
        });
        console.log('dasda');
    });
};