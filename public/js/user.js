$(document).ready(function(){

  var url = "http://localhost/fiscalizacion/public";

  $('#btn-enviar').click(function(event){

    var data = {
      'usuario' : $('#usuario').val(),
      'role' : $('#role').val(),
      'password' : $('#password').val()
    }

    $.ajax({
      url: url + '/usuarios/nuevo',
      data: data,
      type: 'post',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      success: function (response) {

        // Aqui tenemos que hacer que se  manden mensajes de alerta satisfactorios y que se actualice sola la tabla
        console.log(response);
      }
    });

  });

});