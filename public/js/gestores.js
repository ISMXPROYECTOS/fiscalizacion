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
                    $("#formulario-gestor")[0].reset();
                    $('#crear-gestor').modal('hide');
                    $('#registro-correcto').modal('show');
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
                url: url + '/gestores/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-gestor').modal('show');
                        $('#id-edit').val(response.id);
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

    editData();


    function updateData(){
        $('#btn-editar').click(function(){
            var data = {
                'id' : $('#id-edit').val(),
                'nombre' : $('#nombre-edit').val(),
                'apellidopaterno' : $('#apellidopaterno-edit').val(),
                'apellidomaterno' : $('#apellidomaterno-edit').val(),
                'telefono' : $('#telefono-edit').val(),
                'celular' : $('#celular-edit').val(),
                'correoelectronico' : $('#correoelectronico-edit').val(),
                'ine' : $('#ine-edit').val(),
                'estatus' : $('#estatus-edit').val()
            }

            $.ajax({
                url: url + '/gestores/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-gestor').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    viewData();
                }
            });

        });
    }

    updateData();

    function deleteData(){
        $(document).on('click', '.eliminar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $('#desea-eliminar').modal('show');
            $('.delete-confirm').click(function(){
                $.ajax({
                    url: url + '/gestores/eliminar/' + id,
                    type: 'get',
                    success: function (response) {
                        if (response == "realizado"){
                            $('#desea-eliminar').modal('hide');
                            $('#eliminacion-correcta').modal('show');
                            viewData();
                        }
                    }  
                });
            });            
        });
    }

    deleteData();

});