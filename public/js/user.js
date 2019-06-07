$(document).ready(function(){


  var url = "http://localhost/fiscalizacion/public";

    function viewData(){
        $.ajax({
            url: url + '/usuarios/listado',
            success: function (response) {
                $('#tbody').html(response);
            }
        });
    }

    viewData();

    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
              'usuario' : $('#usuario').val(),
              'role' : $('#role').val(),
              'password' : $('#password').val(),
              'password_confirmation' : $('#password-confirm').val()
            }

            console.log(data);

            $.ajax({
              url: url + '/usuarios/nuevo',
              data: data,
              type: 'post',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              success: function (response) {
                // Aqui tenemos que hacer que se  manden mensajes de alerta satisfactorios y que se actualice sola la tabla
                //$('#close').click();
                //$('.formulario-inspector')[0].reset();
                console.log(response);
                viewData();
              }
          });
        });
    }

    saveData();

});