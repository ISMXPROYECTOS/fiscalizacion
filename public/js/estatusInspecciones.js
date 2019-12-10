$(document).ready(function(){

    var url = "http://localhost/fiscalizacion/public";

    $('#error-nombre').addClass('hidden');
    $('#error-nombre').text('');

    $('#error-nombre-edit').addClass('hidden');
    $('#error-nombre-edit').text('');

    $(document).on('click', '#btn-cancelar', function(e){

        $('#error-nombre').addClass('hidden');
        $('#error-nombre').text('');
        
        $('#error-nombre-edit').addClass('hidden');
        $('#error-nombre-edit').text('');
    });
    
    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'processing': true,
            'deferRender': true,
            'pageLength': 10,
            'destroy': true,
            'ajax': url + '/estatus-inspecciones/listado',
            'columns': [
                {data: 'clave'},
                {data: 'nombre',
                    'render': function(data, type, row){
                        if (row.clave == 'NA') {
                            return "<span class='badge badge-pill badge-secondary'>"+ row.nombre +"</span>";
                        } else if(row.clave == 'A'){
                            return "<span class='badge badge-pill badge-primary'>"+ row.nombre +"</span>";
                        } else if(row.clave == 'Cap'){
                            return "<span class='badge badge-pill badge-success'>"+ row.nombre +"</span>";
                        } else if(row.clave == 'Epc'){
                            return "<span class='badge badge-pill badge-epc'>"+ row.nombre +"</span>";
                        } else if(row.clave == 'Claus'){
                            return "<span class='badge badge-pill badge-claus'>"+ row.nombre +"</span>";
                        } else if(row.clave == 'M'){
                            return "<span class='badge badge-pill badge-multa'>"+ row.nombre +"</span>";
                        } else if(row.clave == 'S'){
                            return "<span class='badge badge-pill badge-solventada'>"+ row.nombre +"</span>";
                        } else if (row.clave == 'V') {
                            return "<span class='badge badge-pill badge-danger'>"+ row.nombre +"</span>";
                        } else if (row.clave == 'C') {
                            return "<span class='badge badge-pill badge-warning'>"+ row.nombre +"</span>";
                        } else if(row.clave == 'P'){
                            return "<span class='badge badge-pill badge-info'>"+ row.nombre +"</span>";
                        } else {
                            return row.nombre;
                        }
                    }
                },
                {data: 'created_at'},
                {data: 'btn', orderable: false, searchable: false},
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
                beforeSend: function(){
                    $('#btn-enviar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Creando Estatus...');
                },
                success: function (response) {
                    $('#btn-enviar').text('Crear Estatus');
                    $("#formulario-estatus-inspeccion")[0].reset();
                    $('#crear-estatus-inspeccion').modal('hide');
                    $('#registro-correcto').modal('show');
                    $('#error-nombre').addClass('hidden');
                    $('#error-nombre').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-enviar').text('Crear Estatus');
                    $('#error-nombre').addClass('hidden');
                    $('#error-nombre').text('');
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
                        $('#editar-estatus-inspeccion').modal({backdrop: 'static', keyboard: false});
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
                'nombre' : $('#nombre-edit').val()
            }
            $.ajax({
                url: url + '/estatus-inspecciones/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend: function(){
                    $('#btn-editar').html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Guardando...');
                },
                success: function (response) {
                    $('#btn-editar').text('Guardar');
                    $('#editar-estatus-inspeccion').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-nombre-edit').addClass('hidden');
                    $('#error-nombre-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#btn-editar').text('Guardar');
                    $('#error-nombre-edit').addClass('hidden');
                    $('#error-nombre-edit').text('');
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