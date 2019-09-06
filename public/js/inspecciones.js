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
    $('#error-estatusinspeccion-edit, #error-comentario-edit').addClass('hidden');
    $('#error-estatusinspeccion-edit, #error-comentario-edit').text('');

    function viewData(){
        $('#datatable').DataTable({
            'serverSide': true,
            'destroy': true,
            'order': [ 0, 'asc' ],
            'ajax': url + '/inspecciones/listado',
            'columns': [
                {data: 'folio',
                    'render': function(data, type, row){
                        return "<a href='" + url + "/inspecciones/informacion/" + row.id + "'>" + data + "</a>"
                    }
                },
                {data: 'tipo_inspeccion.clave'},
                {data: 'estatus_inspeccion.nombre'},
                {data: 'inspector.nombre',
                    defaultContent: ''
                },
                {data: 'comercio.nombreestablecimiento',
                    defaultContent: ''
                },
                {data: 'cambiarestatus'},
                {data: 'informacion'},
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
                        $('#inspector-edit').val(response.inspector_id);
                        $('#gestor-edit').val(response.gestores_id);
                        $('#tipoinspeccion-edit').val(response.tipoinspeccion_id);
                        $('#ejerciciofiscal-edit').val(response.ejerciciofiscal_id);
                        $('#colonia-edit').val(response.colonia_id);
                        $('#local-edit').val(response.nombrelocal);
                        $('#domicilio-edit').val(response.domicilio);
                        $('#encargado-edit').val(response.nombreencargado);
                        $('#puestoencargado-edit').val(response.cargoencargado);
                        $('#diasvence-edit').val(response.diasvence);
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
                        $('#comentario-edit').val(response.comentario);
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
                'estatusinspeccion' : $('#estatusinspeccion-edit').val(),
                'comentario' : $('#comentario-edit').val()
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

    function busquedaDeComerciosPorNombre(){
 
        $('#buscar-sm').click(function(){
            var calle = $('#calle').val();

            console.log(calle);
            
            if (calle == '') {
                var calle = null;
                $.ajax({
                    url: url + '/comercios/buscar/nombre/' + calle,
                    type: 'get',
                    success: function (response) {
                        $('#comercios').removeClass('hidden');
                        $('#error-sm').addClass('hidden');
                        $('#tabla-comercios').addClass('hidden');

                        $.each(response, function( key, value ){
                            $('#tbody-comercios').append(
                                "<tr class='results'>"+
                                    "<th>"+
                                        "<div class='form-check'>"+
                                          "<input class='form-check-input check' type='checkbox' value='"+ value.id +"' id='comercio-"+ value.id +"' name='establecimiento'>"+
                                        "</div>"+
                                    "</th>"+
                                    "<td>"+ value.licenciafuncionamiento +"</td>"+
                                    "<td>"+ value.nombreestablecimiento +"</td>"+
                                    "<td>"+ value.domiciliofiscal +"</td>"+
                                "</tr>");
                        });

                        //obtenerFoliosPorSM();
                    },
                    error: function(response) {
                        $('#error-sm').removeClass('hidden');
                        $('#error-sm').text(response.responseJSON.mensaje);
                    }
                });
            } else {
                $('.results').remove();
                $.ajax({
                    url: url + '/comercios/buscar/nombre/' + calle,
                    type: 'get',
                    success: function (response) {
                        $('#comercios').removeClass('hidden');
                        $('#tabla-comercios').removeClass('hidden');
                        $('#error-results').addClass('hidden');
                        $('#error-comercios').addClass('hidden');
                        $('#error-sm').addClass('hidden');

                        $.each(response, function( key, value ){
                            $('#tbody-comercios').append(
                                "<tr class='results'>"+
                                    "<th>"+
                                        "<div class='form-check'>"+
                                          "<input class='form-check-input check' type='checkbox' value='"+ value.id +"' id='comercio-"+ value.id +"' name='establecimiento'>"+
                                        "</div>"+
                                    "</th>"+
                                    "<td>"+ value.licenciafuncionamiento +"</td>"+
                                    "<td>"+ value.nombreestablecimiento +"</td>"+
                                    "<td>"+ value.domiciliofiscal +"</td>"+
                                "</tr>");
                        });

                        //obtenerFoliosPorSM();
                    },
                    error: function(response) {
                        $('#tabla-comercios').addClass('hidden');
                        $('#comercios').removeClass('hidden');
                        $('#error-results').removeClass('hidden');
                        $('#error-results').text(response.responseJSON.mensaje);
                        $('#error-comercios').addClass('hidden');
                    }
                });
            }
        });
    }

    busquedaDeComerciosPorNombre();

    
    
});