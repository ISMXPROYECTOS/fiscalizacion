$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-clave').addClass('hidden');
    $('#error-nombre, #error-clave').text('');
    $('#error-nombre-edit, #error-clave-edit').addClass('hidden');
    $('#error-nombre-edit, #error-clave-edit').text('');
    
    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'ajax': url + '/estatus-inspecciones/listado',
            'columns': [
                {data: 'clave'},
                {data: 'nombre'},
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
                url: url + '/estatus-inspecciones/nuevo',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $("#formulario-estatus-inspeccion")[0].reset();
                    $('#crear-estatus-inspeccion').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-nombre, #error-clave').addClass('hidden');
                    $('#error-nombre, #error-clave').text('');
                    viewData();
                },
                error: function(response) {
                    $('#error-nombre, #error-clave').addClass('hidden');
                    $('#error-nombre, #error-clave').text('');
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
                url: url + '/estatus-inspecciones/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-estatus-inspeccion').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#clave-edit').val(response.clave);
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
                'clave' : $('#clave-edit').val()
            }
            $.ajax({
                url: url + '/estatus-inspecciones/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-estatus-inspeccion').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit, #error-clave-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-clave-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#error-nombre-edit, #error-clave-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-clave-edit').text('');
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