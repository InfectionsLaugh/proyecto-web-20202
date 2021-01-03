let notes = [
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

let midi_notes = [];

let blacks = [
    22, 25, 27, 30, 32, 34,
    37, 39, 42, 44, 46, 49,
    51, 54, 56, 58, 61, 63,
    66, 68, 70, 73, 75, 78,
    80, 82, 85, 87, 90, 92,
    94, 97, 99, 102, 104, 106
];

let bpm = 60;

let key_names = [
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

let keys = notes.concat(blacks);
keys = keys.sort(function (a, b) {
    return a - b;
});

function clickableGrid(rows, cols, callback) {
    let i = 0;
    let grid = document.createElement('table');
    grid.className = 'grid';
    grid.id = 'sequencer'
    for (let r = 0; r < rows; ++r) {
        let tr = grid.appendChild(document.createElement('tr'));
        for (let c = 0; c < cols; ++c) {
            let cell = tr.appendChild(document.createElement('td'));
            cell.setAttribute('data-note', keys[r]);
            cell.setAttribute('data-note-name', key_names[r]);
            cell.addEventListener('click', (function (el, r, c, i) {
                return function () { callback(el, r, c, i); }
            })(cell, r, c, i), false);
        }
    }
    return grid;
}

function clearSequencer() {
    let sequencer = document.getElementById('sequencer');
    let seq_len = sequencer.rows[0].cells.length;

    for (let i = 0; i < sequencer.rows.length; i++) {
        for (let j = 0; j < seq_len; j++) {
            if ($(sequencer.rows[i].cells[j]).hasClass('clicked')) {
                $(sequencer.rows[i].cells[j]).toggleClass('clicked');
                $(sequencer.rows[i].cells[j]).html('');
            }
        }
    }
}

let idOpenedSong = 0;
let openedSongName;

function openSong(idSong) {
    let sequencer = document.getElementById('sequencer');
    let song = [];
    clearSequencer();

    fetch(`php/open-song.php?song_id=${idSong}`).then(res => {
        console.log(res);
        return res.json();
    }).then(json => {
        song = json;

        for (let i = 0; i < song.length; i++) {
            if (song[i].length > 0) {
                for (let j = 0; j < song[i].length; j++) {
                    cellNote = sequencer.rows[keys.indexOf(song[i][j])].cells[i];
                    $(cellNote).addClass('clicked');
                    $(cellNote).html($(cellNote).data('note-name'));
                }
            }
        }
    }).catch(error => console.log(error));
}

function saveSongArray() {
    let songSaved = [];
    let sequencer = document.getElementById('sequencer');
    let seq_len = sequencer.rows[0].cells.length;
    for (let j = 0; j < seq_len; j++) {
        songSaved.push([]);                      // column
        for (let i = 0; i < sequencer.rows.length; i++) {
            if ($(sequencer.rows[i].cells[j]).hasClass('clicked')) {
                note = $(sequencer.rows[i].cells[j]).data('note'); // the MIDI note
                songSaved[j].push(note);         // adds clicked notes by column
            }
        }
    }
    return songSaved;
}

const loadSongValues = () => {

    fetch(`php/get_songs.php`)
        .then(res => res.json())
        .then(songNames => {
            // console.log(songNames)
            songNames.forEach(songElement => {
                $('#song-list').append(`<a class="dropdown-item" id="${songElement.id}" >${songElement.name}</a>`);

                $(`#${songElement.id}`).click(e => {
                        const songId = songElement.id;
                        openSong(songId);
                        $('#song-name').val(`${songElement.name}`);
                        idOpenedSong = songId;
                        openedSongName = $(`#${songElement.id}`).text();
                });
            });
        }).catch(error => console.log(error));
}


$(document).ready(function () {
    loadSongValues();
});

window.onload = function () {

    $('#bpm-text').val(bpm);
    let instrument = 'acoustic_grand_piano';
    let note = 0;
    let delay = 0;
    let velocity = 127;

    for (let i = 0; i < keys.length; i++) {
        if (blacks.indexOf(keys[i]) > -1)
            $('#keys').append('<div data-note="' + keys[i] + '" class="key black text-white">' + key_names[i] + '</div>');
        else
            $('#keys').append('<div data-note="' + keys[i] + '" class="key">' + key_names[i] + '</div>');
    }

    let grid = clickableGrid(keys.length, 45, function (el, row, col, i) {
        delay = 0; // play one note every quarter second
        note = $(el).data('note'); // the MIDI note
        velocity = 127; // how hard the note hits
        // play the note
        MIDI.setVolume(0, 127);
        MIDI.noteOn(0, note, velocity, delay);
        MIDI.noteOff(0, note, delay + 0.75);

        // console.log('columna: ', col);

        $(el).toggleClass('clicked');

        if ($(el).hasClass('clicked')) {
            midi_notes.push({
                note: $(el).data('note'),
                index: col
            });
            $(el).html($(el).data('note-name'));
        } else {
            midi_notes.splice(midi_notes.findIndex(n => n.note == $(el).data('note') && n.index === col));
            $(el).html('');
        }

        // console.log('notas: ', midi_notes);
    });

    let x = -30;
    let y = 0;

    let playStop;

    //reproducir cancion
    $('#song-play').click(function (e) {
        let sequencer = document.getElementById('sequencer');
        let seq_len = sequencer.rows[0].cells.length;
        let j = 0;
        let time = (1 / (bpm / 60) * 1000) / 4;
        console.log('tiempo:', time);

        $('#playhead').css('display', 'block');
        $('#playhead-line').css('display', 'block');

        playStop = setInterval(function (e) {
            $('#playhead').css('transform', 'translateX(' + x + 'px)');
            $('#playhead-line').css('transform', 'translateX(' + y + 'px)');

            if (x >= 24 * 45) {
                j = 0;
                x = -30;
            }

            if (y >= 25 * 45)
                y = 0;

            x += 25;
            y += 25;

            for (let i = 0; i < sequencer.rows.length; i++) {
                if ($(sequencer.rows[i].cells[j]).hasClass('clicked')) {
                    delay = 0; // play one note every quarter second
                    note = $(sequencer.rows[i].cells[j]).data('note'); // the MIDI note
                    velocity = 127; // how hard the note hits
                    // play the note
                    MIDI.setVolume(0, 127);
                    MIDI.noteOn(0, note, velocity, delay);
                    MIDI.noteOff(0, note, delay + 0.75);
                }
            }

            j++;
        }, time);
    });
    //detener la cancion
    $('#song-stop').click(function (e) {
        $('#playhead').css('display', 'none');
        $('#playhead-line').css('display', 'none');
        $('#playhead').css('transform', 'translateX(-30px)');
        $('#playhead-line').css('transform', 'translateX(0)');
        x = -30;
        y = 0;
        clearInterval(playStop);
    })
    // borrar notas en tablero
    $('#song-delete').click(function (e) {
        clearSequencer();
    })
    // crear nueva cancion 
    $('#song-new').click(function (e) {
        idOpenedSong = 0;
        $('#song-name').val("Sin título");
        clearSequencer();

    })
    //guardar cancion en tablero
    $('#song-save').click(function (e) {
        const mySong = saveSongArray();
        const songArray = JSON.stringify(mySong);
        let songTitle = $('#song-name').val();

        if((idOpenedSong>0) && (openedSongName==songTitle)){
            // console.log("haciendo update");
            // console.log(idOpenedSong);
            // console.log(songArray);
            $.ajax({
                url: 'php/update-songArray.php',
                type: 'post',
                data: {
                    songArray: songArray,
                    songId: idOpenedSong,
                },
                success: function (s) {
                    alert("Canción actualizada!");
                },
                error: function (e) {
                    alert('Error guardando la cancion');
                }
            });
        }
        else {
            // console.log("creando nuevo");
            // console.log(songArray);
            // console.log(songTitle);
            $.ajax({
                url: 'php/save-song.php',
                type: 'post',
                data: {
                    songArray: songArray,
                    songName: songTitle,
                },
                success: function (s) {
                    alert("Canción guardada!");
                },
                error: function (e) {
                    alert('Error guardando la cancion');
                }
            });
        }
        // class Song{
            //     constructor(notes){
            //         this.notes = notes;
            //         this.modified = false;
            //         this.loadedFromDb = false;
            //         this.createOnFrontEnd = false;
            //     }

            //     updateSong(newNotes){
            //         this.notes= newNotes;
            //         this.modified = true;
            //     }
            // }
            // const notesArray = fetch()
            // const song = new Song(notesArray);   
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

    $('#bpm-text').keydown(function (e) {
        if (e.which == 13) {
            clearInterval(playStop);
            bpm = $(this).val();
            let time = (1 / (bpm / 60) * 1000) / 4;
            console.log('tiempo enter:', time);
            let j = 0;

            playStop = setInterval(function (e) {
                $('#playhead').css('transform', 'translateX(' + x + 'px)');
                $('#playhead-line').css('transform', 'translateX(' + y + 'px)');

                if (x >= 24 * 45) {
                    j = 0;
                    x = -30;
                }

                if (y >= 25 * 45)
                    y = 0;

                x += 25;
                y += 25;

                for (let i = 0; i < sequencer.rows.length; i++) {
                    if ($(sequencer.rows[i].cells[j]).hasClass('clicked')) {
                        delay = 0; // play one note every quarter second
                        note = $(sequencer.rows[i].cells[j]).data('note'); // the MIDI note
                        velocity = 127; // how hard the note hits
                        // play the note
                        MIDI.setVolume(0, 127);
                        MIDI.noteOn(0, note, velocity, delay);
                        MIDI.noteOff(0, note, delay + 0.75);
                    }
                }

                j++;
            }, time);
        }
    });

    $('.instrument-option').click(function (e) {
        console.log('asda');
        loadInstrument($(this).data('instrument'));
        $('#dropdownMenu2').text($(this).text());
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
        let id = $(this).attr('id');
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

