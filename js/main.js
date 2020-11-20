window.onload = function () {
    var instrument = 'acoustic_grand_piano';
    var note = 0;
    var delay = 0;
    var velocity = 127;

    var chords = [
        {
            'key': '|',
            'value': 67
        },
        {
            'key': '1',
            'value': 69
        },
        {
            'key': '2',
            'value': 71
        },
        {
            'key': '3',
            'value': 72
        },
        {
            'key': '4',
            'value': 74
        },
        {
            'key': '5',
            'value': 76
        },
        {
            'key': '6',
            'value': 77
        },
        {
            'key': '7',
            'value': 79
        },
        {
            'key': '8',
            'value': 81
        },
        {
            'key': '9',
            'value': 83
        },
        {
            'key': '0',
            'value': 84
        },
        {
            'key': "'",
            'value': 86
        },
        {
            'key': '¿',
            'value': 88
        },
    ]

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

    $('body').keydown(function (e) {
        let obj = chords.find(o => o.key === e.key);
        if (obj) {
            delay = 0; // play one note every quarter second
            note = obj.value; // the MIDI note
            velocity = 127; // how hard the note hits
            // play the note
            MIDI.setVolume(0, 127);
            MIDI.noteOn(0, note, velocity, delay);
            MIDI.noteOff(0, note, delay + 0.75);
        }
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