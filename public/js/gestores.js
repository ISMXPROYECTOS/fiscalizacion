$(document).ready(function(){


    var url = "http://localhost/fiscalizacion/public";

    function viewData(){
        $.ajax({
            url: url + '/gestores/listado',
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

                    viewData();
                }
            });

        });
    }

    saveData();

    function editData(){
        $(document).on('click', '.editar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: url + '/editar-gestor/' + id,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response != ""){
                        $('#opeEdit').click();
                        $('#nombre-edit').val(response.nombre);
                        $('#apellidopaterno-edit').val(response.apellidopaterno);
                        $('#apellidomaterno-edit').val(response.apellidomaterno);
                        $('#telefono-edit').val(response.telefono);
                        $('#celular-edit').val(response.celular);
                        $('#correoelectronico-edit').val(response.correoelectronico);
                        $('#ine-edit').val(response.ine);
                        $('#estatus-edit').val(response.estatus);
                    }
                }
            });
        });
    }

    function deleteData(){
        $(document).on('click', '.eliminar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                url: url + '/gestor/delete/' + id,
                type: 'get',
                success: function (response) {
                    if (response == "realizado"){
                        alert('Se elimino el gestor');
                        viewData();
                    }
                }
            });
        });
    }

    deleteData();

});