$(document).ready(function(){
    var url = "http://localhost/fiscalizacion/public";

    function viewData(){
        $.ajax({
            url: url + '/inspectores/listado',
            success: function (response) {
                $('#tbody').html(response);
            }
        });
    }

    viewData();

    function saveData(){
        $('#btn-enviar').click(function(){
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

                    $("#formulario-inspector")[0].reset();
                    $('#crear-inspector').modal('hide');
                    $('#registro-correcto').modal('show');

                    viewData();
                }
            });
        });
    }

    saveData();

    

});