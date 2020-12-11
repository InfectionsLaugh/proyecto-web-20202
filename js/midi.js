$(document).ready(function () {
    $('#song-download').click(function (e) {
        $.ajax({
            url: 'php/midi.php',
            data: {
                bpm: $('#bpm-text').val(),
                name: $('#song-name').val()
            },
            type: 'POST',
            success: function (e) {

            },
            error: function (e) {

            }
        });
    });
});