$(document).ready(function () {
    $('#login-user').click(function(e) {
        $('#failure').css('opacity', '0');
        $('#failure').css('height', '0');
        $('#success').css('opacity', '0');
        $('#success').css('height', '0');
    });

    $('#login-password').click(function(e) {
        $('#failure').css('opacity', '0');
        $('#failure').css('height', '0');
        $('#success').css('opacity', '0');
        $('#success').css('height', '0');
    });

    $('#login').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/user.php',
            type: 'post',
            data: {
                user: $('#login-user').val(),
                pass: $('#login-password').val()
            },
            success: function (s) {
                if (s != 'null') {
                    console.log('Se pudo');
                    $('#success').css('opacity', '1');
                    $('#success').css('height', '100%');
                    location.reload();
                } else {
                    $('#failure').css('opacity', '1');
                    $('#failure').css('height', '100%');
                }
            },
            error: function (e) {
                console.log('NO se pudo', e);
            }
        })
    });

    $('#sign-up').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'php/register.php',
            type: 'post',
            data: {
                name: $('#sign-up-name').val(),
                username: $('#sign-up-user').val(),
                email: $('#sign-up-email').val(),
                password: $('#sign-up-password').val()
            },
            success: function (e) {
                var res = JSON.parse(e);
                if (res.result == "success")
                    location.reload();
                else
                    console.log('adios');
            },
            error: function (e) {

            }
        })
    });

    $('#logout').click(function (e) {
        $.ajax({
            url: 'php/logout.php',
            type: 'get',
            success: function (s) {
                console.log('hola');
                location.reload();
            }
        })
    })
});