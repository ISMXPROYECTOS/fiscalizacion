$(document).ready(function(){

  var url = "http://localhost/fiscalizacion/public";

  $('#btn-enviar').click(function(event){

    var data = {
      'nombre' : $('#nombre').val(),
      'apellidopaterno' : $('#apellidopaterno').val(),
      'apellidomaterno' : $('#apellidomaterno').val(),
      'clave' : $('#clave').val(),
      'estatus' : $('#estatus').val()
    }

    $.ajax({
      url: url + '/inspectores/nuevo',
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