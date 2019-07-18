$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-clave, #error-formato').addClass('hidden');
    $('#error-nombre, #error-clave, #error-formato').text('');
    $('#error-nombre-edit, #error-clave-edit, #error-formato-edit').addClass('hidden');
    $('#error-nombre-edit, #error-clave-edit, #error-formato-edit').text('');
    
    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/tipo-inspecciones/listado',
            'columns': [
                {data: 'clave'},
                {data: 'nombre'},
                {data: 'formato'},
                {data: 'created_at'},
                {data: 'btn'},
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
                'emptyTable': 'No se hay registros',
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
                'clave' : $('#clave').val(),
                'formato' : $('#formato').val()
            }
            $.ajax({
                url: url + '/tipo-inspecciones/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Tipo de Inspección');
                    $("#formulario-tipo-inspeccion")[0].reset();
                    $('#crear-tipo-inspeccion').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-nombre, #error-clave, #error-formato').addClass('hidden');
                    $('#error-nombre, #error-clave, #error-formato').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Tipo de Inspección');
                    $('#error-nombre, #error-clave, #error-formato').addClass('hidden');
                    $('#error-nombre, #error-clave, #error-formato').text('');
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
                url: url + '/tipo-inspecciones/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-tipo-inspeccion').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#clave-edit').val(response.clave);
                        $('#formato-edit').val(response.formato);
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
                'clave' : $('#clave-edit').val(),
                'formato' : $('#formato-edit').val()
            }
            $.ajax({
                url: url + '/tipo-inspecciones/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-tipo-inspeccion').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit, #error-clave-edit, #error-formato-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-clave-edit, #error-formato-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-nombre-edit, #error-clave-edit, #error-formato-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-clave-edit, #error-formato-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });

        });
    }

    updateData();
    
});