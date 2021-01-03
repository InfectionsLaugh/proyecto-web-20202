$(document).ready(function () {
    $('#song-download').click(function (e) {
        if ($("#song-name").val() != '') {
            midi_notes = midi_notes.sort(function (a, b) {
                return a - b;
            });

            console.log('notas final: ', midi_notes);

            $.ajax({
                url: 'php/midi.php',
                data: {
                    bpm: $('#bpm-text').val(),
                    name: $('#song-name').val(),
                    notes: midi_notes
                },
                type: 'POST',
                success: function (e) {
                    var res = JSON.parse(e);
                    if (res.response == "success") {
                        var link = document.createElement("a");
                        link.download = res.song_name;
                        link.href = 'php/downloadsong.php?name=' + res.song_name;
                        link.click();
                    }
                }, error: function (e) {

                }
            });
        } else {
            alert('Por favor, indica un nombre de canción');
        }
    });

    $('#midi-open').click(function (e) {
        
    });
});