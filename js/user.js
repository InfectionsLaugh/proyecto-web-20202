$(document).ready(function () {
    $('.edit-info').click(function (e) {
        e.preventDefault();
        console.log($('.' + $(this).data('info')).text());

        var info = $('.' + $(this).data('info')).text();
        var dataInfo = $(this).data('info');
        console.log($(this).data('info'));

        $("#modal-data").val(info);
        $('#editInfoModal').css('display', 'block');
        $("#save-info").attr('data-info', dataInfo);
    });

    $('#save-info').click(function (e) {
        e.preventDefault();
        var campo = $(this).attr('data-info');
        console.log('Data: ' + $(this).data('info'));
        $.ajax({
            url: 'php/user.php',
            type: 'post',
            data: {
                data: $('#modal-data').val(),
                field: $('#save-info').attr('data-info'),
                edit: 'true'
            }, success: function (e) {
                var res = JSON.parse(e);

                if (res.result == "success") {
                    $('#editInfoModal').modal('toggle');
                    $('.modal-backdrop').hide();
                    $('.' + $('#save-info').attr('data-info')).html(res.value);
                    console.log('campo: ' + campo);
                    if($('#save-info').attr('data-info') == "user_name")
                        $('#userDropdownBtn').html('<i class="fas fa-user"></i>' + res.value);
                } else {
                    $('.alert-danger').html(res.message);
                    $('.alert-danger').css('display', 'block');
                }
            }, error: function (e) {

            }
        });
    });
});