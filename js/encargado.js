$(document).ready(function(){

    //var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').addClass('hidden');
    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').text('');
    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').addClass('hidden');
    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').text('');
    $('#error-activo-edit').addClass('hidden');
    $('#error-activo-edit').text('');

    $(document).on('click', '#btn-cancelar', function(e){
        $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').addClass('hidden');
        $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').text('');
        $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').addClass('hidden');
        $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').text('');
        $('#error-activo-edit').addClass('hidden');
        $('#error-activo-edit').text('');
    });

    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'processing': true,
            'destroy': true,
            'deferRender': true,
            'pageLength': 10,
            'order': [ 0, 'asc' ],
            'ajax': url + '/encargado/listado',
            'columns': [
                {data: 'nombre',
                    'render': function ( data, type, row ) {
                        return (row.nombre + ' ' + row.apellidopaterno + ' ' + row.apellidomaterno);
                    }
                },
                {data: 'puesto'},
                {data: 'activo',
                    'render': function(data, type, row){
                        if (row.activo == 1) {
                            return "<span class='badge badge-pill badge-success'>Activo</span>"
                        }else if(row.activo != 1){
                            return "<span class='badge badge-pill badge-danger'>Inactivo</span>"
                        }
                    }
                },
                {data: 'editar', orderable: false, searchable: false},
                {data: 'cambiarestatus', orderable: false, searchable: false}
            ],
            'language': {
                'info': 'Total de registros _TOTAL_',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior',
                },
                'lengthMenu': 'Mostrar _MENU_ registros',
                'loadingRecords': 'Cargando...',
                'processing': 'Procesando...',
                'emptyTable': 'No se encontraron registros',
                'zeroRecords': 'No se encontraron registros',
                'infoEmpty': '',
                'infoFiltered': ''
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
                'puesto' : $('#puesto').val()
            }

            $.ajax({
                url: url + '/encargado/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Encargado...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Encargado');
                    $("#formulario-encargado")[0].reset();
                    $('#crear-encargado').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Encargado');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-puesto').text('');
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
                url: url + '/encargado/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-encargado').modal({backdrop: 'static', keyboard: false})
                        $('#editar-encargado').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#apellidopaterno-edit').val(response.apellidopaterno);
                        $('#apellidomaterno-edit').val(response.apellidomaterno);
                        $('#puesto-edit').val(response.puesto);
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
                'puesto' : $('#puesto-edit').val()
            }

            $.ajax({
                url: url + '/encargado/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-encargado').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-puesto-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateData();

    function editEstatus(){
        $(document).on('click', '.estatus', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/encargado/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-activo').modal({backdrop: 'static', keyboard: false})
                        $('#editar-activo').modal('show');
                        $('#id-edit-activo').val(response.id);
                        $('#activo-edit').val(response.activo);
                    }
                }
            });
        });
    }

    editEstatus();

    function updateEstatus(){
        $('#btn-activo').click(function(){
            var data = {
                'id' : $('#id-edit-activo').val(),
                'activo' : $('#activo-edit').val()
            }

            $.ajax({
                url: url + '/encargado/estatus',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-activo').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-activo').text('Guardar');
                    $('#editar-activo').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-activo-edit').addClass('hidden');
                    $('#error-activo-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-activo').text('Guardar');
                    $('#error-activo-edit').addClass('hidden');
                    $('#error-activo-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateEstatus();

});