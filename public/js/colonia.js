$(document).ready(function(){
	// Se crea una variable con la ruta raiz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-cp').addClass('hidden');
    $('#error-nombre, #error-cp').text('');
    $('#error-nombre-edit, #error-cp-edit').addClass('hidden');
    $('#error-nombre-edit, #error-cp-edit').text('');

    $(document).on('click', '#btn-cancelar', function(e){
        $('#error-nombre, #error-cp').addClass('hidden');
        $('#error-nombre, #error-cp').text('');
        $('#error-nombre-edit, #error-cp-edit').addClass('hidden');
        $('#error-nombre-edit, #error-cp-edit').text('');
    });

    // Esta función muetra los años fiscales en una tabla
    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'processing': true,
            'deferRender': true,
            'pageLength': 10,
            'destroy': true,
            'ajax': url + '/colonias/listado',
            'columns': [
                {data: 'municipio_id',
                    'render': function ( data, type, row ) {
                        return (row.municipio.nombre);
                    }
                },
                {data: 'nombre'},
                {data: 'cp'},
                {data: 'editar', orderable: false, searchable: false},
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

    // Esta función agrega nuevos registros, se encuentra enlazada con el método create de ColoniaController
    function saveData(){
        $('#btn-enviar').click(function(){
            var data = {
                'nombre' : $('#nombre').val(),
                'cp' : $('#cp').val()
            }
            $.ajax({
                url: url + '/colonias/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Colonia...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Colonia');
                    $("#formulario-colonia")[0].reset();
                    $('#crear-colonia').modal('hide');
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

    // Esta función selecciona registros para modificarlos, se encuentra enlazada con el método editarColonia de ColoniaController
    function editData(){
        $(document).on('click', '.editar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/colonias/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-colonia').modal({backdrop: 'static', keyboard: false})
                        $('#editar-colonia').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#cp-edit').val(response.cp);
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
                'cp' : $('#cp-edit').val()
            }
            $.ajax({
                url: url + '/colonias/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-colonia').modal('hide');
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

});