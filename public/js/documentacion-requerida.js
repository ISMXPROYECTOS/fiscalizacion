$(document).ready(function(){

	var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-cp').addClass('hidden');
    $('#error-nombre, #error-cp').text('');
    $('#error-nombre-edit, #error-cp-edit').addClass('hidden');
    $('#error-nombre-edit, #error-cp-edit').text('');

	// Esta función muetra los años fiscales en una tabla
    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/documentacion-requerida/listado',
            'columns': [
                {data: 'clave'},
                {data: 'nombre'},
                {data: 'activo',
                	'render': function(data, type, row){
                        if (row.activo == 1) {
                            return "<span class='badge badge-pill badge-success'>Activo</span>"
                        }else if(row.activo != 1){
                            return "<span class='badge badge-pill badge-danger'>Inactivo</span>"
                        }
                    }
            	},
                {data: 'cambiarestatus'},
                {data: 'editar'}
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

    // Se ejecuta la función cuando todo el archivo este cargado
    viewData();

    // Esta función agrega nuevos registros, se encuentra enlazada con el método create de DocumentacionRequeridaController
    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'nombre' : $('#nombre').val(),
                'clave' : $('#clave').val(),
                //'tipoInspeccion' : $('#tipoInspeccion').val(),
            }
            $.ajax({
                url: url + '/documentacion-requerida/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Colonia...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Colonia');
                    $("#formulario-colonia")[0].reset();
                    $('#crear-colonia').modal('hid e');
                    $('#registro-correcto').modal('show');
                    $('#error-nombre, #error-cp').addClass('hidden');
                    $('#error-nombre, #error-cp').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Colonia');
                    $('#error-nombre, #error-cp').addClass('hidden');
                    $('#error-nombre, #error-cp').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i).removeClass('hidden');
                        $('#error-'+i).text(item[0]);
                    });
                }
            });

        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    saveData();

    // Esta función selecciona registros para modificarlos, se encuentra enlazada con el método editarDocumento de DocumentacionRequeridaController
    function editData(){
        $(document).on('click', '.editar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/documentacion-requerida/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                    	
                        $('#editar-documento').modal({backdrop: 'static', keyboard: false})
                        $('#editar-documento').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#clave-edit').val(response.clave);
                    }
                }
            });
        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    editData();

    // Esta función modifica registros, se encuentra enlazada con el método update de ColoniaController
    function updateData(){
        $('#btn-editar').click(function(){
            var data = {
                'id' : $('#id-edit').val(),
                'nombre' : $('#nombre-edit').val(),
                'clave' : $('#clave-edit').val()
            }
            $.ajax({
                url: url + '/documentacion-requerida/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-documento').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit, #error-cp-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-cp-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-nombre-edit, #error-cp-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-cp-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    updateData();

    function editEstatus(){
        $(document).on('click', '.estatus', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/documentacion-requerida/editar/' + id,
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
                url: url + '/documentacion-requerida/estatus',
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