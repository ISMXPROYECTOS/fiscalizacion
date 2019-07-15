$(document).ready(function(){

    // Se crea una variable con la ruta raíz del proyecto
    var url = "http://localhost/fiscalizacion/public";

    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').addClass('hidden');
    $('#error-cantidad, #error-ejerciciofiscal, #error-tipoinspeccion').text('');
    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').addClass('hidden');
    $('#error-cantidad-asignar, #error-ejerciciofiscal-asignar, #error-tipoinspeccion-asignar, #error-inspectores-asignar').text('');
    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').addClass('hidden');
    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').text('');
    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').addClass('hidden');
    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').text('');
    $('#error-estatusinspeccion-edit').addClass('hidden');
    $('#error-estatusinspeccion-edit').text('');

    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'order': [ 2, 'asc' ],
            'ajax': url + '/inspecciones/listado',
            'columns': [
                {data: 'folio'},
                {data: 'tipoInspeccion'},
                {data: 'estatusInspeccion'},
                {data: 'idinspector'},
                {data: 'nombrelocal'},
                {data: 'editar'},
                {data: 'estatus'},
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

    function editData(){
        $(document).on('click', '.editar', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
             $.ajax({
                url: url + '/inspecciones/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-inspeccion').modal('show');
                        $('#id-edit').val(response.id);
                        $('#inspector-edit').val(response.idinspector);
                        $('#gestor-edit').val(response.idgestores);
                        $('#tipoinspeccion-edit').val(response.tipoinspeccion_id);
                        //$('#formavalorada-edit').val(response.idformavalorada);
                        //$('#giro-edit').val(response.idgiro);
                        //$('#subgiro-edit').val(response.idsubgirocomercial);
                        $('#ejerciciofiscal-edit').val(response.idejerciciofiscal);
                        //$('#estatus-edit').val(response.estatusinspeccion_id);
                        $('#colonia-edit').val(response.idcolonia);
                        $('#local-edit').val(response.nombrelocal);
                        $('#domicilio-edit').val(response.domicilio);
                        $('#encargado-edit').val(response.nombreencargado);
                        $('#puestoencargado-edit').val(response.cargoencargado);
                        $('#diasvence-edit').val(response.diasvence);
                        //$('#fechavence-edit').val(response.fechavence);
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
                'inspector' : $('#inspector-edit').val(),
                'gestor' : $('#gestor-edit').val(),
                'tipoinspeccion' : $('#tipoinspeccion-edit').val(),
                'ejerciciofiscal' : $('#ejerciciofiscal-edit').val(),
                'colonia' : $('#colonia-edit').val(),
                'local' : $('#local-edit').val(),
                'domicilio' : $('#domicilio-edit').val(),
                'encargado' : $('#encargado-edit').val(),
                'puestoencargado' : $('#puestoencargado-edit').val(),
                'diasvence' : $('#diasvence-edit').val()
            }
            $.ajax({
                url: url + '/inspecciones/actualizar',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-inspeccion').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').addClass('hidden');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').text('');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').addClass('hidden');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').text('');
                    viewData();
                },

                error: function(response) {
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').addClass('hidden');
                    $('#error-inspector-edit, #error-gestor-edit, #error-tipoinspeccion-edit, #error-ejerciciofiscal-edit').text('');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').addClass('hidden');
                    $('#error-colonia-edit, #error-domicilio-edit, #error-encargado-edit, #error-puestoencargado-edit, #error-diasvence-edit').text('');
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
                url: url + '/inspecciones/editar/' + id,
                type: 'get',
                success: function (response) {
                    if (response != ""){
                        $('#editar-estatus').modal('show');
                        $('#id-edit-estatusinspeccion').val(response.id);
                        $('#estatusinspeccion-edit').val(response.estatusinspeccion_id);
                    }
                }
            });
        });
    }

    editEstatus();

    function updateEstatus(){
        $('#btn-estatus').click(function(){

            var data = {
                'id' : $('#id-edit-estatusinspeccion').val(),
                'estatusinspeccion' : $('#estatusinspeccion-edit').val()
            }

            $.ajax({
                url: url + '/inspecciones/estatus',
                data: data,
                type: 'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#editar-estatus').modal('hide');
                    $('#actualizacion-correcta').modal('show');
                    $('#error-estatusinspeccion-edit').addClass('hidden');
                    $('#error-estatusinspeccion-edit').text('');
                    viewData();
                },
                error: function(response) {
                    $('#error-estatusinspeccion-edit').addClass('hidden');
                    $('#error-estatusinspeccion-edit').text('');
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