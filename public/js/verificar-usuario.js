$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

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

                console.log(response);

                $('#btn-login').removeAttr('type');
                $('#formulario-login').removeAttr('action');
                $('#error-login, #alert-login').addClass('hidden');

                if (response.user.activo == '1' && response.user.vigencia >= response.fecha_hoy) {
                    $('#btn-login').attr('type', 'submit');
                    $('#formulario-login').attr("action", "login");
                } else {
                    $('#btn-login').removeAttr('type');
                    $('#formulario-login').removeAttr('action');
                    $('#alert-login').removeClass('hidden');
                    $('#alert-login').html("<strong>Lo sentimos.</strong> El usuario no esta vigente o no se encuentra activo.");
                }
                
            }
        });
    });
});