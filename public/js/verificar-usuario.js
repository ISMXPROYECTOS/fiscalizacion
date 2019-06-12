$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    $('#btn-login').attr('disabled', 'disabled');
    $('#btn-login').removeAttr('type');
    $('#formulario-login').removeAttr('action');
    $('#error-login, #alert-login').addClass('hidden');
    $('#usuario-login').focus();

    $('#usuario-login').blur(function(){
        var usuario = $('#usuario-login').val();

        $.ajax({
            url: url + '/usuarios/verificar/' + usuario,
            type: 'get',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {

                $('#btn-login').attr('disabled', 'disabled');
                $('#btn-login').removeAttr('type');
                $('#formulario-login').removeAttr('action');
                $('#error-login, #alert-login').addClass('hidden');

                if (response == '1') {
                    $('#btn-login').removeAttr('disabled');
                    $('#btn-login').attr('type', 'submit');
                    $('#formulario-login').attr("action", "login");
                } else {
                    $('#alert-login').removeClass('hidden');
                    $('#alert-login').html("<strong>Lo sentimos.</strong> El usuario no existe o esta inactivo.");
                }
                
            }
        });
    });
});