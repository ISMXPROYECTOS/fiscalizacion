$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').addClass('hidden');
    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').text('');

    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').addClass('hidden');
    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').text('');

    function viewData(){
        
        listado = $('#datatable').DataTable({
            'serverSide': true,
            'ajax': url + '/inspectores/listado',
            'columns': [
                {data: 'nombre'},
                {data: 'apellidopaterno'},
                {data: 'apellidomaterno'},
                {data: 'clave'},
                {data: 'estatus'},
                {data: 'btn'},
            ]
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
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').text('');
                    listado.destroy();
                    viewData();
                },
                error: function(response) {
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-clave, #error-estatus').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });
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
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').text('');
                    listado.destroy();
                    viewData();
                },

                error: function(response) {
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-clave-edit, #error-estatus-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
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
                            listado.destroy();
                            viewData();
                        }
                    }  
                });
            });           
        });
    }

    deleteData();

});