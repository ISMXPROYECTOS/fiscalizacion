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
                },

                error: function(response) {

                    if (response.responseJSON.errors.nombre[0] != null) {
                        $('#error-nombre').removeClass('hidden');
                        $('#error-nombre').text(response.responseJSON.errors.nombre[0]);
                    }

                    if (response.responseJSON.errors.apellidopaterno[0] != null) {
                        $('#error-apellidopaterno').removeClass('hidden');
                        $('#error-apellidopaterno').text(response.responseJSON.errors.apellidopaterno[0]);
                    }

                    if (response.responseJSON.errors.apellidomaterno[0] != null) {
                        $('#error-apellidomaterno').removeClass('hidden');
                        $('#error-apellidomaterno').text(response.responseJSON.errors.apellidomaterno[0]);
                    }

                    if (response.responseJSON.errors.clave[0] != null) {
                        $('#error-clave').removeClass('hidden');
                        $('#error-clave').text(response.responseJSON.errors.clave[0]);
                    }

                    if (response.responseJSON.errors.estatus[0] != null) {
                        $('#error-estatus').removeClass('hidden');
                        $('#error-estatus').text(response.responseJSON.errors.estatus[0]);
                    }
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
                url: url + '/inspectores/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-inspector').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#apellidopaterno-edit').val(response.apellidopaterno);
                        $('#apellidomaterno-edit').val(response.apellidomaterno);
                        $('#clave-edit').val(response.clave);
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
                'clave' : $('#clave-edit').val(),
                'estatus' : $('#estatus-edit').val()
            }

            $.ajax({
                url: url + '/inspectores/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-inspector').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    viewData();
                },

                error: function(response) {

                    if (typeof(response.responseJSON.errors.nombre) != 'undefined') {
                         $('#error-nombre-edit').removeClass('hidden');
                        $('#error-nombre-edit').text(response.responseJSON.errors.nombre[0]);
                    } 

                    if (typeof(response.responseJSON.errors.apellidopaterno) != 'undefined') {
                        $('#error-apellidopaterno-edit').removeClass('hidden');
                        $('#error-apellidopaterno-edit').text(response.responseJSON.errors.apellidopaterno[0]);
                    }

                    if (typeof(response.responseJSON.errors.apellidomaterno) != 'undefined') {
                        $('#error-apellidomaterno-edit').removeClass('hidden');
                        $('#error-apellidomaterno-edit').text(response.responseJSON.errors.apellidomaterno[0]);
                    }

                    if (typeof(response.responseJSON.errors.clave) != 'undefined') {
                        $('#error-clave-edit').removeClass('hidden');
                        $('#error-clave-edit').text(response.responseJSON.errors.clave[0]);
                    }

                    if (typeof(response.responseJSON.errors.estatus) != 'undefined') {
                        $('#error-estatus-edit').removeClass('hidden');
                        $('#error-estatus-edit').text(response.responseJSON.errors.estatus[0]);
                    }
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
                    url: url + '/inspectores/eliminar/' + id,
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