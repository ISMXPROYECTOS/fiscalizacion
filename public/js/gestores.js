$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    function saveData(){
        $('#btn-enviar').click(function(){

            var data = {
                'nombre' : $('#nombre').val(),
                'apellidopaterno' : $('#apellidopaterno').val(),
                'apellidomaterno' : $('#apellidomaterno').val(),
                'telefono' : $('#telefono').val(),
                'celular' : $('#celular').val(),
                'correoelectronico' : $('#correoelectronico').val(),
                'ine' : $('#ine').val(),
                'estatus' : $('#estatus').val()
            }

            $.ajax({
                url: url + '/gestores/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    // Aqui tenemos que hacer que se  manden mensajes de alerta satisfactorios y que se actualice sola la tabla
                    console.log(response);
                }
            });

        });
    }

    saveData();

    function deleteData(){
        
    }

});