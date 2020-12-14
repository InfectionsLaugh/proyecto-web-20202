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

                }, error: function (e) {

                }
            });
        } else {
            alert('Por favor, indica un nombre de canción');
        }
    });
});