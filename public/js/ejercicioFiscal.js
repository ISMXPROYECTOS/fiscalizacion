$(document).ready(function(){
	// Se crea una variable con la ruta raiz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-anio').addClass('hidden');
    $('#error-anio').text('');
    $('#error-anio-edit, #error-activo-edit').addClass('hidden');
    $('#error-anio-edit, #error-activo-edit').text('');

    // Esta función muetra los años fiscales en una tabla
    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/ejercicios-fiscales/listado',
            'columns': [
                {data: 'anio'},
                {data: 'activo',
                    'render': function(data, type, row){
                        if (row.activo == 1) {
                            return "<span class='badge badge-pill badge-success'>Activo</span>"
                        }else if(row.activo != 1){
                            return "<span class='badge badge-pill badge-danger'>Inactivo</span>"
                        }
                    }
                },
                {data: 'editar'},
                {data: 'cambiarestatus'},
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

    // Esta función agrega nuevos registros, se encuentra enlazada con el método create de EjercicioFiscalController
    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'anio' : $('#ejercicio-fiscal').val()
            }
            $.ajax({
                url: url + '/ejercicios-fiscales/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Año Fiscal...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Año Fiscal');
                    $("#formulario-ejercicio-fiscal")[0].reset();
                    $('#crear-ejercicio-fiscal').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-anio').addClass('hidden');
                    $('#error-anio').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Año Fiscal');
                    $('#error-anio').addClass('hidden');
                    $('#error-anio').text('');
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

    // Esta función selecciona registros para modificarlos, se encuentra enlazada con el método editarEjercicioFiscal de EjercicioFiscalController
    function editData(){
        $(document).on('click', '.editar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/ejercicios-fiscales/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-ejercicio-fiscal').modal('show');
                        $('#id-edit').val(response.id);
                        $('#ejercicio-fiscal-edit').val(response.anio);
                    }
                }
            });
        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    editData();

    // Esta función modifica registros, se encuentra enlazada con el método update de EjercicioFiscalController
    function updateData(){
        $('#btn-editar').click(function(){
            var data = {
                'id' : $('#id-edit').val(),
                'anio' : $('#ejercicio-fiscal-edit').val()
            }
            $.ajax({
                url: url + '/ejercicios-fiscales/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-ejercicio-fiscal').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-anio-edit').addClass('hidden');
                    $('#error-anio-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-anio-edit').addClass('hidden');
                    $('#error-anio-edit').text('');
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
                url: url + '/ejercicios-fiscales/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-activo').modal('show');
                        $('#id-edit-activo').val(response.id);
                        $('#activo-edit').val(response.activo);
                    }
                }
            });
        });
    }

    // Se ejecuta la función cuando todo el archivo este cargado
    editEstatus();

    // Esta función modifica el estatus del registro, se encuentra enlazada con el método updateEstatus de EjercicioFiscalController
    function updateEstatus(){
        $('#btn-activo').click(function(){
            var data = {
                'id' : $('#id-edit-activo').val(),
                'activo' : $('#activo-edit').val()
            }

            $.ajax({
                url: url + '/ejercicios-fiscales/estatus',
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

    // Se ejecuta la función cuando todo el archivo este cargado
    updateEstatus();

});