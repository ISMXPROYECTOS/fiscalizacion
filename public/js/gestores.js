$(document).ready(function(){

    //var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').addClass('hidden');
    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').text('');

    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').addClass('hidden');
    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').text('');

    $(document).on('click', '#btn-cancelar', function(e){

        $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').addClass('hidden');
        $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').text('');

        $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').addClass('hidden');
        $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit, #error-estatus-edit').text('');

    });

    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'processing': true,
            'destroy': true,
            'deferRender': true,
            'pageLength': 10,
            'order': [ 0, 'asc' ],
            'ajax': url + '/gestores/listado',
            'columns': [
                {data: 'nombreCompleto'},
                {data: 'telefono'},
                {data: 'celular'},
                {data: 'correoelectronico'},
                {data: 'ine'},
                {data: 'estatus',
                    'render': function(data, type, row){
                        if (row.estatus == 'A') {
                            return "<span class='badge badge-pill badge-success'>Activo</span>"
                        }else if(row.estatus == 'B'){
                            return "<span class='badge badge-pill badge-danger'>Baja</span>"
                        }else if(row.estatus == 'S'){
                            return "<span class='badge badge-pill badge-warning'>Suspendido</span>"
                        } else if (row.estatus == 'V') {
                            return "<span class='badge badge-pill badge-primary'>Vigente</span>"
                        }
                    }
                },
                {data: 'editar', orderable: false, searchable: false},
                {data: 'cambiarestatus', orderable: false, searchable: false},
                {data: 'inspecciones', orderable: false, searchable: false},
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
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Gestor...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Gestor');
                    $("#formulario-gestor")[0].reset();
                    $('#crear-gestor').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Gestor');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').addClass('hidden');
                    $('#error-nombre, #error-apellidopaterno, #error-apellidomaterno, #error-telefono, #error-celular, #error-correoelectronico, #error-ine, #error-estatus').text('');
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
                url: url + '/gestores/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-gestor').modal({backdrop: 'static', keyboard: false})
                        $('#editar-gestor').modal('show');
                        $('#id-edit').val(response.id);
                        $('#nombre-edit').val(response.nombre);
                        $('#apellidopaterno-edit').val(response.apellidopaterno);
                        $('#apellidomaterno-edit').val(response.apellidomaterno);
                        $('#telefono-edit').val(response.telefono);
                        $('#celular-edit').val(response.celular);
                        $('#correoelectronico-edit').val(response.correoelectronico);
                        $('#ine-edit').val(response.ine);
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
                'ine' : $('#ine-edit').val()
            }

            $.ajax({
                url: url + '/gestores/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-gestor').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit').addClass('hidden');
                    $('#error-nombre-edit, #error-apellidopaterno-edit, #error-apellidomaterno-edit, #error-telefono-edit, #error-celular-edit, #error-correoelectronico-edit, #error-ine-edit').text('');
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
                url: url + '/gestores/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-estatus').modal({backdrop: 'static', keyboard: false})
                        $('#editar-estatus').modal('show');
                        $('#id-edit-estatus').val(response.id);
                        $('#estatus-edit').val(response.estatus);
                    }
                }
            });
        });
    }

    editEstatus();

    function updateEstatus(){
        $('#btn-estatus').click(function(){
            var data = {
                'id' : $('#id-edit-estatus').val(),
                'estatus' : $('#estatus-edit').val()
            }

            $.ajax({
                url: url + '/gestores/estatus',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-estatus').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-estatus').text('Guardar');
                    $('#editar-estatus').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-estatus-edit').addClass('hidden');
                    $('#error-estatus-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-estatus').text('Guardar');
                    $('#error-estatus-edit').addClass('hidden');
                    $('#error-estatus-edit').text('');
                    $.each(response.responseJSON.errors, function(i, item) {
                        $('#error-'+i+'-edit').removeClass('hidden');
                        $('#error-'+i+'-edit').text(item[0]);
                    });
                }
            });
        });
    }

    updateEstatus();

    function inspeccionesPorGestor(){
        $(document).on('click', '.inspecciones', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            $('#inspecciones').modal({backdrop: 'static', keyboard: false})
            $('#inspecciones').modal('show');
            $('#inspecciones-datatable').DataTable({
                'serverSide': true,
                'processing': true,
                'destroy': true,
                'deferRender': true,
                'pageLength': 10,
                'order': [ 0, 'desc' ],
                'ajax': url + '/gestores/inspecciones/' + id,
                'columns': [
                    {data: 'folio'},
                    {data: 'tipoinspeccion_id',
                        'render': function ( data, type, row ) {
                            return (row.tipo_inspeccion.clave);
                        }, orderable: false
                    },
                    {data: 'estatusinspeccion_id',
                        'render': function ( data, type, row ) {
                            return (row.estatus_inspeccion.nombre);
                        }, orderable: false, searchable: false
                    },
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
        });
    }

    inspeccionesPorGestor();

});